<?php

namespace App\Http\Controllers\translation;

use App\Models\FurnitureDesc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
 
class FurnitureDescController extends Controller
{
    public static array $menu = [
        'title' => 'ignore-_furniture_descs.json',
        'route' => 'furniture-descs.index',
        'description' => 'Manage furniture translations',
        'icon' => 'fa-solid fa-bed',
        'color' => 'green',
    ];

    public function index(Request $request)
    {
        $query = FurnitureDesc::ordered();
 
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_jp', 'like', "%$search%")
                  ->orWhere('title_en', 'like', "%$search%")
                  ->orWhere('furniture_desc_code', 'like', "%$search%")
                  ->orWhere('furniture_desc_id', $search);
            });
        }
 
        $furnitureDescs = $query->paginate(100)->withQueryString();
 
        return view('tl-manager.translation.furniture-descs.index', compact('furnitureDescs'));
    }
 
    public function create()
    {
        return view('tl-manager.translation.furniture-descs.create');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'furniture_desc_id' => 'required|integer|unique:furniture_descs,furniture_desc_id',
            'furniture_desc_code' => 'nullable|string|max:255',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);
 
        FurnitureDesc::create($validated);
 
        return redirect()->route('furniture-descs.index')
                       ->with('success', 'Furniture Description berhasil ditambahkan!');
    }
 
    public function edit(FurnitureDesc $furnitureDesc)
    {
        return view('tl-manager.translation.furniture-descs.edit', compact('furnitureDesc'));
    }
 
    public function update(Request $request, FurnitureDesc $furnitureDesc)
    {
        $validated = $request->validate([
            'furniture_desc_id' => 'required|integer|unique:furniture_descs,furniture_desc_id,' . $furnitureDesc->id,
            'furniture_desc_code' => 'nullable|string|max:255',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);
 
        $furnitureDesc->update($validated);
 
        return redirect()->route('furniture-descs.index')
                       ->with('success', 'Furniture Description berhasil diperbarui!');
    }
 
    public function destroy(FurnitureDesc $furnitureDesc)
    {
        $furnitureDesc->delete();
 
        return redirect()->route('furniture-descs.index')
                       ->with('success', 'Furniture Description berhasil dihapus!');
    }
 
    private function decodeStoredNewlines(?string $text): ?string
    {
        if ($text === null) {
            return null;
        }

        return str_replace('\\n', "\n", $text);
    }
 
    public function export()
    {
        $furnitureDescs = FurnitureDesc::ordered()->get();

        $json = [];

        foreach ($furnitureDescs as $furnitureDesc) {

            // FURNITURE DESC ID
            $json["_furniture_desc_id_{$furnitureDesc->furniture_desc_id}"] = $furnitureDesc->furniture_desc_code;

            // TITLE
            $json[
                $this->decodeStoredNewlines($furnitureDesc->title_jp)
            ] = $this->decodeStoredNewlines($furnitureDesc->title_en);

            // DESCRIPTION
            if (
                !empty($furnitureDesc->description_jp) &&
                !empty($furnitureDesc->description_en)
            ) {

                $json[
                    $this->decodeStoredNewlines($furnitureDesc->description_jp)
                ] = $this->decodeStoredNewlines($furnitureDesc->description_en);
            }
        }

        $json['dummy'] = 'forNoComma';

        $content = json_encode(
            $json,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        $filename = 'furniture_descs_' . now()->format('Y-m-d_H-i-s') . '.json';

        return response($content)
            ->header('Content-Type', 'application/json; charset=UTF-8')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    public function showImport()
    {
        return view('tl-manager.translation.furniture-descs.import');
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
            $furnitureDescIds = [];
 
            $i = 0;
            while ($i < count($content)) {
                $keys = array_keys($content);
                $key = $keys[$i];
 
                if (preg_match('/_furniture_id_(\d+)/', $key, $matches)) {
                    $furnitureDescId = (int)$matches[1];
                    $furnitureDescCode = $content[$key];
 
                    $titleJp = $keys[$i + 1] ?? null;
                    $titleEn = $content[$titleJp] ?? null;
                    
                    $descriptionJp = null;
                    $descriptionEn = null;
 
                    if (isset($keys[$i + 2]) && 
                        !preg_match('/_furniture_id_/', $keys[$i + 2]) && 
                        !preg_match('/^dummy$/', $keys[$i + 2])) {
                        $descriptionJp = $keys[$i + 2];
                        $descriptionEn = $content[$descriptionJp] ?? null;
                        $i += 3;
                    } else {
                        $i += 2;
                    }
 
                    FurnitureDesc::updateOrCreate(
                        ['furniture_desc_id' => $furnitureDescId],
                        [
                            'furniture_desc_code' => $furnitureDescCode,
                            'title_jp' => $this->normalizeNewlines($titleJp),
                            'title_en' => $this->normalizeNewlines($titleEn),
                            'description_jp' => $this->normalizeNewlines($descriptionJp),
                            'description_en' => $this->normalizeNewlines($descriptionEn),
                        ]
                    );
 
                    $imported++;
                    $furnitureDescIds[] = $furnitureDescId;
                } else {
                    $i++;
                }
            }
 
            DB::commit();
 
            return redirect()->route('furniture-descs.index')
                           ->with('success', "Berhasil mengimport {$imported} furniture description!");
 
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
 
    public function batchDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:furniture_descs,id',
        ]);
 
        $deleted = FurnitureDesc::whereIn('id', $validated['ids'])->delete();
 
        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted} furniture description!",
        ]);
    }
}