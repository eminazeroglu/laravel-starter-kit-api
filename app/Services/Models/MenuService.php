<?php

namespace App\Services\Models;

use App\Models\Menu;
use App\Services\BaseModelService;

class MenuService extends BaseModelService
{
    public function __construct()
    {
        parent::__construct(new Menu(), 'Menu');
    }

    public function findPaginateList($resource = false): array
    {
        $this->datatable->start();

        $data = $this->model->query()
            ->when(request()->query('name'), function ($q) {
                return $q->nameLike(request()->query('name'));
            })
            ->oldest('position')
            ->paginate(request()->query('limit'));

        return [
            'data'  => $this->resource($data, 'table'),
            'total' => $data->total()
        ];
    }
}
