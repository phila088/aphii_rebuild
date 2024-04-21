<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyEmail;
use App\Models\CompanyPhone;
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

final class CompanyPhoneNumberTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'company_phone_numbers';

    public Company $company;

    public array $title;

    public array $phone;

    public array $extension;

    protected array $rules = [
        'title.*' => ['required'],
        'phone.*' => ['required', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/'],
        'extension.*' => ['nullable', 'regex:/^[0-9]{1,10}$/'],
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

    #[On('company-phone-created')]
    public function datasource(): Builder
    {
        return CompanyPhone::query()->where('company_id', $this->company->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('title')
            ->add('phone')
            ->add('extension');
    }

    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::make('Extension', 'extension')
                ->sortable()
                ->searchable()
                ->editOnClick(),

            Column::action('Action')
        ];
    }

    public function onUpdatedEditable(int|string $id, string $field, string $value): void
    {
        if (!empty($id)) {
            $phone = CompanyPhone::find($id);

            if (!is_null($phone)) {
                $this->validate();

                $phone->update([$field => $value]);
                $this->dispatch('company-phone-updated');
            }
        }
    }

    public function filters(): array
    {
        return [
            Filter::inputText('phone', 'Phone number'),
            Filter::inputText('extension', 'Extension'),
        ];
    }

    #[\Livewire\Attributes\On('company-phone-delete')]
    public function delete($rowId) : void
    {
        CompanyPhone::find($rowId)->delete();
        $this->dispatch('company-phone-deleted');
    }

    public function actions(CompanyPhone $row): array
    {
        $canDelete = auth()->user()->can('company-email-delete');

        if (empty($row->deleted_at)) {
            if ($canDelete) {
                return [
                    Button::add('delete')
                        ->slot('Delete')
                        ->id()
                        ->class('btn-red btn-sm rounded')
                        ->dispatch('company-phone-delete', ['rowId' => $row->id]),
                ];
            } else {
                return [];
            }
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
