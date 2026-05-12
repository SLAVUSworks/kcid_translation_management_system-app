<?php

namespace App\Http\Controllers\translation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $path = app_path('Http/Controllers/translation');

        $files = File::files($path);

        $menus = [];

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
                $menus[] = $fullClass::$menu;
            }
        }

        return view('tl-manager.dashboard', compact('menus'));
    }
}