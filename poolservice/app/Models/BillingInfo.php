<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingInfo extends Model {

    protected $fillable = [
        'user_id', 'name_card', 'token', 'customer_id', 'expiration_date', 'card_last_digits', 'address', 'city', 'state', 'zipcode'
    ];
    protected $table = 'billing_info';
    protected $primaryKey = 'user_id';
    protected $casts = [
        'zipcode' => 'array',
    ];

}
