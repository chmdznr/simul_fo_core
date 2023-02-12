<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 26,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 27,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 28,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 29,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 30,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 31,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 32,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 33,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 34,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 35,
                'title' => 'asset_create',
            ],
            [
                'id'    => 36,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 37,
                'title' => 'asset_show',
            ],
            [
                'id'    => 38,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 39,
                'title' => 'asset_access',
            ],
            [
                'id'    => 40,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 41,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 43,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 44,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 45,
                'title' => 'site_point_create',
            ],
            [
                'id'    => 46,
                'title' => 'site_point_edit',
            ],
            [
                'id'    => 47,
                'title' => 'site_point_show',
            ],
            [
                'id'    => 48,
                'title' => 'site_point_delete',
            ],
            [
                'id'    => 49,
                'title' => 'site_point_access',
            ],
            [
                'id'    => 50,
                'title' => 'asset_condition_create',
            ],
            [
                'id'    => 51,
                'title' => 'asset_condition_edit',
            ],
            [
                'id'    => 52,
                'title' => 'asset_condition_show',
            ],
            [
                'id'    => 53,
                'title' => 'asset_condition_delete',
            ],
            [
                'id'    => 54,
                'title' => 'asset_condition_access',
            ],
            [
                'id'    => 55,
                'title' => 'segment_connected_create',
            ],
            [
                'id'    => 56,
                'title' => 'segment_connected_edit',
            ],
            [
                'id'    => 57,
                'title' => 'segment_connected_show',
            ],
            [
                'id'    => 58,
                'title' => 'segment_connected_delete',
            ],
            [
                'id'    => 59,
                'title' => 'segment_connected_access',
            ],
            [
                'id'    => 60,
                'title' => 'core_config_create',
            ],
            [
                'id'    => 61,
                'title' => 'core_config_edit',
            ],
            [
                'id'    => 62,
                'title' => 'core_config_show',
            ],
            [
                'id'    => 63,
                'title' => 'core_config_delete',
            ],
            [
                'id'    => 64,
                'title' => 'core_config_access',
            ],
            [
                'id'    => 65,
                'title' => 'core_connection_create',
            ],
            [
                'id'    => 66,
                'title' => 'core_connection_edit',
            ],
            [
                'id'    => 67,
                'title' => 'core_connection_show',
            ],
            [
                'id'    => 68,
                'title' => 'core_connection_delete',
            ],
            [
                'id'    => 69,
                'title' => 'core_connection_access',
            ],
            [
                'id'    => 70,
                'title' => 'fo_connection_access',
            ],
            [
                'id'    => 71,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
