<?php

namespace App\Http\Controllers;


use App\Models\TranslationStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $path = app_path('Http/Controllers/translation');

        $files = File::files($path);

        $menus = [];

        $totalAssets = 0;
        $totalTranslated = 0;
        $totalUntranslated = 0;
        $totalOnProgress = 0;

        foreach ($files as $file) {

            $className = pathinfo($file, PATHINFO_FILENAME);

            if ($className === 'DashboardController') {
                continue;
            }

            $fullClass = "App\\Http\\Controllers\\translation\\{$className}";

            if (
                class_exists($fullClass) &&
                property_exists($fullClass, 'menu')
            ) {

                $menu = $fullClass::$menu;

                /*
                |--------------------------------------------------------------------------
                | Generate Table Name
                |--------------------------------------------------------------------------
                |
                | QuestController => quests
                | ItemController => items
                | FurnitureDescController => furniture_descs
                |
                */

                $baseName = str_replace(
                    'Controller',
                    '',
                    $className
                );

                $table = Str::snake(
                    Str::pluralStudly($baseName)
                );

                /*
                |--------------------------------------------------------------------------
                | Generate Type
                |--------------------------------------------------------------------------
                |
                | quests => quest
                | furniture_descs => furniture_desc
                |
                */

                $type = Str::singular($table);

                if (!DB::getSchemaBuilder()->hasTable($table)) {
                    continue;
                }

                $assetCount = DB::table($table)->count();

                $translatedCount = TranslationStatus::where(
                    'type',
                    $type
                )->where(
                    'status',
                    'translated'
                )->count();

                $untranslatedCount = TranslationStatus::where(
                    'type',
                    $type
                )->where(
                    'status',
                    'untranslated'
                )->count();

                $onProgressCount = TranslationStatus::where(
                    'type',
                    $type
                )->where(
                    'status',
                    'on-progress'
                )->count();

                $completion = $assetCount > 0
                    ? round(
                        ($translatedCount / $assetCount) * 100,
                        1
                    )
                    : 0;

                $menus[] = [
                    ...$menu,

                    'table' => $table,
                    'type' => $type,

                    'assets' => $assetCount,

                    'translated' => $translatedCount,

                    'untranslated' => $untranslatedCount,

                    'on_progress' => $onProgressCount,

                    'completion' => $completion,
                ];

                $totalAssets += $assetCount;
                $totalTranslated += $translatedCount;
                $totalUntranslated += $untranslatedCount;
                $totalOnProgress += $onProgressCount;
            }
        }

        $overallCompletion = $totalAssets > 0
            ? round(
                ($totalTranslated / $totalAssets) * 100,
                1
            )
            : 0;

        return view(
            'dashboard.index',
            compact(
                'menus',
                'totalAssets',
                'totalTranslated',
                'totalUntranslated',
                'totalOnProgress',
                'overallCompletion'
            )
        );
    }
}

