<?php

namespace App\Models\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static \Illuminate\Database\Eloquent\Builder sortingByIds($ids)
 */
trait Selectable
{
    /**
     * Sorting the query result by the given ids.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $ids
     * @param string $field
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortingByIds(Builder $builder, $ids, $field = 'id')
    {
        if (is_array($ids)) {
            $case = "CASE ";
            $in = [];
            foreach ($ids as $id) {
                $case .= "WHEN {$field} = ? THEN 0 ";
                $in[] = '?';
            }
            $in = implode(',', $in);

            $case .= "ELSE {$field} NOT IN ($in) END";

            $builder->orderByRaw(
                $case,
                Arr::collapse([$ids, $ids])
            );
        } else {
            $builder->orderByRaw(
                "CASE WHEN {$field} = ? THEN 0 ELSE id != ? END",
                [$ids, $ids]
            );
        }

        return $builder;
    }
}