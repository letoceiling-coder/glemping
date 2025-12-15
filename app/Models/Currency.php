<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use Filterable;
    protected $guarded = false;

    protected $casts = [
        'active' => 'boolean'
    ];
    static public function getCourses()
    {
        try {
            $objJsonDocument = json_encode(ex_apiCurrency(), true);
            $arrOutput = json_decode($objJsonDocument, true);

            foreach ($arrOutput['Valute'] as $item) {
                if($item['CharCode'] == 'USD') {


                    $item['Nominal'] = 100;

                }
                $currency = Currency::firstWhere('code', $item['CharCode']);

                $item['VunitRate'] = str_replace(',','.',$item['VunitRate']);
                if ($currency) {
                    $currency->uid = $item['@attributes']['ID'];

                    $currency->name = $item['Name'];
                    $currency->code = $item['CharCode'];
                    $currency->nominal = $item['Nominal'];
                    $currency->course = $item['VunitRate'] * $item['Nominal'] ;

                    $currency->course_at = $currency->course;
                    $currency->save();
                } else {

                    Currency::create([
                        'uid' => $item['@attributes']['ID'],

                        'name' => $item['Name'],
                        'code' => $item['CharCode'],
                        'nominal' => $item['Nominal'],
                        'course' => $item['VunitRate'] * $item['Nominal'],
                    ]);
                }
            }

        }catch (\Exception $exception){

        }

        return true;
        dd($arrOutput);
    }
}
