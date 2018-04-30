<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test() {
        return response()->json(['test' => 'bla']);
    }

    public function showProfile(Request $request, $username = null) {
        $showpictures = $request->get('showpictures', false);

        if ($showpictures) {
            echo "Pictures are shown";
        }

        return response($username);
    }
}
