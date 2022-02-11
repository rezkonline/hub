<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Models\Scopes\MessageScopes;
use App\Models\Helpers\MessageHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\MessagRelations;

class Message extends Model
{
    use MessagRelations,
        MessageHelpers,
        MessageScopes,
        Filterable;

    /**
     * Notice type.
     *
     * @var string
     */
    const NOTICE = 'notice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'manager_id',
        'sender_id',
        'title',
        'body',
        'seen_by_customer',
        'seen_by_manager',
        'type',
    ];

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }
}
