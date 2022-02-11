<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Models\Scopes\CityScopes;
use App\Models\Concerns\Selectable;
use App\Models\Relations\CityRelations;
use Illuminate\Database\Eloquent\Model;
use App\Models\Relations\CountryRelations;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTrait;

class City extends Model implements Translatable
{
    use CountryRelations,
        TranslatableTrait,
        Filterable,
        CityRelations,
        CityScopes,
        Selectable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
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
