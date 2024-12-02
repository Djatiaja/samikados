<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Request_status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Builder\FallbackBuilder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $payment = Payment::all()->random();


        return [
            "seller_id"=>$payment->seller_id,    
            "payment_id"=>$payment->id,    
            "status_id"=>Request_status::all()->random(),    
            "amount"=>$payment->amount,    
            "is_deposit"=>fake()->randomElement([true, false]),    
        ];
    }
}
