<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Document;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
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

final class ClientDocumentTable extends PowerGridComponent
{
    use WithExport;

    public Client $client;

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
        return Document::query()->where('client_id', $this->client->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('document_category_id_formatted', fn (Document $model) => $model->documentCategory->name)
            ->add('title')
            ->add('description')
            ->add('path', function (Document $model) {
                return '<a href="' . config('app.url') . '/' . $model->path . '" target="_blank">Link</a>';
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Category', 'document_category_id_formatted')
                ->searchable()
                ->sortable(),

            Column::make('Title', 'title')
                ->searchable()
                ->sortable(),
            Column::make('Description', 'description')
                ->searchable()
                ->sortable(),
            Column::make('Link', 'path'),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[On('client-document-delete')]
    public function delete($rowId): void
    {
        Document::find($rowId)->delete();
    }

    public function actions(Document $row): array
    {
        $canDelete = auth()->user()->can('companyContacts.delete');

        $buttons = [];

        if ($canDelete) {
            $buttons[] = Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('btn-red btn-sm rounded')
                ->dispatch('client-document-delete', ['rowId' => $row->id]);
        }

        return $buttons;
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
