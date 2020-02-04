<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $fillable = [
        'id_order', 'title', 'description', 'date', 'status',
    ];
}
