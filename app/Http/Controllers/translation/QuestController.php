<?php

namespace App\Http\Controllers\translation;

use App\Models\Quest;
use App\Models\TranslationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
 
class QuestController extends Controller
{
    public static array $menu = [
        'title' => 'ignore-_quests.json',
        'route' => 'quests.index',
        'description' => 'Manage quest translations',
        'icon' => 'fa-solid fa-list-check',
        'color' => 'blue',
    ];

    public function index(Request $request)
    {
        $query = Quest::with('translationStatus')
            ->ordered();

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title_jp', 'like', "%{$search}%")
                ->orWhere('title_en', 'like', "%{$search}%")
                ->orWhere('description_jp', 'like', "%{$search}%")
                ->orWhere('description_en', 'like', "%{$search}%")
                ->orWhere('quest_code', 'like', "%{$search}%")
                ->orWhere('quest_id', $search);

            });
        }

        // STATUS FILTER
        if ($request->filled('status')) {

            $query->whereHas(
                'translationStatus',
                function ($q) use ($request) {

                    $q->where(
                        'status',
                        $request->status
                    );
                }
            );
        }

        $quests = $query
            ->paginate(100)
            ->withQueryString();

        return view(
            'tl-manager.translation.quests.index',
            compact('quests')
        );
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

        DB::beginTransaction();

        try {

            $quest = Quest::create($validated);

            TranslationStatus::create([
                'type' => 'quest',
                'reference_id' => $quest->id,
                'status' => 'untranslated',
            ]);

            DB::commit();

            return redirect()
                ->route('quests.index')
                ->with(
                    'success',
                    'Quest berhasil ditambahkan!'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    public function edit(Quest $quest)
    {
        $quest->load('translationStatus');

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

            // STATUS
            'status' => 'required|in:translated,untranslated,on-progress',
        ]);

        DB::beginTransaction();

        try {

            // UPDATE QUEST
            $quest->update([
                'quest_id' => $validated['quest_id'],
                'quest_code' => $validated['quest_code'],
                'title_jp' => $validated['title_jp'],
                'title_en' => $validated['title_en'],
                'description_jp' => $validated['description_jp'],
                'description_en' => $validated['description_en'],
            ]);

            // UPDATE STATUS
            TranslationStatus::updateOrCreate(
                [
                    'type' => 'quest',
                    'reference_id' => $quest->id,
                ],
                [
                    'status' => $validated['status'],
                ]
            );

            DB::commit();

            if ($validated['status'] === 'on-progress') { 
                return back()->with( 'success', 'Quest saved as On-Progress!' ); 
            }

            return redirect()
                ->route('quests.index')
                ->with(
                    'success',
                    'Quest berhasil diperbarui!'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    public function destroy(Quest $quest)
    {
        $quest->delete();
 
        return redirect()->route('quests.index')
                       ->with('success', 'Quest berhasil dihapus!');
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
        $quests = Quest::ordered()->get();

        $json = [];

        foreach ($quests as $quest) {

            // QUEST ID
            $json["_quest_id_{$quest->quest_id}"] = $quest->quest_code;

            // TITLE
            $json[
                $this->decodeStoredNewlines($quest->title_jp)
            ] = $this->decodeStoredNewlines($quest->title_en);

            // DESCRIPTION
            if (
                !empty($quest->description_jp) &&
                !empty($quest->description_en)
            ) {

                $json[
                    $this->decodeStoredNewlines($quest->description_jp)
                ] = $this->decodeStoredNewlines($quest->description_en);
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
                            'quest_code'        => $questCode,
                            'title_jp'          => $this->normalizeNewlines($titleJp),
                            'title_en'          => $this->normalizeNewlines($titleEn),
                            'description_jp'    => $this->normalizeNewlines($descriptionJp),
                            'description_en'    => $this->normalizeNewlines($descriptionEn),
                        ]
                    );

                    TranslationStatus::updateOrCreate(
                        [
                            'type'              => 'quest',
                            'reference_id'      => Quest::where('quest_id', $questId)->first()->id,
                        ],
                        [
                            'status'            => 'untranslated',
                        ]
                    );
 
                    $imported++;
                    $questIds[] = $questId;
                } else {
                    $i++;
                }
            }
 
            DB::commit();
 
            return redirect()->route('quests.index')
                           ->with('success', "Berhasil mengimport {$imported} quest!");
 
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
 
    public function batchDelete(Request $request)
    {
        $validated = $request->validate([
            'ids'           => 'required|array',
            'ids.*'         => 'integer|exists:quests,id',
        ]);
 
        $deleted = Quest::whereIn('id', $validated['ids'])->delete();
 
        return response()->json([
            'success'       => true,
            'message'       => "Berhasil menghapus {$deleted} quest!",
        ]);
    }
}