<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receiving extends Model
{
    use HasFactory;

    protected $fillable = ['receiving_no', 'warehouse', 'date', 'po_number', 'description'];
}
