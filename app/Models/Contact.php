<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public static $rules = array(
        // 'fullname' => 'required',
        'familyname' => 'required',
        'lastname' => 'required',
        'gender' => 'required',
        // 'email' => 'required | email:rfc, dns',
        'email' => 'required | email',
        'postcode' => 'required | min:8',
        'address' => 'required',
        'opinion' => 'required | max:120'
    );
}