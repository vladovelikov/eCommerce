<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['website_name', 'layout', 'contact_email', 'currency_icon', 'timezone'];
    protected $table = 'settings';

}
