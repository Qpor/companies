<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public const UPDATED_AT = null;
    public const CREATED_AT = null;

    protected string $tableName = 'companies';

    protected $fillable = [
        'company_id',
        'company_name',
        'company_registration_number',
        'company_foundation_date',
        'country',
        'zipCode',
        'city',
        'street_address',
        'latitude',
        'longitude',
        'company_owner',
        'employees',
        'activity',
        'active',
        'email',
        'password'
    ];
}
