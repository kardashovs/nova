<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Contact extends Model
{
    use Actionable;

    protected $fillable = [
      'contact_first_name',
      'contact_last_name',
      'contact_full_name',
      'contact_email',
      'contact_phone',
      'contact_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsToMany(Client::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($lead) {
            $lead->contact_full_name = $lead->contact_first_name . ' ' . $lead->contact_last_name;
        });
    }
}
