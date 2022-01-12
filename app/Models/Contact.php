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

    // public static $rules()
    // {
    //     return [
    //         'familyname' => 'required',
    //         'lastname' => 'required',
    //         'gender' => 'required',
    //         'email' => 'required | email',
    //         'postcode' => 'required | min:8',
    //         'address' => 'required',
    //         'opinion' => 'required | max:120'
    //     ];
    // }


    public static $rules = array(
        'familyname' => 'required',
        'lastname' => 'required',
        'gender' => 'required',
        'email' => 'required | email',
        'postcode' => 'required | min:8',
        'address' => 'required',
        'opinion' => 'required | max:120'
    );
}