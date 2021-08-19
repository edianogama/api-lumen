<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'title', 'img_featured', 'description', 'resume', 'date_start', 'created_at', 'updated_at'
    ];

}