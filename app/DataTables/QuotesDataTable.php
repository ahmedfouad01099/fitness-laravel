<?php

namespace App\DataTables;

use App\Models\Quotes;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\DataTableAbstract as DataTable;
use App\Traits\DataTableTrait;

class QuotesDataTable extends DataTable
{
    use DataTableTrait;%")
                  ->orWhere('status', 'like', "%" . $keyword . "%");
        });
    }
    /**
     * Resolve callback parameter instance.
     *
     * @return mixed
     */
    protected function resolveCallbackParameter()
    {
        return $this->query();
    }

    /**
     * Perform default query orderBy clause.
     */
    protected function defaultOrdering(): void
    {
        $this->orderBy('id', 'desc');
    }

    /**
     * Perform global search.
     *
     * @param string $keyword
     */
    protected function globalSearch(string $keyword): void
    {
        $this->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%" . $keyword . "%")
                  ->orWhere('status', 'like', "%" . $keyword . "%");
        });
    }

    /**
     * Get results.
     */
    public function results(): \Illuminate\Support\Collection
    {
        return $this->get();
    }

    /**
     * Count results.
     */
    public function count(): int
    {
        return $this->get()->count();
    }

    /**
     * Count total items.
     */
    public function totalCount(): int
    {
        return $this->query()->count();
    }

    /**
     * Perform filtering.
     */
    public function filtering(): void
    {
        // Implement custom filtering if needed
    }

    /**
     * Perform column search.
     */
    public function columnSearch(): void
    {
        // Implement column-specific search if needed
    }

    /**
     * Perform pagination.
     */
    public function paging(): void
    {
        // Implement custom pagination if needed
    }

    /**
     * Perform sorting of columns.
     */
    public function ordering(): void
    {
        // Implement custom ordering if needed
    }
}    public function make(bool $mDataSupport = true): \Illuminate\Http\JsonResponse { return $this->dataTable($this->query()); }
