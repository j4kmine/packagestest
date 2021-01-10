<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Package;
use Illuminate\Support\Str;
class PackageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_making_post_req()
    {
        $response = $this->postJson('/api/packages', [
            'transaction_id' =>  Str::random(36),
            'customer_name' =>  "PT. AMARA PRIMATIGA",
            'customer_code' =>  "1678593",
            'transaction_amount' =>  "70700",
            'transaction_discount' =>  "0",
            'transaction_payment_type' =>  "29",
            'transaction_state' =>  "PAID",
            'transaction_code' =>  "CGKFT20200715121",
            'transaction_order' =>  121,
            'location_id' =>  "5cecb20b6c49615b174c3e74",
            'organization_id' =>   6,
            'transaction_payment_type_name' =>  "Invoice",
            'transaction_cash_amount' =>  0,
            'transaction_cash_change' =>  0,
            'customer_attribute' => array("data"=>array()),
            'connote' => array("data"=>array()),
            'connote_id' =>  "f70670b1-c3ef-4caf-bc4f-eefa702092ed",
            'origin_data' => array("data"=>array()),
            'destination_data' => array("data"=>array()),
            'koli_data' => array("data"=>array()),
            'custom_field' => array("data"=>array()),
            'currentLocation' => array("data"=>array())
        ]);

        $response
            ->assertStatus(200);

    }
}
