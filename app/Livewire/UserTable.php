<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\QueryException;
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

final class UserTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'usersTable';

    public bool $multiSort = true;

    public bool $showFilters = true;

    public function setUp(): array
    {
        $this->showCheckBox();

        $this->persist(['columns', 'filters']);

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
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('active')
            ->add('locked')
            ->add('client')
            ->add('employee')
            ->add('technician')
            ->add('vendor')
            ->add('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('First name', 'first_name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Last name', 'last_name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Active', 'active')
                ->sortable()
                ->searchable()
                ->toggleable(true, 'Active', 'Inactive'),

            Column::make('Locked', 'locked')
                ->sortable()
                ->searchable()
                ->toggleable(true, 'Locked', 'Unlocked'),

            Column::make('Client', 'client')
                ->sortable()
                ->searchable()
                ->toggleable(true, 'Yes', 'No'),

            Column::make('Employee', 'employee')
                ->sortable()
                ->searchable()
                ->toggleable(true, 'Yes', 'No'),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('email'),
            Filter::boolean('active'),
            Filter::boolean('locked'),
        ];
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn-orange btn-sm rounded-md')
                ->route('admin.users.edit', ['id' => $row->id])
        ];
    }

    public function onUpdatedEditable(int|string $id, string $field, string $value): void
    {
        User::query()->find($id)->update([$field => $value]);
    }

    public function onUpdatedToggleable(int|string $id, string $field, string $value): void
    {
        User::query()->find($id)->update([$field => $value]);
    }
}
