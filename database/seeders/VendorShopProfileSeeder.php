<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();
        $vendor = new Vendor();
        $vendor->banner = 'uploads/123.jpg';
        $vendor->shop_name = 'eCommerce';
        $vendor->phone = '+4412623456';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'Sofia, Bulgaria, Slivnitsa 86';
        $vendor->description = 'Vendor profile';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
