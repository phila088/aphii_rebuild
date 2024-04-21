<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyEmail;
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

final class CompanyEmailTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'company_emails';

    public Company $company;

    public bool $multiSort = true;

    public string $sortField = "title";

    public array $title;

    public array $email;

    protected array $rules = [
        'title.*' => ['required'],
        'email.*' => ['required', 'email:rfc,dns,spoof,filter'],
    ];

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make(),
        ];
    }

    #[On('company-email-created')]
    #[On('company-email-deleted')]
    public function datasource(): Builder
    {
        return CompanyEmail::query()->where('company_id', $this->company->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('title')
            ->add('email');
    }

    public function columns(): array
    {
        $canEdit = auth()->user()->can('company-email-edit');

        return [
            Column::make('Title', 'title')
                ->searchable()
                ->editOnClick($canEdit)
                ->sortable(),

            Column::make('Email', 'email')
                ->searchable()
                ->editOnClick($canEdit)
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function onUpdatedEditable(int|string $id, string $field, string $value): void
    {
        if (!empty($id)) {
            $this->validate();

            CompanyEmail::find($id)->update([$field => $value]);
            $this->dispatch('company-email-update');
        }
    }

    public function filters(): array
    {
        return [
            Filter::inputText('title'),
            Filter::inputText('email'),
        ];
    }

    #[\Livewire\Attributes\On('company-email-delete')]
    public function delete($rowId) : void
    {
        CompanyEmail::find($rowId)->delete();
        $this->dispatch('company-email-deleted');
    }

    public function actions(CompanyEmail $row): array
    {
        $canDelete = auth()->user()->can('company-email-delete');

        if ($canDelete) {
            return [
                Button::add('delete')
                    ->slot('Delete')
                    ->id()
                    ->class('btn-red btn-sm rounded')
                    ->dispatch('company-email-delete', ['rowId' => $row->id]),
            ];
        } else {
            return [];
        }
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
