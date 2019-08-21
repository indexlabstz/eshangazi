<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Item extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Item';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'description',
        'thumbnail',
        'gender',
        'minimum_age',
        'display_title',
        'item_category_id',
        'item_id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()
                ->hideFromIndex()
                ->hideWhenUpdating()
                ->hideFromDetail(),

            Image::make('Thumbnail')
                ->disk('eShangazi', 'public'),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Item Category', 'category'),

            Text::make('Display Title')
                ->hideFromIndex()
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Gender')->options([
                'male' => 'Male',
                'female' => 'Female',
                'both' => 'Both'
            ]),

            Text::make('Minimum Age')
                ->hideFromIndex()
                ->sortable()
                ->rules('required', 'numeric'),

            BelongsTo::make('Item', 'item')
                ->searchable()
                ->prepopulate()
                ->nullable(),

            Textarea::make('Description')
                ->hideFromIndex(),

            HasMany::make('Items')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
