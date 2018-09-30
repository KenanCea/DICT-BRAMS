<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Member extends Model
{
    use Notifiable, HasApiTokens;
    protected $fillable = [
    'first_name', 'family_name', 'middle_name', 'age','sex'
    ];
}
