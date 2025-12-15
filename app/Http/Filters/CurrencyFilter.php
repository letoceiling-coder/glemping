<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class CurrencyFilter extends AbstractFilter
{
    public const ACTIVE = 'active';
    public const CODE = 'code';
    public const NAME = 'name';
    public const LIMIT = 'limit';
    public const FILTER = 'filter';



    protected function getCallbacks(): array
    {
        return [
            self::ACTIVE => [$this, 'active'],
            self::NAME => [$this, 'name'],
            self::LIMIT => [$this, 'limit'],
            self::FILTER => [$this, 'filter'],
            self::CODE => [$this, 'code'],
        ];
    }

    public function active(Builder $builder, $value)
    {
        if ($value != 'all'){
            $builder->where('active', isBoolean($value));
        }

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
        $builder->where('name',  'LIKE',"%$value%");
    }

    public function code(Builder $builder, $value)
    {
        $builder->where('code',  'LIKE',"%$value%");
    }



}
