<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Auth;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function run()
    {
        $user = Auth::user();

        dd($user->can('perm1'));
    }
}
