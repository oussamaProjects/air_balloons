<?php

namespace App\Orchid\Screens;

use App\Models\Pack;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PackEditScreen extends Screen
{

    /**
     * @var Pack
     */
    public $pack;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Pack $pack): iterable
    {
        return [
            'pack' => $pack
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->pack->exists ? 'Edit pack' : 'Creating a new pack';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Packs";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create pack')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->pack->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->pack->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->pack->exists),
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
            Layout::rows([
                Input::make('pack.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this pack.'),

                Input::make('pack.commercial_name')
                    ->title('Commercial name')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this pack.'),
                TextArea::make('pack.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Input::make('pack.price')
                    ->title('Price')
                    ->mask([
                        'alias' => 'currency',
                    ])->help('Some aliases found in the extensions  '),

                Input::make('pack.color')
                    ->type('color')
                    ->title('Color')
                    ->value('#563d7c')
                    ->horizontal(),

                Switcher::make('pack.active')
                    ->sendTrueOrFalse()
                    ->title('Active')
                    ->placeholder('Event for free')
                    ->help('Event for free'),

            ])
        ];
    }

    /**
     * @param Pack    $pack
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Pack $pack, Request $request)
    {
        $pack->fill($request->get('pack'))->save();

        Alert::info('You have successfully created a pack.');

        return redirect()->route('platform.pack.list');
    }

    /**
     * @param Pack $pack
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Pack $pack)
    {
        $pack->delete();

        Alert::info('You have successfully deleted the pack.');

        return redirect()->route('platform.pack.list');
    }
}
