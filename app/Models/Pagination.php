<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagination extends Model
{
    use HasFactory;
    protected $table = 'pagination';
    protected $fillable = [
        'Name',    
        'Email', 
        'Password',
        'Image', 
        'Video', 
    ];
}
