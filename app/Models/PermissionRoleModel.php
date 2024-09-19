<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleModel extends Model
{
    use HasFactory;

    protected $table = 'permision_role_models';
    static public function InsertUpdateRecord($permission_ids, $role_id)
    {
        PermissionRoleModel::where('role_id', '=', $role_id)->delete();
        foreach($permission_ids as $permission_id)
        {
            $save = new PermissionRoleModel;
            $save->permission_id = $permission_id;
            $save->role_id = $role_id;
            $save->save();
        }
    }

    static public function getRolePermission($role_id)
    {
        return PermissionRoleModel::where('role_id', '=', $role_id)->get();
    }

    static public function getPermission($slug, $role_id)
    {
        return PermissionRoleModel::select('permision_role_models.id')
        ->join('permission_models', 'permission_models.id', '=', 'permision_role_models.permission_id')
        ->where('permision_role_modelS.role_id', '=', $role_id)
        ->where('permission_models.slug', '=', $slug)
        ->count();
    }
}
