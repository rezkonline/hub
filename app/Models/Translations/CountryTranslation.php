<?php

namespace App\Models\Translations;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
