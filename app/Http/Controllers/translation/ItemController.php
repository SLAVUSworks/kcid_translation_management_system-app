<?php

namespace App\Http\Controllers\translation;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
 
class ItemController extends Controller
{
    public static array $menu = [
        'title' => 'ignore-_items.json',
        'route' => 'items.index',
        'description' => 'Manage item translations',
        'icon' => 'ri-book-open-line',
        'color' => 'blue',
    ];

    public function index(Request $request)
    {
        $query = Item::ordered();
 
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_jp', 'like', "%$search%")
                  ->orWhere('title_en', 'like', "%$search%")
                  ->orWhere('item_code', 'like', "%$search%")
                  ->orWhere('item_id', $search);
            });
        }
 
        $items = $query->paginate(100)->withQueryString();
 
        return view('tl-manager.translation.items.index', compact('items'));
    }
 
    public function create()
    {
        return view('tl-manager.translation.items.create');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer|unique:items,item_id',
            'item_code' => 'required|string|max:255',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);
 
        Item::create($validated);
 
        return redirect()->route('items.index')
                       ->with('success', 'Item berhasil ditambahkan!');
    }
 
    public function edit(Item $item)
    {
        return view('tl-manager.translation.items.edit', compact('item'));
    }
 
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer|unique:items,item_id,' . $item->id,
            'item_code' => 'required|string|max:255',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);
 
        $item->update($validated);
 
        return redirect()->route('items.index')
                       ->with('success', 'Item berhasil diperbarui!');
    }
 
    public function destroy(Item $item)
    {
        $item->delete();
 
        return redirect()->route('items.index')
                       ->with('success', 'Item berhasil dihapus!');
    }
 
    public function export()
    {
        $items = Item::ordered()->get();

        $json = [];

        foreach ($items as $item) {

            // ITEM ID
            $json["_item_id_{$item->item_id}"] = $item->item_code;

            // TITLE
            $json[$item->title_jp] = $item->title_en;

            // DESCRIPTION
            if (
                !empty($item->description_jp) &&
                !empty($item->description_en)
            ) {
                $json[$item->description_jp] = $item->description_en;
            }
        }

        $json['dummy'] = 'forNoComma';

        $content = json_encode(
            $json,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        $filename = 'items_' . now()->format('Y-m-d_H-i-s') . '.json';

        return response($content)
            ->header('Content-Type', 'application/json; charset=UTF-8')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
 

    public function showImport()
    {
        return view('tl-manager.translation.items.import');
    }
 
    private function normalizeNewlines(?string $text): ?string
    {
        if ($text === null) {
            return null;
        }

        return str_replace(
            ["\r\n", "\r", "\n"],
            '\\n',
            $text
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:10240',
        ]);
 
        try {
            $file = $request->file('json_file');
            $content = json_decode(file_get_contents($file), true);
 
            if (!is_array($content)) {
                return back()->with('error', 'Format JSON tidak valid!');
            }
 
            DB::beginTransaction();
 
            $imported = 0;
            $questIds = [];
 
            $i = 0;
            while ($i < count($content)) {
                $keys = array_keys($content);
                $key = $keys[$i];
 
                if (preg_match('/_item_id_(\d+)/', $key, $matches)) {
                    $questId = (int)$matches[1];
                    $questCode = $content[$key];
 
                    $titleJp = $keys[$i + 1] ?? null;
                    $titleEn = $content[$titleJp] ?? null;
                    
                    $descriptionJp = null;
                    $descriptionEn = null;
 
                    if (isset($keys[$i + 2]) && 
                        !preg_match('/_item_id_/', $keys[$i + 2]) && 
                        !preg_match('/^dummy$/', $keys[$i + 2])) {
                        $descriptionJp = $keys[$i + 2];
                        $descriptionEn = $content[$descriptionJp] ?? null;
                        $i += 3;
                    } else {
                        $i += 2;
                    }
 
                    Item::updateOrCreate(
                        ['item_id' => $questId],
                        [
                            'item_code' => $questCode,
                            'title_jp' => $this->normalizeNewlines($titleJp),
                            'title_en' => $this->normalizeNewlines($titleEn),
                            'description_jp' => $this->normalizeNewlines($descriptionJp),
                            'description_en' => $this->normalizeNewlines($descriptionEn),
                        ]
                    );
 
                    $imported++;
                    $questIds[] = $questId;
                } else {
                    $i++;
                }
            }
 
            DB::commit();
 
            return redirect()->route('items.index')
                           ->with('success', "Berhasil mengimport {$imported} item!");
 
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
 
    public function batchDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:items,id',
        ]);
 
        $deleted = Item::whereIn('id', $validated['ids'])->delete();
 
        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted} item!",
        ]);
    }
}