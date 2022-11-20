<?php


namespace App\Services;


use App\Models\Parent_;

class ParentService
{
    public function store($data){
        $parent = Parent_::create([
            'name' => $data['name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'] ?? null,
            'town' => $data['town'] ?? null,
            'address' => $data['address'] ?? null,
        ]);
        return $parent;
    }

    public function update($parent, $data){
        $parent = $parent->update([
            'name' => $data['name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'town' => $data['town'],
            'address' => $data['address'],
        ]);
        return $parent;
    }
}
