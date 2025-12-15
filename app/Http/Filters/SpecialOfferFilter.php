<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class SpecialOfferFilter extends AbstractFilter
{

    public const IDS = 'ids';
    public const LIMIT = 'limit';
    public const TITLE = 'title';




    protected function getCallbacks(): array
    {
        return [

            self::TITLE => [$this, 'title'],
            self::LIMIT => [$this, 'limit'],
            self::IDS => [$this, 'ids'],


        ];
    }

    public function ids(Builder $builder, $value){
        $builder->whereIn('id', $value) ;
    }


    public function limit(Builder $builder, $value)
    {

        $builder->limit($value);

    }

    public function category(Builder $builder, $value)
    {

        $builder->where('category_id', $value);
    }

    public function title(Builder $builder, $value)
    {

        $builder->where('title','LIKE', "%$value%");
    }









}
