<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'category_id', 'name', 'price', 'description', 'condition', 'type', 'status',
        'photo', 'owner_name', 'country_code', 'contact_number', 'address'
    ];
}
