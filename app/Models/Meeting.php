<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Models\Concerns\Selectable;
use App\Models\Helpers\MeetingHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\MeetingRelations;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTrait;

class Meeting extends Model implements Translatable
{
    use MeetingRelations,
        Filterable,
        Selectable,
        TranslatableTrait,
        MeetingHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_at',
        'duration',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'name',
        'description',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

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
