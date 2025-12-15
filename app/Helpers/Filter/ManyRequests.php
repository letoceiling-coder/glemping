<?php

namespace App\Helpers\Filter;


use App\Http\Controllers\Api\v1\HelperTrait;
use Illuminate\Support\Facades\DB;

class ManyRequests
{
    use HelperTrait;

    private string $model;
    private $table;
    private \Illuminate\Support\Collection $ids;
    private $transactions;

    public function __construct(string $model, array $ids)
    {
        $this->model = $model;
        $this->table = $this->getTable($model);
        $this->ids = collect($ids);
        $this->transactions = $this->getModel($this->model)->whereIn('id',$this->ids->pluck('id'))->get();
    }

    public function sorts(): bool|int
    {


        $sortsIds = $this->ids;
        $cases = [];
        $ids = [];
        $params = [];

        foreach ($this->transactions as $transaction) {
            $cases[] = "WHEN {$transaction->id} then ?";
            $params[] = $transaction->sort = $sortsIds
                ->firstWhere('id',$transaction->id)['sort'];
            $ids[] = $transaction->id;
        }

        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);

        if (!empty($ids)) {

              $res =  DB::update("UPDATE ".$this->table." SET `sort` = CASE `id` {$cases} END WHERE `id` in ({$ids})", $params);
            if ($res){
                return true;
            }

        }
        return false;
    }


}
