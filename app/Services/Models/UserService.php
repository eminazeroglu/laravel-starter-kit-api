<?php

namespace App\Services\Models;

use App\Models\User;
use App\Services\BaseModelService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService extends BaseModelService
{
    public function __construct()
    {
        $fields = [
            'photo_path' => $this->uploadPhoto(request()->photo_path),
        ];
        if (request()->password) $fields['password'] = bcrypt(request()->password);
        $this->setFields($fields);
        parent::__construct(new User());
    }

    /*
     * Change Status
     * */
    public function changeStatus($id, $action = 'is_active')
    {
        $data = $this->model->query()->findOrFail($id);
        if ($data && $data->email !== 'admin@app.com' && $data->email !== 'support@app.com'):
            $data[$action] = !$data[$action];
            $data->save();
            return $this->resource($data, 'one');
        endif;
        return throw new ModelNotFoundException('Data not found', 404);
    }

    public function findByToken(): \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        return auth()->user();
    }

    public function findPaginateList($resource = false): array
    {
        $data = $this->model
            ->with('permissionGroup:id,translates')
            ->where('email', '!=', 'support@app.com')
            ->when(request()->query('fullname'), function ($q) {
                return $q->fullNameLike(request()->query('fullname'));
            })
            ->when(request()->query('email'), function ($q) {
                return $q->emailLike(request()->query('email'));
            })
            ->when(request()->query('permission'), function ($q) {
                return $q->where('permission_id', request()->query('permission'));
            })
            ->latest('id')
            ->paginate(request()->query('limit'));

        return [
            'data'  => $this->resource($data, 'table'),
            'total' => $data->total()
        ];
    }

    /*
     * Delete By Id
     * */
    public function deleteById($id)
    {
        $item = $this->model->query()->findOrFail($id);
        if ($item->email !== 'admin@app.com' && $item->email !== 'support@app.com')
            return $item->delete();
        return throw new ModelNotFoundException('Data not found', 404);
    }

    /*
     * Delete All
     * */
    public function deleteAll()
    {
        return $this->model->query()->whereNotIn('email', ['admin@app.com', 'support@app.com'])->delete();
    }
}
