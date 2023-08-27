<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'client_name',
        'description',
        'project_cost',
        'date_started',
        'estimated_date_to_finish',
        'link',
        'image',
    ];
}
