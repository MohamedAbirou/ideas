<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Idea extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $withCount = ['likes'];

    // protected $guarded = [
    //     "id",
    //     "created_at",
    //     "updated_at",
    // ];

    protected $fillable = [
        "user_id",
        "content",
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, "idea_like")->withTimestamps();
    }

    public function scopeSearch(Builder $query, $search = '')
    {
        $query->where("content", "like", "%" . $search . "%");
    }
}
