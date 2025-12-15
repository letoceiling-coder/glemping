<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class CityFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const REGION_ID = 'region_id';
    public const LIMIT = 'limit';
    public const FILTER = 'filter';



    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::REGION_ID => [$this, 'region_id'],
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
    public function region_id(Builder $builder, $value)
    {
        $builder->where('region_id',  $value);
    }


}
