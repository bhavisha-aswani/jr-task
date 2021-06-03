<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class Employee extends Model
{
	 protected $fillable = [
        'first_name', 'last_name','company_id','email', 'phone',
    ]; 
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
