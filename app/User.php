<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * User owns one or more Ads.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * User create/update one or more Answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

    /**
     * User create/update one or more Centers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centers()
    {
        return $this->hasMany(Center::class);
    }

    /**
     * User create/update one or more Charges.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    /**
     * User create/update one or more Countries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    /**
     * User create/update one or more Charges.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    /**
     * User create/update one or more Item Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item_categories()
    {
        return $this->hasMany(ItemCetegory::class);
    }

    /**
     * User create/update one or more Items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * User create/update one or more Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * User create/update one or more Message Details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function message_details()
    {
        return $this->hasMany(MessageDetail::class);
    }

    /**
     * User create/update one or more Partner Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partner_categories()
    {
        return $this->hasMany(PartnerCategory::class);
    }

    /**
     * User create/update one or more Partners.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    /**
     * User create/update one or more Payments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * User create/update one or more Platforms.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function platforms()
    {
        return $this->hasMany(Platform::class);
    }

    /**
     * User create/update one or more Question Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function question_categories()
    {
        return $this->hasMany(QuestionCategory::class);
    }

    /**
     * User create/update one or more Questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * User create/update one or more Services.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * User create/update one or more Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function targets()
    {
        return $this->hasMany(Target::class);
    }

    /**
     * User create/update one or more Wards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
