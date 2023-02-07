<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'issue_no', 'warehouse', 'date', 'reference', 'project_id', 'description'];
}
