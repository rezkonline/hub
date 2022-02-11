<?php

namespace App\Models;

use App\Http\Resources\NotificationResource;
use App\Models\Relations\NotificationRelations;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use NotificationRelations;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'task',
        'schedule',
        'campaign',
    ];

    /**
     * Get the resource array or an item from resource array
     * or object using "dot" notation.
     *
     * @param  null|string|array|int  $key
     * @param  mixed  $default
     * @return array|mixed
     */
    public function getResource($key = null, $default = null)
    {
        $resource = (new NotificationResource($this))->jsonSerialize();

        if ($key) {
            return data_get($resource, $key, $default);
        }

        return $resource;
    }
}
