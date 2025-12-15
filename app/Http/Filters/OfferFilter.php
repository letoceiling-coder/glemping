<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class OfferFilter extends AbstractFilter
{

    public const IDS = 'ids';
    public const ACTIVE = 'active';
    public const LIMIT = 'limit';
    public const SEARCH = 'search';
    public const NAME = 'name';
    public const SORTER = 'sorter';




    protected function getCallbacks(): array
    {
        return [

            self::ACTIVE => [$this, 'active'],
            self::LIMIT => [$this, 'limit'],
            self::SEARCH => [$this, 'search'],
            self::NAME => [$this, 'name'],
            self::SORTER => [$this, 'selectSort'],
            self::IDS => [$this, 'ids'],


        ];
    }

    public function ids(Builder $builder, $value){
        $builder->whereIn('id', $value) ;
    }


    public function selectSort(Builder $builder, $value)
    {

        if ($value == 'orderByDesc') {
            $builder->orderByDesc('id');
        } elseif ($value == 'orderBy') {
            $builder->orderBy('id');
        }


    }
    public function active(Builder $builder, $value)
    {
        if ($value != 'all'){
            $builder->where('active', isBoolean($value));
        }

    }

    public function sort(Builder $builder, $value)
    {
        if ($value == 'orderBy'){
            $builder->orderBy('id');
        }elseif ($value == 'orderByDesc'){
            $builder->orderByDesc('id');
        }

    }

    public function limit(Builder $builder, $value)
    {

        $builder->limit($value);

    }


    public function search(Builder $builder, $value)
    {
        $builder->where('name', 'LIKE', "%$value%");
    }








}
