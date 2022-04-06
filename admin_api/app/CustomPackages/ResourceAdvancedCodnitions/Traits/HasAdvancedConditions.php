<?php


namespace App\CustomPackages\ResourceAdvancedCodnitions\Traits;


use Illuminate\Http\Resources\MissingValue;

trait HasAdvancedConditions
{
    public function whenAnyLoaded(array $resources){
        $result = null;
        foreach ($resources as $name => $item) {
            if(get_class($item->resource) != MissingValue::class){
                $result[$name] = $item;
            }
        }
        return $result ?? new MissingValue();
    }
}
