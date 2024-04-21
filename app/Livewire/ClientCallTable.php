<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\ClientCall;
use App\Models\ClientContact;
use App\Models\User;
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

final class ClientCallTable extends PowerGridComponent
{
    use WithExport;

    public Client $client;

    public string $tableName = 'client_calls';

    public string $sortField = 'call_date';

    public string $sortDirection = 'desc';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),

            Detail::make()->view('employee.client-calls.table-view')
                ->showCollapseIcon(),
        ];
    }

    #[On('client-call-created')]
    public function datasource(): Builder
    {
        return ClientCall::query()->with(['clientContact', 'user'])->where('client_id', $this->client->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('user_id_formatted', function (ClientCall $model) { return $model->user->name ?? '-'; })
            ->add('client_contact_id_formatted', function (ClientCall $model) { return $model->clientContact->name ?? '-'; })
            ->add('call_date_formatted', fn (ClientCall $model) => Carbon::parse($model->call_date)->timezone(auth()->user()->userProfile->timezone)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Created by', 'user_id_formatted', 'user_id')
                ->sortable()
                ->searchable(),
            Column::make('Client contact id', 'client_contact_id_formatted', 'client_contact_id')
                ->sortable()
                ->searchable(),
            Column::make('Call date', 'call_date_formatted', 'call_date')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('user_id_formatted', 'user_id')
                ->dataSource(fn () => User::query()->where('employee', true)->get())
                ->optionLabel('name')
                ->optionValue('id'),

            Filter::select('client_contact_id_formatted', 'client_contact_id')
                ->dataSource(fn () => ClientContact::query()->where('client_id', $this->client->id)->get())
                ->optionLabel('name')
                ->optionValue('id'),

            Filter::datetimepicker('call_date'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
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
