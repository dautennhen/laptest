<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selected extends Model {

    protected $table = 'selecteds';
    protected $fillable = [
        'order_id', 'company_id', 'status'
    ];

}
