<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Bill extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Bill';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            BelongsTo::make('Client'),
            Number::make('Server Cost', 'server_cost', function ($value) {
                return '$' . number_format($value, 2);
            })->step(0.01),
            Select::make('Duration', 'server_payment_duration')->options(\App\Bill::getPaymentDuration())->hideFromIndex(),
            Number::make('Dashboard Cost', 'dashboard_cost', function ($value) {
                return '$' . number_format($value, 2);
            })->step(0.01),
            Select::make('Duration', 'dashboard_payment_duration')->options(\App\Bill::getPaymentDuration())->hideFromIndex(),
            Select::make('Non-Profit', 'non_profit')->options(\App\Bill::getNonProfit()),
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
