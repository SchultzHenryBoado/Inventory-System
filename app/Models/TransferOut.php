<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferOut extends Model
{
    use HasFactory;

    protected $fillable = ['transfer_out_no', 'date', 'warehouse', 'description', 'users_id'];
}
