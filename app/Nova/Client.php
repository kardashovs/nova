<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Client';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'client_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'client_name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->onlyOnForms(),
            BelongsTo::make('User')->onlyOnForms(),
            Text::make('Name', 'client_name')->sortable()->rules('required', 'string'),
            Select::make('Status', 'client_status')->sortable()->options(\App\Client::getStatus())->rules('required'),
            new Panel('Address Information', $this->addressFields()),
            HasMany::make('Contact')->sortable(),
            HasMany::make('Domain'),
            HasMany::make('Server')->sortable(),
            HasMany::make('Project')->sortable(),
            HasOne::make('Bill'),
            Markdown::make('Notes')->hideFromIndex(),
        ];
    }

    protected function addressFields()
    {
        return [
            Place::make('Address')->rules('required', 'string')->hideFromIndex(),
            Text::make('Address 2')->hideFromIndex(),
            Text::make('City')->sortable()->rules('required', 'string'),
            Text::make('State')->sortable()->rules('required', 'string')->hideFromIndex(),
            Text::make('Zip Code', 'postal_code')->rules('required')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new Metrics\NewClients,
            new Metrics\ProspectsPerDay,
            new Metrics\ClientStatus,
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\ClientStatusType,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
