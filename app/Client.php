<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Client extends Model
{

    use Actionable;

    const ACTIVE = 'Active';
    const DEACTIVE = 'Deactive';
    const PROSPECT = 'Prospect';

    public static function getStatus()
    {
        return [
            self::PROSPECT => self::PROSPECT,
            self::ACTIVE => self::ACTIVE,
            self::DEACTIVE => self::DEACTIVE,
        ];
    }

    protected $fillable = [
        'client_name',
        'client_status',
        'address',
        'address_2',
        'city',
        'state',
        'postal_code',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->belongsToMany(Contact::class);
    }

    public function server()
    {
        return $this->belongsToMany(Server::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }

    public function domain()
    {
        return $this->hasMany(Domain::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
