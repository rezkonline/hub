<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Events\CommentCreatedEvent;
use App\Events\CampaignStatusEvent;
use App\Events\CampaignCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Filters\Api\CampaignFilter;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\CampaignResource;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Requests\Api\CampaignRequest;
use App\Http\Resources\AttachmentResource;

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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, CampaignFilter $filter)
    {
        return CampaignResource::collection($request->user()->campaigns()->filter($filter)->latest('id')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CampaignRequest $request
     * @return void
     */
    public function store(CampaignRequest $request)
    {
        $campaign = Campaign::create($request->allWithAuthId('customer_id'));

        if ($request->hasFile('attachments')) {
            $campaign->addOrUpdateMultipleMediaFromRequest('attachments', 'attachments');
        }

        event(new CampaignCreatedEvent($campaign));

        return response()->json([
            'message' => trans('campaigns.messages.created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     * @return CampaignResource
     */
    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CampaignRequest  $request
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->all());

        event(new CampaignStatusEvent($campaign));

        return response()->json([
            'message' => trans('campaigns.messages.updated'),
        ]);
    }

    /**
     * Get all comments.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments(Campaign $campaign)
    {
        return CommentResource::collection($campaign->comments()->latest('id')->get());
    }

    /**
     * Get all logs.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function logs(Campaign $campaign)
    {
        return ActivityResource::collection($campaign->activities()->latest('id')->get());
    }

    /**
     * Get all attachments.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function attachments(Campaign $campaign)
    {
        return AttachmentResource::collection($campaign->getMedia('attachments'));
    }

    /**
     * Add comment to the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Campaign $campaign
     * @return CampaignResource
     */
    public function comment(CommentRequest $request, Campaign $campaign)
    {
        if (app('impersonate')->getImpersonatorId()) {
            $user = User::find(app('impersonate')->getImpersonatorId());
        } else {
            $user = $request->user();
        }

        $campaign->commentAsUser($user, $request->input('body'));

        broadcast(new CommentCreatedEvent($campaign))->toOthers();

        return new CampaignResource($campaign);
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

        return response()->json([
            'message' => trans('campaigns.messages.deleted'),
        ]);
    }
}
