<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        foreach (array_keys(trans('settings.attributes')) as $key) {
            $data[$key] = Settings::get($key, null);
        }

        return response()->json(array_merge($data, [
            'locales' => config('app.locales'),
        ]));
    }
}
