<?php

namespace App\DataTables;

use App\Models\RentalUnit;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RentalUnitDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($rentalUnit) {
                $editUrl = route('rental-units.edit', $rentalUnit->id);
                $deleteUrl = route('rental-units.destroy', $rentalUnit->id);
                return "<a href='{$editUrl}' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>
                        <button data-destroy='{$deleteUrl}' class='btn btn-danger btn-sm delete-item'><i class='fas fa-trash-alt'></i></button>";
            })
            ->editColumn('type', function ($rentalUnit) {
                return ucfirst(str_replace('_', ' ', $rentalUnit->type)); // Capitalize and replace underscores with spaces
            })
            ->rawColumns(['action']);
    }

    public function query(RentalUnit $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('rental-units-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(60),
            Column::make('number')->title('Número'),
            Column::make('type')->title('Tipo'),
            Column::make('observations')->title('Observações'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(160)
                  ->addClass('text-center')->title('Ações'),
        ];
    }

    protected function filename(): string
    {
        return 'RentalUnit_' . date('YmdHis');
    }
}
