<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'name','phone','email','password','photo','address','gender'
    ];
}
