<?php

namespace App\Orchid\Layouts;

use App\Models\Pack;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class PackListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'packs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')
                ->render(function (Pack $pack) {
                    return Link::make($pack->title)
                        ->route('platform.pack.edit', $pack);
                }),
                TD::make('commercial_name', 'Commercial name')
                ->render(function (Pack $pack) {
                    return Link::make($pack->commercial_name)
                        ->route('platform.pack.edit', $pack);
                }),
                TD::make('description', 'Description')
                ->render(function (Pack $pack) {
                    return Link::make($pack->description)
                        ->route('platform.pack.edit', $pack);
                }),
                TD::make('price', 'Price')
                ->render(function (Pack $pack) {
                    return Link::make($pack->price)
                        ->route('platform.pack.edit', $pack);
                }),
                TD::make('color', 'Color')
                ->render(function (Pack $pack) {
                    return Link::make($pack->color)
                        ->route('platform.pack.edit', $pack);
                }),
                TD::make('active', 'Activated')
                ->render(function (Pack $pack) {
                    return Link::make($pack->active)
                        ->route('platform.pack.edit', $pack);
                }),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
