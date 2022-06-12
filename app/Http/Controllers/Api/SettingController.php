<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingController extends Controller
{
    /**
     * The list of the files keys.
     *
     * @var array
     */
    protected $files = [
        'logo',
        'favicon',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        foreach (array_keys(trans('settings.attributes')) as $key) {
            if (in_array($key, $this->files)) {
                continue;
            }

            $data[$key] = Settings::get($key, null);
        }

        foreach ($this->files as $file) {
            $data[$file] = optional(Settings::instance($file))->getFirstMediaUrl($file);
        }

        return response()->json(array_merge($data, [
            'locales' => config('app.locales'),
        ]));
    }
}
