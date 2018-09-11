<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Server extends Model
{
    use Actionable;

    protected $fillable = [
      'company_name',
      'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsToMany(Client::class);
    }

}
