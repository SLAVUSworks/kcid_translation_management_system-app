<?php

namespace App\Http\Controllers\json\translation;

use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
 
class QuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Quest::ordered();
 
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_jp', 'like', "%$search%")
                  ->orWhere('title_en', 'like', "%$search%")
                  ->orWhere('quest_code', 'like', "%$search%")
                  ->orWhere('quest_id', $search);
            });
        }
 
        $quests = $query->paginate(100)->withQueryString();
 
        return view('tl-manager.translation.quests.index', compact('quests'));
    }
 
    public function create()
    {
        return view('tl-manager.translation.quests.create');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quest_id' => 'required|integer|unique:quests,quest_id',
            'quest_code' => 'required|string|max:255',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);
 
        Quest::create($validated);
 
        return redirect()->route('tl-manager.translation.quests.index')
                       ->with('success', 'Quest berhasil ditambahkan!');
    }
 
    public function edit(Quest $quest)
    {
        return view('tl-manager.translation.quests.edit', compact('quest'));
    }
 
    public function update(Request $request, Quest $quest)
    {
        $validated = $request->validate([
            'quest_id' => 'required|integer|unique:quests,quest_id,' . $quest->id,
            'quest_code' => 'required|string|max:255',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);
 
        $quest->update($validated);
 
        return redirect()->route('quests.index')
                       ->with('success', 'Quest berhasil diperbarui!');
    }
 
    public function destroy(Quest $quest)
    {
        $quest->delete();
 
        return redirect()->route('quests.index')
                       ->with('success', 'Quest berhasil dihapus!');
    }
 
    public function export()
    {
        $quests = Quest::ordered()->get();

        $json = [];

        foreach ($quests as $quest) {

            // QUEST ID
            $json["_quest_id_{$quest->quest_id}"] = $quest->quest_code;

            // TITLE
            $json[$quest->title_jp] = $quest->title_en;

            // DESCRIPTION
            if (
                !empty($quest->description_jp) &&
                !empty($quest->description_en)
            ) {
                $json[$quest->description_jp] = $quest->description_en;
            }
        }

        $json['dummy'] = 'forNoComma';

        $content = json_encode(
            $json,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        $filename = 'quests_' . now()->format('Y-m-d_H-i-s') . '.json';

        return response($content)
            ->header('Content-Type', 'application/json; charset=UTF-8')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
 

    public function showImport()
    {
        return view('tl-manager.translation.quests.import');
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
 
                if (preg_match('/_quest_id_(\d+)/', $key, $matches)) {
                    $questId = (int)$matches[1];
                    $questCode = $content[$key];
 
                    $titleJp = $keys[$i + 1] ?? null;
                    $titleEn = $content[$titleJp] ?? null;
                    
                    $descriptionJp = null;
                    $descriptionEn = null;
 
                    if (isset($keys[$i + 2]) && 
                        !preg_match('/_quest_id_/', $keys[$i + 2]) && 
                        !preg_match('/^dummy$/', $keys[$i + 2])) {
                        $descriptionJp = $keys[$i + 2];
                        $descriptionEn = $content[$descriptionJp] ?? null;
                        $i += 3;
                    } else {
                        $i += 2;
                    }
 
                    Quest::updateOrCreate(
                        ['quest_id' => $questId],
                        [
                            'quest_code' => $questCode,
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
 
            return redirect()->route('tl-manager.translation.quests.index')
                           ->with('success', "Berhasil mengimport {$imported} quest!");
 
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
 
    public function batchDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:quests,id',
        ]);
 
        $deleted = Quest::whereIn('id', $validated['ids'])->delete();
 
        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted} quest!",
        ]);
    }
}