<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Domain extends Model
{

    use Actionable;

    protected $casts = [
        'expires' => 'date',
    ];

    const TURNKEYDIGITAL = 'TurnKey Digital';
    const CLIENT = 'Client';

    public static function managedStatus()
    {
        return [
          self::TURNKEYDIGITAL => self::TURNKEYDIGITAL,
          self::CLIENT => self::CLIENT,
        ];
    }

    protected $fillable = [
        'domain_name',
        'domain_company',
        'expires',
        'managed_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
