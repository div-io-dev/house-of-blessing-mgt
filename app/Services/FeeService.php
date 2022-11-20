<?php


namespace App\Services;


use App\Models\Fee;

class FeeService
{
    public function create($data){
        $fee = Fee::create($data);
        return $fee;
    }

}
