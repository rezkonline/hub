<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Models\Concerns\Selectable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\CountryRelations;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTrait;

class Country extends Model implements Translatable
{
    use CountryRelations,
        TranslatableTrait,
        Filterable,
        Selectable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

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
