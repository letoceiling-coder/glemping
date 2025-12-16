<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ServiceFilter extends AbstractFilter
{

    public const IDS = 'ids';
    public const LIMIT = 'limit';
    public const SORT = 'sort';


    protected function getCallbacks(): array
    {
        return [
            self::LIMIT => [$this, 'limit'],
            self::SORT => [$this, 'sort'],
            self::IDS => [$this, 'ids'],
        ];
    }

    public function ids(Builder $builder, $value)
    {
        if (!empty($value) && is_array($value)) {
            $builder->whereIn('id', $value);
        }
    }

    public function sort(Builder $builder, $value)
    {
        if ($value == 'orderBy') {
            $builder->orderBy('id');
        } elseif ($value == 'orderByDesc') {
            $builder->orderByDesc('id');
        }
    }

    public function limit(Builder $builder, $value)
    {
        if ($value > 0) {
            $builder->limit($value);
        }
    }
}

