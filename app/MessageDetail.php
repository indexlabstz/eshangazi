<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'description', 
        'thumbnail', 
        'message_id',
        'created_by', 
        'updated_by'
    ];
 
    /**
     * A Message Detail is belong to a Message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    /**
    * Message Detail created by a user.
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function creator()
   {
       return $this->belongsTo(User::class, 'created_by');
   }  

   /**
    * Message Detail updated by a user.
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function updator()
   {
       return $this->belongsTo(User::class, 'updated_by');
   }
}
