<?php

namespace App\Services\Models;

use App\Models\Menu;
use App\Services\BaseModelService;

class MenuService extends BaseModelService
{
    public function __construct()
    {
        parent::__construct(new Menu());
    }

    public function findPaginateList($resource = false): array
    {
        $data = $this->model->query()
            ->when(request()->query('q'), function ($q) {
                return $q->nameLike(request()->query('q'));
            })
            ->oldest('position')
            ->paginate(request()->query('limit'));

        return [
            'data'  => $this->resource($data, 'table'),
            'total' => $data->total()
        ];
    }

    public function webRoutes()
    {
        $routes = $this->model->query()->active()->get();
        return $routes->map(function ($i) {
            return [
                'route'      => $i->link,
                'controller' => $i->link === '/' ? 'index' : ltrim($i->link, '/')
            ];
        });
    }
}
