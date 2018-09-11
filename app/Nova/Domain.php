<?php

namespace App\Nova;

use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Domain extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Domain';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'domain_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'domain_name',
        'domain_company',
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
            BelongsTo::make('Client')->sortable(),
            Text::make('Domain Name')->sortable()->rules('required', 'string'),
            Text::make('Registrar', 'domain_company')->sortable()->rules('required', 'string'),
            Date::make('Expires')->resolveUsing(function ($date) {
                return $date->format('n-d-Y');
            })->sortable(),
            Select::make('Managed By')->options(\App\Domain::managedStatus())->sortable()->rules('required'),
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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
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
