<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'quantity', 'max_use', 'valid_from', 'valid_to', 'discount_type', 'discount_value', 'status', 'total_used'];
}
