<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyHour;
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

final class CompanyHourTable extends PowerGridComponent
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
            Detail::make()
                ->view('employee.company-hours.table-view')
                ->showCollapseIcon(),
        ];
    }

    #[On('company-hours-created')]
    public function datasource(): Builder
    {
        return CompanyHour::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('title');
    }

    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->searchable()
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('title'),
        ];
    }

    #[\Livewire\Attributes\On('company-hour-edit')]
    public function edit($rowId): void
    {
        $this->dispatch('company-hours-edit', $rowId);
    }

    #[\Livewire\Attributes\On('company-hour-delete')]
    public function delete($rowId) : void
    {
        CompanyHour::find($rowId)->delete();
        $this->dispatch('company-hours-deleted');
    }

    public function actions(CompanyHour $row): array
    {
        $canEdit = auth()->user()->can('companyHours.edit');
        $canDelete = auth()->user()->can('companyHours.delete');

        $buttons = [];

        if ($canEdit) {
            $buttons[] = Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('btn-orange btn-sm rounded')
                ->dispatch('company-hour-edit', ['rowId' => $row->id]);
        }

        if ($canDelete) {
            $buttons[] = Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('btn-red btn-sm rounded')
                ->dispatch('company-hour-delete', ['rowId' => $row->id]);
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
