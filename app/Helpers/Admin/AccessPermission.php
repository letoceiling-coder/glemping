<?php


namespace App\Helpers\Admin;


class AccessPermission
{
    const ACCESS = [
        'delete' => 900,
        'create' => 500,
        'update' => 900,
        'show' => 500,
    ];
    static public function isDelete($role): bool
    {

        return self::ACCESS['delete'] > $role;
    }
}
