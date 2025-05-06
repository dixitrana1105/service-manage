<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries'; // Specify the table name if it's different from the model name 
    protected $fillable = ['name', 'code']; // Specify the fillable attributes
    public function states()
    {
        return $this->hasMany(States::class, 'country_id', 'id');
    }
    public function cities()
    {
        return $this->hasManyThrough(City::class, States::class, 'country_id', 'state_id', 'id', 'id');
    }
    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class, 'country_id', 'id');
    }
}
