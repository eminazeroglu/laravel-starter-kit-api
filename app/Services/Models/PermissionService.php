<?php

namespace App\Services\Models;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\PermissionPivotGroup;
use App\Services\BaseModelService;
use Illuminate\Support\Facades\DB;

class PermissionService extends BaseModelService
{
    protected $slug = 'url';

    public function __construct()
    {
        parent::__construct(new PermissionGroup(), 'Permission');
    }

    public function changeStatus($id, $action = 'is_active')
    {
        $data = $this->model->query()->findOrFail($id);
        if ($data && $data->id !== 1 && $data->id !== 2):
            $data[$action] = !$data[$action];
            $data->save();
            return $this->resource($data, 'one');
        endif;
        return helper()->exception('Not found');
    }

    public function findPaginateList($resource = false): array
    {
        $this->datatable->start();

        $data = $this->model
            ->when(request()->query('name'), function ($q) {
                return $q->where('name', 'like', '%' . request()->query('name') . '%');
            })
            ->latest('id')
            ->paginate(request()->query('limit'));

        return [
            'data'  => $this->resource($data, 'table'),
            'total' => $data->total()
        ];
    }

    public function deleteById($id)
    {
        $item = $this->model->query()->findOrFail($id);
        if ($item->id !== 1 && $item->id !== 2)
            return $item->delete();
        return helper()->exception('Not found');
    }

    public function deleteAll()
    {
        return $this->model->query()->whereNotIn('id', [1, 2])->delete();
    }

    public function getPermissionList($group_id)
    {
        $data = Permission::query()->get()->map(function ($item) use ($group_id) {
            $find       = PermissionPivotGroup::where('permission_id', $item->id)->where('group_id', $group_id)->first();
            $itemOption = collect($item->option)->map(function ($i) {
                return $i['value'];
            });
            $option     = [
                'create' => false,
                'read'   => false,
                'update' => false,
                'delete' => false,
                'action' => false,
            ];
            if ($find):
                $findOption = $find->option_field ? json_decode($find->option_field, true) : [];
                foreach ($itemOption as $value):
                    $option[$value] = $findOption[$value] ?? false;
                endforeach;
            endif;
            return [
                'id'     => $item->id,
                'name'   => $item->name,
                'create' => $option['create'],
                'read'   => $option['read'],
                'update' => $option['update'],
                'delete' => $option['delete'],
                'action' => $option['action'],
            ];
        });
        return $this->resource($data);
    }

    public function setPermissionOptions($id, $request): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        $data = $this->model->query()->findOrFail($id);
        $data->permissions()
            ->wherePermissionId($request->permission_id)
            ->whereGroupId($id)
            ->update([
                'option_field' => json_encode($request->option)
            ]);

        return $data;

        /*DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $data                = PermissionPivotGroup::query()->wherePermissionId($id)->whereGroupId($request->group_id)->first();
        $data                = $data ?? new PermissionPivotGroup();
        $data->permission_id = $id;
        $data->group_id      = $request->group_id;
        $data->option_field  = json_encode($request->option);
        $data->save();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return $data;*/
    }
}
