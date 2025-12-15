<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class FormFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const METHOD = 'method';
    public const POPUP = 'popup';
    public const ACTIVE = 'active';





    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::METHOD => [$this, 'method'],
            self::POPUP => [$this, 'popup'],
            self::ACTIVE => [$this, 'active'],

        ];
    }


    public function active(Builder $builder, $value)
    {
        $builder->where('active',  isBoolean($value));
    }

    public function popup(Builder $builder, $value)
    {
        $builder->where('popup',  isBoolean($value));
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name',  $value);
    }

    public function method(Builder $builder, $value)
    {
        $builder->where('method',  $value);
    }



}
