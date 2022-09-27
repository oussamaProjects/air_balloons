<?php

namespace App\Orchid\Screens;

use App\Models\Pack;

use App\Orchid\Layouts\PackListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PackListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'packs' => Pack::paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Packs List';
    }

     /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All packs";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.pack.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            PackListLayout::class
        ];
    }
}
