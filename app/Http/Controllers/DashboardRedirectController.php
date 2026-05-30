<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardRedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'unverified') {
            return view('dashboard.restricted');
        }

        return (new DashboardController)->index();
    }
}
