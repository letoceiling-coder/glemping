<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ImageFilter extends AbstractFilter
{

    public const LIMIT = 'limit';
    public const SELECT_SORT = 'selectSort';
    public const SEARCH = 'search';
    public const FOLDER = 'folder';


    protected function getCallbacks(): array
    {
        return [
            self::LIMIT => [$this, 'limit'],
            self::SELECT_SORT => [$this, 'selectSort'],
            self::SEARCH => [$this, 'search'],
            self::FOLDER => [$this, 'folder'],


        ];
    }


    public function limit(Builder $builder, $value)
    {
        if ($value != 'all') {
            $builder->limit($value);
        }


    }

    public function folder(Builder $builder, $value)
    {

        $builder->where('folder_id', $value);
        if ($value == 3) {

            $builder->whereNotNull('preview_id');
        }
    }

    public function search(Builder $builder, $value)
    {

        $builder->where('name', 'LIKE', "%$value%")
            ->orWhere('path', 'LIKE', "%$value%");

    }

    public function selectSort(Builder $builder, $value)
    {

        if ($value == 'orderByDesc') {
            $builder->orderByDesc('id');
        } elseif ($value == 'orderBy') {
            $builder->orderBy('id');
        }


    }


}
