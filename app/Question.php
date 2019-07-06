<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'type',
        'difficulty',
        'question_category_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($question) {
            $question->update(['created_by' => auth()->id()]);
        });
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $with = ['creator', 'answers'];

    /**
     * Question belongs to a Question Category.
     * 
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id');
    }
 
    /**
     * Question may have one or more Answers.
     * 
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    /**
     * A Question created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * A Question updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    } 

}
