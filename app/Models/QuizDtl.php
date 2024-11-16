<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuizDtl extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model
    protected $table = 'quiz_dtl';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'date',
        'time',
        'duration',
        'active',
        'url_slug',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($quiz) {
            $quiz->url_slug = Str::slug($quiz->title);
        });

        static::updating(function ($quiz) {
            $quiz->url_slug = Str::slug($quiz->title);
        });
    }
    // In the Quiz model

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
