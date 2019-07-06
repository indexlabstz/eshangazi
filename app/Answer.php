<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{ 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer', 
        'correct',
        'question_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->update(['created_by' => auth()->id()]);
        });
    }

    /**
     * An Answer belongs to a Question.
     * 
     * @return BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    /**
     * An Answer is created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    

    /**
     * An Answer can be updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
