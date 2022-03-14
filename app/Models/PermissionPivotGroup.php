<?php

namespace App\Models;

class PermissionPivotGroup extends BaseModel
{
    public $timestamps = false;

    public function permission(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }

    public function group(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PermissionGroup::class, 'id', 'group_id');
    }
}
