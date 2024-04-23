<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\ClientOnboarding;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class ClientOnboardingTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'client_onboardings';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make(),
            Detail::make()
                ->view('employee.client-onboardings.table-view')
                ->showCollapseIcon(),
        ];
    }

    public function datasource(): Builder
    {
        return ClientOnboarding::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('company_id_formatted', fn (ClientOnboarding $model) => $model->company->name)
            ->add('start_date_formatted', fn (ClientOnboarding $model) => Carbon::parse($model->start_date)->timezone(auth()->user()->userProfile->timezone)->format(config('aphii.dateFormat')))
            ->add('end_date_formatted', fn (ClientOnboarding $model) => (!is_null($model->end_date)) ? Carbon::parse($model->end_date)->timezone(auth()->user()->userProfile->timezone)->format(config('aphii.dateFormat')) : '')
            ->add('completed');
    }

    public function columns(): array
    {
        return [
            Column::make('Company', 'company_id_formatted'),
            Column::make('Start date', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('End date', 'end_date_formatted', 'end_date')
                ->sortable(),

            Column::make('Notes', 'notes')
                ->sortable()
                ->hidden(true)
                ->searchable(),

            Column::make('Completed', 'completed')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

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

    public function actions(ClientOnboarding $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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
