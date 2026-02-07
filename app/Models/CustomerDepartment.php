<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDepartment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'uuid',
        'customer_id',
        'branch_id',
        'department',
        'created_by',
        'modified_by'
    ];
}
