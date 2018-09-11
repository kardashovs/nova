<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Project extends Model
{
    use Actionable;

    const PENDING = 'Pending';
    const STARTED = 'Started';
    const COMPLETED = 'Completed';

    const HOURLYUPDATES = 'Hourly Updates';
    const WEBSITE = 'Website';
    const VIDEO = 'Video';
    const GRAPHICDESIGN = 'Graphic Design';
    const MATTERPORT = 'Matterport';
    const PHOTOGRAPHY = 'Photography';
    const SEO = 'SEO';
    const GOOGLEPAYPERCLICK = 'Google Pay Per Click';
    const BRANDING = 'Branding';
    const SOCIALMEDIAMARKETING = 'Social Media Marketing';

    const ONE = 1;
    const TWO = 2;
    const THREE = 3;
    const FOUR = 4;
    const FIVE = 5;

    public static function getStatus()
    {
        return [
          self::PENDING => self::PENDING,
          self::STARTED => self::STARTED,
          self::COMPLETED => self::COMPLETED,
        ];
    }

    public static function getType()
    {
        return [
            self::HOURLYUPDATES => self::HOURLYUPDATES,
            self::WEBSITE => self::WEBSITE,
            self::VIDEO => self::VIDEO,
            self::GRAPHICDESIGN => self::GRAPHICDESIGN,
            self::MATTERPORT => self::MATTERPORT,
            self::PHOTOGRAPHY => self::PHOTOGRAPHY,
            self::SEO => self::SEO,
            self::GOOGLEPAYPERCLICK => self::GOOGLEPAYPERCLICK,
            self::BRANDING => self::BRANDING,
            self::SOCIALMEDIAMARKETING => self::SOCIALMEDIAMARKETING,
        ];
    }

    public static function getPriority()
    {
        return [
            self::ONE => self::ONE,
            self::TWO => self::TWO,
            self::THREE => self::THREE,
            self::FOUR => self::FOUR,
            self::FIVE => self::FIVE,
        ];
    }
    protected $casts = [
        'completion_date' => 'date',
    ];


    protected $fillable = [
      'project_name',
      'project_description',
      'project_status',
      'project_type',
      'priority',
      'completion_date',
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
