<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; 
    protected $table = 'category';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'front_status',
        'admin_status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
