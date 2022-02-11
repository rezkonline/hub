<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Filters\CampaignFilter;

class CampaignController extends Controller
{
    /**
     * CampaignController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Campaign::class, 'campaign');
    }

    /**
     * Display a listing of the resource.
     *
     * @param CampaignFilter $filter
     * @return void
     */
    public function index(CampaignFilter $filter)
    {
        if (auth()->user()->isAdmin()) {
            $campaigns = Campaign::orderBy('id', 'DESC')->paginate();
        } else {
            $campaigns = Campaign::filter($filter)->whereIn('customer_id', auth()->user()->customers->pluck('id'))->orderBy('id', 'DESC')->paginate();
        }

        return view('dashboard.campaigns.index', compact('campaigns'));
    }

    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     * @return void
     */
    public function show(Campaign $campaign)
    {
        // Leave any impersonation
        auth()->user()->leaveImpersonation();

        // Impersonate this user
        auth()->user()->impersonate($campaign->customer);

        // Redirect to home page
        return redirect()->to('campaign-' . $campaign->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        flash(trans('campaigns.messages.deleted'));

        return redirect()->route('dashboard.campaigns.index');
    }
}
