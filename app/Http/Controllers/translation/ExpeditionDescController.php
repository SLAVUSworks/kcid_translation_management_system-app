<?php

namespace App\Http\Controllers\translation;

use App\Models\ExpeditionDesc;
use App\Models\TranslationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExpeditionDescController extends Controller
{
    public static array $menu = [
        'title' => 'ignore-_expedition_descs.json',
        'route' => 'expedition-descs.index',
        'description' => 'Manage expedition translations',
        'icon' => 'fa-solid fa-truck',
        'color' => 'green',
    ];

    public function index(Request $request)
    {
        $query = ExpeditionDesc::with('translationStatus')
            ->ordered();

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title_jp', 'like', "%{$search}%")
                ->orWhere('title_en', 'like', "%{$search}%")
                ->orWhere('description_jp', 'like', "%{$search}%")
                ->orWhere('description_en', 'like', "%{$search}%")
                ->orWhere('expedition_desc_code', 'like', "%{$search}%");

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

        $expeditionDescs = $query
            ->paginate(100)
            ->withQueryString();

        return view(
            'tl-manager.translation.expedition-descs.index',
            compact('expeditionDescs')
        );
    }

    public function create()
    {
        return view('tl-manager.translation.expedition-descs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expedition_desc_code' => 'required|string|max:255|unique:expedition_descs,expedition_desc_code',
            'title_jp' => 'required|string',
            'title_en' => 'required|string',
            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $validated['title_jp'] =
            $this->normalizeNewlines(
                $validated['title_jp']
            );

        $validated['title_en'] =
            $this->normalizeNewlines(
                $validated['title_en']
            );

        $validated['description_jp'] =
            $this->normalizeNewlines(
                $validated['description_jp'] ?? null
            );

        $validated['description_en'] =
            $this->normalizeNewlines(
                $validated['description_en'] ?? null
            );

        DB::beginTransaction();

        try {

            $expeditionDesc = ExpeditionDesc::create(
                $validated
            );

            TranslationStatus::create([
                'type' => 'expedition_desc',
                'reference_id' => $expeditionDesc->id,
                'status' => 'untranslated',
            ]);

            DB::commit();

            return redirect()
                ->route('expedition-descs.index')
                ->with(
                    'success',
                    'Expedition Description berhasil ditambahkan!'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    public function edit(ExpeditionDesc $expeditionDesc)
    {
        $expeditionDesc->load('translationStatus');

        return view('tl-manager.translation.expedition-descs.edit', compact('expeditionDesc'));
    }


    public function update(
        Request $request,
        ExpeditionDesc $expeditionDesc
    ) {

        $validated = $request->validate([
            'expedition_desc_code' =>
                'required|string|max:255|unique:expedition_descs,expedition_desc_code,' .
                $expeditionDesc->id,

            'title_jp' => 'required|string',
            'title_en' => 'required|string',

            'description_jp' => 'nullable|string',
            'description_en' => 'nullable|string',

            // STATUS
            'status' =>
                'required|in:translated,untranslated,on-progress',
        ]);

        $validated['title_jp'] =
            $this->normalizeNewlines(
                $validated['title_jp']
            );

        $validated['title_en'] =
            $this->normalizeNewlines(
                $validated['title_en']
            );

        $validated['description_jp'] =
            $this->normalizeNewlines(
                $validated['description_jp'] ?? null
            );

        $validated['description_en'] =
            $this->normalizeNewlines(
                $validated['description_en'] ?? null
            );

        DB::beginTransaction();

        try {

            // UPDATE EXPEDITION DESC
            $expeditionDesc->update([
                'expedition_desc_code' =>
                    $validated['expedition_desc_code'],

                'title_jp' =>
                    $validated['title_jp'],

                'title_en' =>
                    $validated['title_en'],

                'description_jp' =>
                    $validated['description_jp'],

                'description_en' =>
                    $validated['description_en'],
            ]);

            // UPDATE STATUS
            TranslationStatus::updateOrCreate(
                [
                    'type' => 'expedition_desc',
                    'reference_id' => $expeditionDesc->id,
                ],
                [
                    'status' => $validated['status'],
                ]
            );

            DB::commit();

            if ($validated['status'] === 'on-progress') { 
                return back()->with( 'success', 'Expedition Description saved as On-Progress!' ); 
            }

            return redirect()
                ->route('expedition-descs.index')
                ->with(
                    'success',
                    'Expedition Description berhasil diperbarui!'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    public function destroy(ExpeditionDesc $expeditionDesc)
    {
        $expeditionDesc->delete();

        return redirect()
            ->route('expedition-descs.index')
            ->with('success', 'Expedition Description berhasil dihapus!');
    }

    private function decodeStoredNewlines(?string $text): ?string
    {
        if ($text === null) {
            return null;
        }

        return str_replace('\\n', "\n", $text);
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

    public function export()
    {
        $expeditionDescs = ExpeditionDesc::ordered()->get();

        $json = [];

        foreach ($expeditionDescs as $expeditionDesc) {

            // UNIQUE EXPEDITION CODE KEY
            $json["_expedition_code_{$expeditionDesc->id}"] =
                $expeditionDesc->expedition_desc_code;

            // TITLE
            $json[
                $this->decodeStoredNewlines(
                    $expeditionDesc->title_jp
                )
            ] = $this->decodeStoredNewlines(
                $expeditionDesc->title_en
            );

            // DESCRIPTION
            if (
                !empty($expeditionDesc->description_jp) &&
                !empty($expeditionDesc->description_en)
            ) {

                $json[
                    $this->decodeStoredNewlines(
                        $expeditionDesc->description_jp
                    )
                ] = $this->decodeStoredNewlines(
                    $expeditionDesc->description_en
                );
            }
        }

        $json['dummy'] = 'forNoComma';

        $content = json_encode(
            $json,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        $filename =
            'expedition_descs_' .
            now()->format('Y-m-d_H-i-s') .
            '.json';

        return response($content)
            ->header(
                'Content-Type',
                'application/json; charset=UTF-8'
            )
            ->header(
                'Content-Disposition',
                "attachment; filename=\"{$filename}\""
            );
    }

    public function showImport()
    {
        return view('tl-manager.translation.expedition-descs.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:10240',
        ]);

        try {

            $raw = file_get_contents(
                $request->file('json_file')->getRealPath()
            );

            preg_match_all(
                '/"expedition_code"\s*:\s*"([^"]+)"\s*,\s*"([^"]+)"\s*:\s*"([^"]+)"\s*,\s*"([^"]+)"\s*:\s*"([^"]+)"/u',
                $raw,
                $matches,
                PREG_SET_ORDER
            );

            DB::beginTransaction();

            $imported = 0;

            foreach ($matches as $match) {

                ExpeditionDesc::updateOrCreate(
                    [
                        'expedition_desc_code' => $match[1]
                    ],
                    [
                        'title_jp' => $this->normalizeNewlines($match[2]),
                        'title_en' => $this->normalizeNewlines($match[3]),
                        'description_jp' => $this->normalizeNewlines($match[4]),
                        'description_en' => $this->normalizeNewlines($match[5]),
                    ]
                );

                TranslationStatus::updateOrCreate(
                    [
                        'type' => 'expedition_desc',
                        'reference_id' => ExpeditionDesc::where('expedition_desc_code', $match[1])->first()->id,
                    ],
                    [
                        'status' => 'untranslated',
                    ]
                );

                $imported++;
            }

            DB::commit();

            return redirect()
                ->route('expedition-descs.index')
                ->with(
                    'success',
                    "Berhasil mengimport {$imported} expedition description!"
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    public function batchDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:expedition_descs,id',
        ]);

        $deleted = ExpeditionDesc::whereIn(
            'id',
            $validated['ids']
        )->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted} expedition description!",
        ]);
    }
}
