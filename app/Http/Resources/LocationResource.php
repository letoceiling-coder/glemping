<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Metro;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $response = [
            'html' => $this->html,
            'address' => $this->address,
            'city_id' => $this->city_id,
            'region_id' => $this->region_id,
            'metro_id' => $this->metro_id ?? null ,

        ];

        if ($this->city_id){
            $city = City::find($this->city_id);
            $response['city'] = $city;
            $response['region'] = $city->region;
            if ($response['metro_id']){
                $metro = Metro::find($this->metro_id);
                $response['metro'] = $metro;
            }
        }elseif ($this->region_id){
            $region = Region::find($this->region_id)->toArray();
            $response['region'] = $region;
        }

        return $response;
    }
}
