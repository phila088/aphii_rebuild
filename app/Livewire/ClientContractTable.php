<?php

namespace App\Livewire;

use App\Models\ClientContract;
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

final class ClientContractTable extends PowerGridComponent
{
    use WithExport;

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

    #[On('client-contract-created')]
    public function datasource(): Builder
    {
        return ClientContract::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('company_id_formatted', fn (ClientContract $model) => $model->company->name)
            ->add('contract_number')
            ->add('start_date_formatted', fn (ClientContract $model) => Carbon::parse($model->start_date)->timezone(auth()->user()->userProfile->timezone)->format('d/m/Y'))
            ->add('end_date_formatted', fn (ClientContract $model) => Carbon::parse($model->end_date)->timezone(auth()->user()->userProfile->timezone)->format('d/m/Y'))
            ->add('payment_term_id_formatted', fn (ClientContract $model) => $model->paymentTerm->code);
    }

    public function columns(): array
    {
        return [
            Column::make('Company', 'company_id_formatted'),
            Column::make('Contract number', 'contract_number')
                ->sortable()
                ->searchable(),

            Column::make('Start date', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('End date', 'end_date_formatted', 'end_date')
                ->sortable(),

            Column::make('Payment term id', 'payment_term_id_formatted'),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('start_date'),
            Filter::datepicker('end_date'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[On('client-contract-delete')]
    public function delete($rowId): void
    {
        ClientContract::find($rowId)->delete();
    }

    public function actions(ClientContract $row): array
    {
        $canDelete = auth()->user()->can('companyContacts.delete');

        $buttons = [];

        if ($canDelete) {
            $buttons[] = Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('btn-red btn-sm rounded')
                ->dispatch('client-contract-delete', ['rowId' => $row->id]);
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
