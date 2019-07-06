<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $with = ['creator'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'description',
        'thumbnail',
        'gender',
        'minimum_age',
        'display_title',
        'item_category_id',
        'item_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $item->update(['created_by' => auth()->id()]);
        });
    }

    /**
     * An Item belongs to an Item Category.
     * 
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    /**
     * An Item may belong to another parent Item.
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * An Item may have a number of child items.
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'item_id');
    }

    /**
     * An Item created by a user.
     * 
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }  

    /**
     * An Item updated by a user.
     * 
     * @return BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
