<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $editBtn = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.products.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = "<div class='dropdown dropleft d-inline'>
                                <button class='btn btn-primary dropdown-toggle ml-1' type='button' id='dropdownMenuButton2' data-toggle='dropdown'
                                aria-haspopup='true' aria-expanded='false'><i class='fas fa-cog'></i>
                                </button>
                                <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;'>
                                    <a class='dropdown-item has-icon' href='" . route('admin.products-image-gallery.index', ['product' => $query->id]) . "'><i class='bi bi-card-image'></i>Image Gallery</a>
                                    <a class='dropdown-item has-icon' href='" . route('admin.products-variants.index', ['product' => $query->id]) . "'><i class='bi bi-card-list'></i>Variants</a>
                                </div>
                            </div>";

                return $editBtn . $deleteBtn . $moreBtn;
            })
            ->addColumn('image', function ($query) {
                return $image = "<img width='100px' src='" . asset($query->image) . "'>";
            })
            ->addColumn('product_type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return "<i class='badge badge-success'>New Arrival</i>";
                        break;
                    case 'featured_product':
                        return "<i class='badge badge-warning'>Featured</i>";
                        break;
                    case 'top_product':
                        return "<i class='badge badge-info'>Top Product</i>";
                        break;
                    case 'best_product':
                        return "<i class='badge badge-info'>Best Product</i>";
                        break;
                    default:
                        return "<i class='badge badge-danger'>None</i>";
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" checked name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator">';
                } else {
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator">';
                }

                return $button;
            })
            ->rawColumns(['image', 'action', 'product_type', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('price'),
            Column::make('image')->width('150'),
            Column::make('product_type')->width('100'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
