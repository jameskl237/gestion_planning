<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ColorController extends Controller
{
    public function updateColor(Request $request)
    {

        try {
            $layout = $request->input('layout');
            $sidebar = $request->input('sidebar');
            $theme = $request->input('theme');
            $user_id = $request->input('user_id');

            $check_user = User::where('id', $user_id)->first();

            if (!$check_user) {
                return response()->json(
                    'erreur'
                );
            } else {
                $final_color = $layout . ' ' . $sidebar . ' ' . $theme;
                $check_user->color = $final_color;
                $check_user->save();
                return response()->json(
                    'ok'
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                $e->getMessage()
            );
        }
    }
}
