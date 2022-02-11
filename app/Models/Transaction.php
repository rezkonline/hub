<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Concerns\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\TransactionScopes;
use App\Models\Helpers\TransactionHelpers;
use App\Models\Relations\TransactionRelations;

class Transaction extends Model implements HasMedia
{
    use TransactionRelations,
        HasMediaTrait,
        TransactionHelpers,
        Filterable,
        TransactionScopes;

    /**
     * @var string
     */
    const PACKAGE_TYPE = 'package';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'actor_id',
        'amount',
        'payment_type',
        'note',
        'type',
    ];

    /**
     * Register the user media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('receipt')
            ->singleFile();
    }
}
