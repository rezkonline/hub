<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Laraeast\LaravelSettings\Facades\Settings;
use App\Http\Requests\Dashboard\SettingRequest;

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
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->middleware('can:edit-settings');
    }

    /**
     * Display a listing of the resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        foreach ($request->except(array_merge(['_token', '_method', 'media'], $this->files)) as $key => $value) {
            Settings::set($key, $value);
        }

        foreach ($this->files as $file) {
            Settings::set($file)->addAllMediaFromTokens([], $file);
        }

        flash(trans('settings.messages.updated'));

        return redirect()->route('dashboard.settings.index');
    }
}
