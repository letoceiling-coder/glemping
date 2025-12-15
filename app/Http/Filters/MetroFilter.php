<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class MetroFilter extends AbstractFilter
{
    public const CITY_ID = 'city_id';
    public const NAME = 'name';
    public const LINE_ID = 'line_id';
    public const LINE_NAME = 'line_name';
    public const LINE_COLOR = 'line_color';
    public const LIMIT = 'limit';



    protected function getCallbacks(): array
    {
        return [
            self::CITY_ID => [$this, 'city_id'],
            self::NAME => [$this, 'name'],
            self::LINE_ID => [$this, 'line_id'],
            self::LINE_NAME => [$this, 'line_name'],
            self::LINE_COLOR => [$this, 'line_color'],
            self::LIMIT => [$this, 'limit'],

        ];
    }
    public function limit(Builder $builder, $value)
    {
        $builder->limit($value);
    }
    public function line_color(Builder $builder, $value)
    {
        $builder->where('line_color',  'LIKE',"%$value%");
    }
    public function name(Builder $builder, $value)
    {
        $builder->where('name',  'LIKE',"%$value%");
    }
    public function line_name(Builder $builder, $value)
    {
        $builder->where('line_name',  'LIKE',"%$value%");
    }

    public function city_id(Builder $builder, $value)
    {
        $builder->where('city_id',  $value);
    }
    public function line_id(Builder $builder, $value)
    {
        $builder->where('line_id',  $value);
    }



}
