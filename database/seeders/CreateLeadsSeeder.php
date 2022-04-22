<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;

class CreateLeadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'lead1',
               'email'=>'lead1@gmail.com',
               'phone'=>'9999999999',
               'address'=>'sssssss',
               'notes' => 'aaaaaaa',
               'image'=>'test.png',
               'user_id'=>1,
            ],
            
        ];
  
        foreach ($user as $key => $value) {
            Lead::create($value);
        }
    }
}
