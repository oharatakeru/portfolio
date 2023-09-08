<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'cooking_time', 'cook_img', 'ingredients', 'quantity'];

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
