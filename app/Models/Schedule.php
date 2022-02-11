<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use App\Models\Concerns\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use App\Models\Concerns\HasCommentsTrait;
use App\Models\Relations\ScheduleRelations;
use Spatie\Activitylog\Traits\LogsActivity;

class Schedule extends Model implements HasMedia
{
    use ScheduleRelations,
        HasCommentsTrait,
        HasMediaTrait,
        LogsActivity,
        Filterable;

    /**
     * The code of the completed status.
     *
     * @var string
     */
    const COMPLETED_STATUS = 'completed';

    /**
     * The code of the ongoing status.
     *
     * @var string
     */
    const ONGOING_STATUS = 'ongoing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'name',
        'description',
        'status',
    ];

    /**
     * The attributes that are mass loggable.
     *
     * @var boolean
     */
    protected static $logFillable = true;

    /**
     * Only the `create` and `update` event will get logged automatically.
     *
     * @var array
     */
    protected static $recordEvents = ['created', 'updated'];

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }

    /**
     * Register the user media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    /**
     * This method will allow you to fill properties and add custom fields before the activity is saved.
     *
     * @param Activity $activity
     * @param string $eventName
     */
    public function tapActivity(Activity $activity, string $eventName)
    {
        if ($id = app('impersonate')->getImpersonatorId()) {
            $activity->causer_id = $id;
        } else {
            $activity->causer_id = auth()->user()->id;
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name', 'description']);
    }
}
