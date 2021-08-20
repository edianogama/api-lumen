<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "event";
    
    protected $fillable = [
        'name', 'img_featured', 'description', 'resume', 'date_start', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'date_start' => 'datetime:F j, Y, g:i a',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}