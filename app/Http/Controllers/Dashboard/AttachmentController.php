<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AttachmentRequest;
use App\Models\User;
use Spatie\MediaLibrary\Models\Media;

class AttachmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttachmentRequest $request, User $user)
    {
        $this->authorize('storeAttachment', $user);

        $user->addMedia($request->file('attachment'))
            ->setName($request->input('name'))
            ->toMediaCollection('attachments');

        flash(trans('attachments.messages.created'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @param  Media $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Media $attachment)
    {
        $this->authorize('destroyAttachment', $user);

        $attachment->delete();

        flash(trans('attachments.messages.deleted'));

        return redirect()->route('dashboard.users.show', $user);
    }
}
