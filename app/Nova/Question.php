<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Question extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Question';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'question';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Game';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'question',
        'type',
        'difficulty',
        'question_category_id',
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
                ->hideFromDetail()
                ->hideWhenUpdating(),

            Text::make('Question')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Question Category', 'category'),

            Select::make('Type')->options([
                'multiple' => 'Multiple',
                'truth' => 'Truth'
            ]),

            Select::make('Difficulty')->options([
                'easy' => 'Easy',
                'medium' => 'Medium',
                'hard' => 'Hard'
            ]),

            HasMany::make('Answers')
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
