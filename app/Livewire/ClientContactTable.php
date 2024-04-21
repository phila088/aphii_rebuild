<?php

namespace App\Livewire;

use App\Models\ClientContact;
use App\Models\ContactPosition;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ClientContactTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'client_contacts';

    public array $position;
    public array $first_name;
    public array $last_name;
    public array $email;
    public array $phone;
    public array $phone_extension;

    protected array $rules = [
        'position.*' => ['required', 'string'],
        'first_name.*' => ['required', 'string'],
        'last_name.*' => ['required', 'string'],
        'email.*' => ['required', 'email:rfc,spoof,dns,filter'],
        'phone.*' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/'],
        'phone_extension.*' => ['required', 'string', 'regex:/^[0-9]{1,6}$/'],
    ];

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

    #[On('client-contact-created')]
    public function datasource(): Builder
    {
        return ClientContact::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('position')
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('phone')
            ->add('phone_extension');
    }

    public function columns(): array
    {
        $canEdit = auth()->user()->can('companyContacts.edit');

        return [
            Column::make('Position', 'position')
                ->sortable()
                ->searchable()
                ->editOnClick($canEdit),

            Column::make('First name', 'first_name')
                ->sortable()
                ->searchable()
                ->editOnClick($canEdit),

            Column::make('Last name', 'last_name')
                ->sortable()
                ->searchable()
                ->editOnClick($canEdit),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable()
                ->editOnClick($canEdit),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable()
                ->editOnClick($canEdit),

            Column::make('Phone extension', 'phone_extension')
                ->sortable()
                ->searchable()
                ->editOnClick($canEdit),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }

    public function onUpdatedEditable(int|string $id, string $field, string $value): void
    {
        $this->validate();

        ClientContact::find($id)->update([$field => $value]);

        if ($field === 'position' && !ContactPosition::where('name', $value)->exists()) {
            ContactPosition::create(['name' => $value]);
        }
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[On('client-contact-delete')]
    public function delete($rowId): void
    {
        ClientContact::find($rowId)->delete();
        $this->dispatch('client-contact-deleted');
    }

    public function actions(ClientContact $row): array
    {
        $canDelete = auth()->user()->can('companyContacts.delete');

        $buttons = [];

        if ($canDelete) {
            $buttons[] = Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('btn-red btn-sm rounded')
                ->dispatch('client-contact-delete', ['rowId' => $row->id]);
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
