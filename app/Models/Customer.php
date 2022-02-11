<?php

namespace App\Models;

use App\Models\Concerns\Activatable;
use App\Models\Concerns\HasMediaTrait;
use App\Models\Contracts\ActivatableContract;
use Parental\HasParent;
use App\Models\Relations\CustomerRelations;

class Customer extends User implements ActivatableContract
{
    use CustomerRelations,
        HasParent,
        Activatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'country_id',
        'city_id',
        'manager_id',
        'activated_at',
    ];

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'user_id';
    }
}
