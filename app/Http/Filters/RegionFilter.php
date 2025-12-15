<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class RegionFilter extends AbstractFilter
{
    public const LIMIT = 'limit';
    public const NAME = 'name';
    public const FILTER = 'filter';



    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::LIMIT => [$this, 'limit'],
            self::FILTER => [$this, 'filter'],

        ];
    }

    public function filter(Builder $builder, $value)
    {

        $builder->select($value);
    }
    public function limit(Builder $builder, $value)
    {
        $builder->limit($value);
    }
    public function name(Builder $builder, $value)
    {
        $builder->where('name',  $value);
    }


}
