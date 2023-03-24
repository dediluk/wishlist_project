<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wish extends Model
{
    use HasFactory, SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_wish');
    }

    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function usersWhoWish()
    {
        return $this->belongsToMany(User::class, 'user_wish', 'wish_id', 'user_id');
    }
}
