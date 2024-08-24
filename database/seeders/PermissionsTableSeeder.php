<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $permissions = [

            // Roles
            ['group' => 'roles', 'name' => 'view_roles', 'title' => 'View Roles', 'guard_name' => 'web'],
            ['group' => 'roles', 'name' => 'add_role', 'title' => 'Add Role', 'guard_name' => 'web'],
            ['group' => 'roles', 'name' => 'edit_role', 'title' => 'Edit Role', 'guard_name' => 'web'],
            ['group' => 'roles', 'name' => 'delete_role', 'title' => 'Delete Role', 'guard_name' => 'web'],

            // Users
            ['group' => 'users', 'name' => 'view_users', 'title' => 'View Users', 'guard_name' => 'web'],
            ['group' => 'users', 'name' => 'add_user', 'title' => 'Add User', 'guard_name' => 'web'],
            ['group' => 'users', 'name' => 'edit_user', 'title' => 'Edit User', 'guard_name' => 'web'],
            ['group' => 'users', 'name' => 'delete_user', 'title' => 'Delete User', 'guard_name' => 'web'],

            // Leads
            ['group' => 'leads', 'name' => 'view_leads', 'title' => 'View Leads', 'guard_name' => 'web'],
            ['group' => 'leads', 'name' => 'add_leads', 'title' => 'Add Lead', 'guard_name' => 'web'],
            ['group' => 'leads', 'name' => 'edit_leads', 'title' => 'Edit Lead', 'guard_name' => 'web'],
            ['group' => 'leads', 'name' => 'delete_leads', 'title' => 'Delete Lead', 'guard_name' => 'web'],

            // Appointments
            ['group' => 'appointments', 'name' => 'view_appointments', 'title' => 'View Appointments', 'guard_name' => 'web'],
            ['group' => 'appointments', 'name' => 'add_appointments', 'title' => 'Add Appointment', 'guard_name' => 'web'],
            ['group' => 'appointments', 'name' => 'edit_appointments', 'title' => 'Edit Appointment', 'guard_name' => 'web'],
            ['group' => 'appointments', 'name' => 'delete_appointments', 'title' => 'Delete Appointment', 'guard_name' => 'web'],
            ['group' => 'appointments', 'name' => 'send_sms_appointments', 'title' => 'Send Mails', 'guard_name' => 'web'],

            // Technicians
            ['group' => 'technicians', 'name' => 'view_technicians', 'title' => 'View Technicians', 'guard_name' => 'web'],
            ['group' => 'technicians', 'name' => 'add_technicians', 'title' => 'Add Technician', 'guard_name' => 'web'],
            ['group' => 'technicians', 'name' => 'edit_technicians', 'title' => 'Edit Technician', 'guard_name' => 'web'],
            ['group' => 'technicians', 'name' => 'delete_technicians', 'title' => 'Delete Technician', 'guard_name' => 'web'],

            // Reports
            ['group' => 'reports', 'name' => 'view_reports', 'title' => 'View Reports', 'guard_name' => 'web'],
            ['group' => 'reports', 'name' => 'add_reports', 'title' => 'Add Report', 'guard_name' => 'web'],
            ['group' => 'reports', 'name' => 'edit_reports', 'title' => 'Edit Report', 'guard_name' => 'web'],
            ['group' => 'reports', 'name' => 'delete_reports', 'title' => 'Delete Report', 'guard_name' => 'web'],

            // Tasks
            ['group' => 'tasks', 'name' => 'view_tasks', 'title' => 'View Tasks', 'guard_name' => 'web'],
            ['group' => 'tasks', 'name' => 'add_tasks', 'title' => 'Add Task', 'guard_name' => 'web'],
            ['group' => 'tasks', 'name' => 'edit_tasks', 'title' => 'Edit Task', 'guard_name' => 'web'],
            ['group' => 'tasks', 'name' => 'delete_tasks', 'title' => 'Delete Task', 'guard_name' => 'web'],

             // JobTypes
             ['group' => 'reports', 'name' => 'view_jobtypes', 'title' => 'View Job Types', 'guard_name' => 'web'],
             ['group' => 'reports', 'name' => 'add_jobtypes', 'title' => 'Add Job Types', 'guard_name' => 'web'],
             ['group' => 'reports', 'name' => 'edit_jobtypes', 'title' => 'Edit Job Types', 'guard_name' => 'web'],
             ['group' => 'reports', 'name' => 'delete_jobtypes', 'title' => 'Delete Job Types', 'guard_name' => 'web'],

        ];
        Permission::insert($permissions);
    }
}
