<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'name',
        'bio',
        'email',
        'phone',
        'address',
        'partner_category_id',
        'district_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Partner belongs to a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Partner belongs to a category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PartnerCategory::class, 'partner_category_id');
    }

    /**
     * Partner belongs to a district.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Partner belongs to a category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
