<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setCurrentLocale(Request $request): JsonResponse
    {
        $locale = $request->input('locale');
        if (in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
            $user = User::find(auth()->user()->id);
            $user->language = $locale;
            $user->save();
            return response()->json(['message' => 'Locale changed successfully'], 200);
        }
        return response()->json(['message' => 'Locale not found'], 404);
    }
}
