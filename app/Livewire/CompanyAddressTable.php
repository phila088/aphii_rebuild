<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CompanyAddressTable extends PowerGridComponent
{
    use WithExport;

    public Company $company;

    public bool $multiSort = true;

    public string $sortField = "title";

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

    #[On('company-address-created')]
    #[On('company-address-updated')]
    #[On('company-address-deleted')]
    public function datasource(): Builder
    {
        return CompanyAddress::query()->where('company_id', $this->company->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        $address = '';


        return PowerGrid::fields()
            ->add('title')
            ->add('address', fn (CompanyAddress $model) => (empty($model->po_box)) ? $model->building_number . ' ' . ((!empty($model->pre_direction)) ? $model->pre_direction . ' ' . $model->street_name : $model->street_name) . ' ' . $model->street_type . ', ' . ((!empty($model->unit_type)) ? $model->unit_type . ' ' . $model->unit . ' ' : '') . $model->city . ', ' . $model->state . ' ' . $model->zip : $model->po_box . ', ' . $model->city . ', ' . $model->state . ' ' . $model->zip);
    }

    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address'),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('title')
        ];
    }

    #[\Livewire\Attributes\On('company-address-edit')]
    public function edit($rowId): void
    {
        $this->dispatch('company-addresses-edit', $rowId);
    }

    #[\Livewire\Attributes\On('company-address-delete')]
    public function delete($rowId) : void
    {
        CompanyAddress::find($rowId)->delete();
        $this->dispatch('company-addresses-deleted');
    }

    public function actions(CompanyAddress $row): array
    {
        $canEdit = auth()->user()->can('companyAddresses.edit');
        $canDelete = auth()->user()->can('companyAddresses.delete');

        $buttons = [];

        if ($canEdit) {
            $buttons[] = Button::add('edit')
                            ->slot('Edit')
                            ->id()
                            ->class('btn-orange btn-sm rounded')
                            ->dispatch('company-address-edit', ['rowId' => $row->id]);
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
