<?php

namespace App\Livewire;

use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Facades\Rule;

final class ClientTable extends PowerGridComponent
{
    use WithExport;

    public bool $multiSort = true;

    public string $sortField = 'name';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
        ];
    }

    public function datasource(): Builder
    {
        return Client::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name')
            ->add('abbreviation')
            ->add('status', fn (Client $model) => $model->status);
    }

    public function columns(): array
    {

        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Abbreviation', 'abbreviation')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::inputText('abbreviation')
        ];
    }

    #[\Livewire\Attributes\On('client-edit')]
    public function edit($rowId): void
    {
        redirect()->route('employee.clients.edit', $rowId);
    }

    public function actions(Client $row): array
    {
        $canEdit = auth()->user()->can('clients.edit');

        $canDelete = auth()->user()->can('clients.delete');

        $buttons = [];

        if ($canEdit) {
            $buttons[] = Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('btn-orange btn-sm rounded')
                ->dispatch('client-edit', ['rowId' => $row->id]);
        }

        if ($canDelete) {
            $buttons[] = Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('btn-red btn-sm rounded')
                ->dispatch('company-address-delete', ['rowId' => $row->id]);
        }

        return $buttons;
    }

    public function actionRules(): array
    {
        return [
            Rule::rows()
                ->when(function ($client) {
                    return $client->status === 'ACTIVE';
                })
                ->setAttribute('class', 'bg-green-200 dark:bg-green-800'),

            Rule::rows()
                ->when(function ($client) {
                    return $client->status === 'DNUXXX';
                })
                ->setAttribute('class', 'bg-red-200'),

            Rule::rows()
                ->when(function ($client) {
                    return $client->status === 'INACTV';
                })
                ->setAttribute('class', 'bg-orange-200'),

            Rule::rows()
                ->when(function ($client) {
                    return $client->status === 'ONBRDG';
                })
                ->setAttribute('class', 'bg-blue-200'),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
