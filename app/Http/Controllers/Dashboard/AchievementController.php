<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Customer;
use App\Models\Achievement;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AchievementRequest;

class AchievementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param AchievementRequest $request
     * @param Customer $user
     * @return \Illuminate\Http\Response
     */
    public function store(AchievementRequest $request, Customer $user)
    {
        Achievement::create($request->all());

        flash(trans('achievements.messages.created'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Achievement $achievement
     * @param Customer $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $user, Achievement $achievement)
    {
        $this->authorize('update', $achievement);

        return view('dashboard.achievements.edit', compact('achievement', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AchievementRequest $request
     * @param Customer $user
     * @param Achievement $achievement
     * @return \Illuminate\Http\Response
     */
    public function update(AchievementRequest $request, Customer $user, Achievement $achievement)
    {
        $achievement->update($request->all());

        flash(trans('achievements.messages.updated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $user
     * @param Achievement $achievement
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $user, Achievement $achievement)
    {
        $achievement->delete();

        flash(trans('achievements.messages.deleted'));

        return redirect()->route('dashboard.users.show', $user);
    }
}
