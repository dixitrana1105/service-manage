<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $table = 'customer_addresses'; 
    protected $fillable = ['user_id','first_name','last_name','email','mobile','country_id','state_id','city_id','address','apartment','postal_code'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
