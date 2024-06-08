<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'username' => 'tania1',
            'password' => Hash::make('123456789'),
            'info' => 'Example customer info',
            'balance' => 200.00
        ]);
    }
}
