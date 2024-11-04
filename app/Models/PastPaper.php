<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastPaper extends Model
{
    protected $fillable = ['course_id', 'user_id', 'paper', 'tags'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'tags' => 'array',
    ];
}
