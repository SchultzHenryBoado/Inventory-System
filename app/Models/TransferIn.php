<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferIn extends Model
{
    use HasFactory;

    protected $fillable = ['transfer_in_no', 'reference_no', 'date', 'warehouse', 'description'];
}
