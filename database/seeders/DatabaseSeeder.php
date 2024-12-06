<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\notification;
use App\Models\Payment;
use App\Models\payment_method;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DatabaseSeeder::call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class, 
            CountrySeeder::class, 
            ProvinceSeeder::class,
            CitySeeder::class,
            AddressSeeder::class,
            OrderStatusSeeder::class,
            SellerSeeder::class,
            OrderSeeder::class,
            FinishingSeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductFinishingSeeder::class,
            OrderDetailSeeder::class,
            ReviewSeeder::class,
            CartSeeder::class,
            CartProductFinishingSeeder::class,
            PaymentMethodSeeder::class,
            PaymentStatusSeeder::class,
            MidtransStatusSeeder::class,
            PaymentSeeder::class,
            RequestStatusSeeder::class,
            WalletSeeder::class,
            BankSeeder::class,
            WithdrawalSeeder::class,
            NotificationSeeder::class,
            AdminSeed::class,
            BannerSeeder::class,
        ]);
    }
}
