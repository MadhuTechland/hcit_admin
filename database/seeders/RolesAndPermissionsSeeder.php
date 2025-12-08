<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'dashboard.view', 'group' => 'Dashboard', 'description' => 'Access the admin dashboard'],

            // Users Management
            ['name' => 'View Users', 'slug' => 'users.view', 'group' => 'Users', 'description' => 'View list of users'],
            ['name' => 'Create Users', 'slug' => 'users.create', 'group' => 'Users', 'description' => 'Create new users'],
            ['name' => 'Edit Users', 'slug' => 'users.edit', 'group' => 'Users', 'description' => 'Edit existing users'],
            ['name' => 'Delete Users', 'slug' => 'users.delete', 'group' => 'Users', 'description' => 'Delete users'],

            // Roles Management
            ['name' => 'View Roles', 'slug' => 'roles.view', 'group' => 'Roles', 'description' => 'View list of roles'],
            ['name' => 'Create Roles', 'slug' => 'roles.create', 'group' => 'Roles', 'description' => 'Create new roles'],
            ['name' => 'Edit Roles', 'slug' => 'roles.edit', 'group' => 'Roles', 'description' => 'Edit existing roles'],
            ['name' => 'Delete Roles', 'slug' => 'roles.delete', 'group' => 'Roles', 'description' => 'Delete roles'],

            // Permissions Management
            ['name' => 'View Permissions', 'slug' => 'permissions.view', 'group' => 'Permissions', 'description' => 'View list of permissions'],
            ['name' => 'Create Permissions', 'slug' => 'permissions.create', 'group' => 'Permissions', 'description' => 'Create new permissions'],
            ['name' => 'Edit Permissions', 'slug' => 'permissions.edit', 'group' => 'Permissions', 'description' => 'Edit existing permissions'],
            ['name' => 'Delete Permissions', 'slug' => 'permissions.delete', 'group' => 'Permissions', 'description' => 'Delete permissions'],

            // Blogs Management
            ['name' => 'View Blogs', 'slug' => 'blogs.view', 'group' => 'Blogs', 'description' => 'View list of blogs'],
            ['name' => 'Create Blogs', 'slug' => 'blogs.create', 'group' => 'Blogs', 'description' => 'Create new blogs'],
            ['name' => 'Edit Blogs', 'slug' => 'blogs.edit', 'group' => 'Blogs', 'description' => 'Edit existing blogs'],
            ['name' => 'Delete Blogs', 'slug' => 'blogs.delete', 'group' => 'Blogs', 'description' => 'Delete blogs'],

            // News Management
            ['name' => 'View News', 'slug' => 'news.view', 'group' => 'News', 'description' => 'View list of news'],
            ['name' => 'Create News', 'slug' => 'news.create', 'group' => 'News', 'description' => 'Create new news'],
            ['name' => 'Edit News', 'slug' => 'news.edit', 'group' => 'News', 'description' => 'Edit existing news'],
            ['name' => 'Delete News', 'slug' => 'news.delete', 'group' => 'News', 'description' => 'Delete news'],

            // Case Studies Management
            ['name' => 'View Case Studies', 'slug' => 'case-studies.view', 'group' => 'Case Studies', 'description' => 'View list of case studies'],
            ['name' => 'Create Case Studies', 'slug' => 'case-studies.create', 'group' => 'Case Studies', 'description' => 'Create new case studies'],
            ['name' => 'Edit Case Studies', 'slug' => 'case-studies.edit', 'group' => 'Case Studies', 'description' => 'Edit existing case studies'],
            ['name' => 'Delete Case Studies', 'slug' => 'case-studies.delete', 'group' => 'Case Studies', 'description' => 'Delete case studies'],

            // Industries Management
            ['name' => 'View Industries', 'slug' => 'industries.view', 'group' => 'Industries', 'description' => 'View list of industries'],
            ['name' => 'Create Industries', 'slug' => 'industries.create', 'group' => 'Industries', 'description' => 'Create new industries'],
            ['name' => 'Edit Industries', 'slug' => 'industries.edit', 'group' => 'Industries', 'description' => 'Edit existing industries'],
            ['name' => 'Delete Industries', 'slug' => 'industries.delete', 'group' => 'Industries', 'description' => 'Delete industries'],

            // Services Management
            ['name' => 'View Services', 'slug' => 'services.view', 'group' => 'Services', 'description' => 'View list of services'],
            ['name' => 'Create Services', 'slug' => 'services.create', 'group' => 'Services', 'description' => 'Create new services'],
            ['name' => 'Edit Services', 'slug' => 'services.edit', 'group' => 'Services', 'description' => 'Edit existing services'],
            ['name' => 'Delete Services', 'slug' => 'services.delete', 'group' => 'Services', 'description' => 'Delete services'],

            // Products Management
            ['name' => 'View Products', 'slug' => 'products.view', 'group' => 'Products', 'description' => 'View list of products'],
            ['name' => 'Create Products', 'slug' => 'products.create', 'group' => 'Products', 'description' => 'Create new products'],
            ['name' => 'Edit Products', 'slug' => 'products.edit', 'group' => 'Products', 'description' => 'Edit existing products'],
            ['name' => 'Delete Products', 'slug' => 'products.delete', 'group' => 'Products', 'description' => 'Delete products'],

            // Events Management
            ['name' => 'View Events', 'slug' => 'events.view', 'group' => 'Events', 'description' => 'View list of events'],
            ['name' => 'Create Events', 'slug' => 'events.create', 'group' => 'Events', 'description' => 'Create new events'],
            ['name' => 'Edit Events', 'slug' => 'events.edit', 'group' => 'Events', 'description' => 'Edit existing events'],
            ['name' => 'Delete Events', 'slug' => 'events.delete', 'group' => 'Events', 'description' => 'Delete events'],

            // Testimonials Management
            ['name' => 'View Testimonials', 'slug' => 'testimonials.view', 'group' => 'Testimonials', 'description' => 'View list of testimonials'],
            ['name' => 'Create Testimonials', 'slug' => 'testimonials.create', 'group' => 'Testimonials', 'description' => 'Create new testimonials'],
            ['name' => 'Edit Testimonials', 'slug' => 'testimonials.edit', 'group' => 'Testimonials', 'description' => 'Edit existing testimonials'],
            ['name' => 'Delete Testimonials', 'slug' => 'testimonials.delete', 'group' => 'Testimonials', 'description' => 'Delete testimonials'],

            // Contact Info Management
            ['name' => 'View Contact Info', 'slug' => 'contact-info.view', 'group' => 'Contact Info', 'description' => 'View contact information'],
            ['name' => 'Create Contact Info', 'slug' => 'contact-info.create', 'group' => 'Contact Info', 'description' => 'Create contact information'],
            ['name' => 'Edit Contact Info', 'slug' => 'contact-info.edit', 'group' => 'Contact Info', 'description' => 'Edit contact information'],
            ['name' => 'Delete Contact Info', 'slug' => 'contact-info.delete', 'group' => 'Contact Info', 'description' => 'Delete contact information'],

            // About Pages Management
            ['name' => 'View About Pages', 'slug' => 'about-pages.view', 'group' => 'About Pages', 'description' => 'View about pages'],
            ['name' => 'Create About Pages', 'slug' => 'about-pages.create', 'group' => 'About Pages', 'description' => 'Create about pages'],
            ['name' => 'Edit About Pages', 'slug' => 'about-pages.edit', 'group' => 'About Pages', 'description' => 'Edit about pages'],
            ['name' => 'Delete About Pages', 'slug' => 'about-pages.delete', 'group' => 'About Pages', 'description' => 'Delete about pages'],

            // Leadership Members Management
            ['name' => 'View Leadership', 'slug' => 'leadership.view', 'group' => 'Leadership', 'description' => 'View leadership members'],
            ['name' => 'Create Leadership', 'slug' => 'leadership.create', 'group' => 'Leadership', 'description' => 'Create leadership members'],
            ['name' => 'Edit Leadership', 'slug' => 'leadership.edit', 'group' => 'Leadership', 'description' => 'Edit leadership members'],
            ['name' => 'Delete Leadership', 'slug' => 'leadership.delete', 'group' => 'Leadership', 'description' => 'Delete leadership members'],

            // Partners Management
            ['name' => 'View Partners', 'slug' => 'partners.view', 'group' => 'Partners', 'description' => 'View partners'],
            ['name' => 'Create Partners', 'slug' => 'partners.create', 'group' => 'Partners', 'description' => 'Create partners'],
            ['name' => 'Edit Partners', 'slug' => 'partners.edit', 'group' => 'Partners', 'description' => 'Edit partners'],
            ['name' => 'Delete Partners', 'slug' => 'partners.delete', 'group' => 'Partners', 'description' => 'Delete partners'],

            // Settings
            ['name' => 'View Settings', 'slug' => 'settings.view', 'group' => 'Settings', 'description' => 'View system settings'],
            ['name' => 'Edit Settings', 'slug' => 'settings.edit', 'group' => 'Settings', 'description' => 'Edit system settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }

        $this->command->info('Permissions created successfully!');

        // Create Roles
        $superAdminRole = Role::updateOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Admin',
                'description' => 'Has full access to all system features',
                'is_system' => true,
            ]
        );

        $adminRole = Role::updateOrCreate(
            ['slug' => 'admin'],
            [
                'name' => 'Admin',
                'description' => 'Can manage most content and users',
                'is_system' => true,
            ]
        );

        $editorRole = Role::updateOrCreate(
            ['slug' => 'editor'],
            [
                'name' => 'Editor',
                'description' => 'Can manage content (blogs, news, pages)',
                'is_system' => false,
            ]
        );

        $viewerRole = Role::updateOrCreate(
            ['slug' => 'viewer'],
            [
                'name' => 'Viewer',
                'description' => 'Can only view content',
                'is_system' => false,
            ]
        );

        $this->command->info('Roles created successfully!');

        // Assign all permissions to Admin role
        $allPermissionIds = Permission::whereNotIn('group', ['Roles', 'Permissions'])->pluck('id');
        $adminRole->permissions()->sync($allPermissionIds);

        // Assign content permissions to Editor role
        $editorPermissionSlugs = [
            'dashboard.view',
            'blogs.view', 'blogs.create', 'blogs.edit',
            'news.view', 'news.create', 'news.edit',
            'case-studies.view', 'case-studies.create', 'case-studies.edit',
            'events.view', 'events.create', 'events.edit',
            'testimonials.view', 'testimonials.create', 'testimonials.edit',
            'industries.view', 'industries.create', 'industries.edit',
            'services.view', 'services.create', 'services.edit',
            'products.view', 'products.create', 'products.edit',
            'about-pages.view', 'about-pages.create', 'about-pages.edit',
            'leadership.view', 'leadership.create', 'leadership.edit',
            'partners.view', 'partners.create', 'partners.edit',
            'contact-info.view', 'contact-info.create', 'contact-info.edit',
        ];
        $editorPermissionIds = Permission::whereIn('slug', $editorPermissionSlugs)->pluck('id');
        $editorRole->permissions()->sync($editorPermissionIds);

        // Assign view permissions to Viewer role
        $viewerPermissionIds = Permission::where('slug', 'like', '%.view')->pluck('id');
        $viewerRole->permissions()->sync($viewerPermissionIds);

        $this->command->info('Permissions assigned to roles successfully!');

        // Assign Super Admin role to existing super admin user
        $superAdmin = User::where('email', 'superadmin@hcitsol.com')->first();
        if ($superAdmin) {
            $superAdmin->roles()->syncWithoutDetaching([$superAdminRole->id]);
            $this->command->info('Super Admin role assigned to superadmin@hcitsol.com');
        }

        // Assign Admin role to existing admin user
        $admin = User::where('email', 'admin@hcitsol.com')->first();
        if ($admin) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
            $this->command->info('Admin role assigned to admin@hcitsol.com');
        }

        $this->command->info('-----------------------------------');
        $this->command->info('Roles and Permissions seeded successfully!');
        $this->command->info('-----------------------------------');
    }
}
