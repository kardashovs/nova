<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Bill extends Model
{

    use Actionable;

    const MONTHLY = 'Monthly';
    const QUARTERLY = 'Quarterly';
    const YEARLY = 'Yearly';
    const YES = 'Yes';
    const NO = 'No';

    public static function getPaymentDuration()
    {
        return [
          self::MONTHLY => self::MONTHLY,
          self::QUARTERLY => self::QUARTERLY,
          self::YEARLY => self::YEARLY,
        ];
    }

    public static function getNonProfit()
    {
        return [
            self::NO => self::NO,
            self::YES => self::YES,
        ];
    }

    protected $fillable = [
      'server_cost',
      'server_payment_duration',
      'dashboard_cost',
      'dashboard_payment_duration',
      'non_profit',
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
