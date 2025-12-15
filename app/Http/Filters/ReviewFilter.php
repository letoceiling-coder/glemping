<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ReviewFilter extends AbstractFilter
{

    public const SORTER = 'sorter';
    public const ACTIVE = 'active';
    public const SEARCH = 'search';
    public const NAME = 'name';

    public const VIDEO_ID = 'video_id';



    protected function getCallbacks(): array
    {
        return [
            self::ACTIVE => [$this, 'active'],
            self::SEARCH => [$this, 'search'],
            self::NAME => [$this, 'name'],
            self::SORTER => [$this, 'sorter'],
            self::VIDEO_ID => [$this, 'video_id'],

        ];
    }
    public function video_id(Builder $builder, $value)
    {

        if ($value == 1) {
            $builder->whereNotNull('video_id');
        } elseif ($value == 2) {
            $builder->whereNull('video_id');
        }


    }

    public function active(Builder $builder, $value)
    {
        if ($value != 'all'){
            $builder->where('active', isBoolean($value));
        }

    }

    public function sorter(Builder $builder, $value)
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

    public function category(Builder $builder, $value)
    {

        $builder->where('category_id', $value);
    }

    public function search(Builder $builder, $value)
    {
        $builder->where('name', 'LIKE', "%$value%");
    }








}
