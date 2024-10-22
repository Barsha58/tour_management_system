<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'contact_us'; // Ensure this matches your database table name

    protected $fillable = ['email', 'phone', 'address'];
}


