<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class PropertyFilter extends AbstractFilter
{

    public const ACTIVE = 'active';




    protected function getCallbacks(): array
    {
        return [
            self::ACTIVE => [$this, 'active'],



        ];
    }

    public function active(Builder $builder, $value)
    {
        if ($value != 'all'){
            $builder->where('active', isBoolean($value));
        }

    }









}
