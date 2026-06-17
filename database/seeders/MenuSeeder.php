<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
                $collectionName = 'menus';

                $recordsExist = false;
                try {
                    $count = Menu::count();
                    if ($count > 0) {
                        $recordsExist = true;
                    }
                } catch (\Exception $e) {
                    $recordsExist = false;
                }

                if ($recordsExist) {
                    $this->info("Records already exist in '{$collectionName}' collection.");
                    $this->command->info('Skipping migration...');
                    return;
                    
                }
                $this->command->info("Records do not exist in '{$collectionName}'. Creating records...");

                $menus = [
                [
                    'menu_name' => 'Leave Statistics',
                    'menu_route' => 'leaveStatistics',
                    'menu_icon' => 'bi-speedometer2',
                    'show_in_sidebar'=>1,
                    'menu_order' => 1,
                ],
                [
                    'menu_name' => 'Employee Management',
                    'menu_route' => null,
                    'menu_icon' => 'bi-people',
                    'menu_order' => 2,
                    'show_in_sidebar'=>1,
                    'subMenus' => [
                        [
                            'menu_name' => 'Employee List',
                            'menu_route' => 'employees',
                            'menu_order' => 1,
                            'show_in_sidebar'=>1,
                        ],
                        [
                            'menu_name' => 'Add Employee',
                            'menu_route' => 'employees.create',
                            'menu_order' => 2,
                            'show_in_sidebar'=>1,
                        ],
                        [
                            'menu_name' => 'Get Employee',
                            'menu_route' => 'employees.getDetails',
                            'menu_order' => 3,
                            'show_in_sidebar'=>0,
                        ],
                        [
                            'menu_name' => 'Delete Employee',
                            'menu_route' => 'employees.delete',
                            'menu_order' => 4,
                            'show_in_sidebar'=>0,
                        ],
                    ]
                ],
                [
                    'menu_name' => 'Leave Management',
                    'menu_route' => null,
                    'menu_icon' => 'bi-calendar-check',
                    'menu_order' => 3,
                    'show_in_sidebar'=>1,
                    'subMenus' => [
                        [
                            'menu_name' => 'Leave Details',
                            'menu_route' => 'leaves',
                            'menu_order' => 1,
                            'show_in_sidebar'=>1,
                        ],
                        [
                            'menu_name' => 'Approval Leave Details',
                            'menu_route' => 'pendingLeaves',
                            'menu_order' => 2,
                            'show_in_sidebar'=>1,
                        ],
                        [
                            'menu_name' => 'LeaveBulkApprove',
                            'menu_route' => 'leaveBulkApprove',
                            'menu_order' => 3,
                            'show_in_sidebar'=>0,
                        ],
                        [
                            'menu_name' => 'Leave Reject',
                            'menu_route' => 'leaveBulkReject',
                            'menu_order' => 4,
                            'show_in_sidebar'=>0,
                        ],
                        [
                            'menu_name' => 'Apply Leave',
                            'menu_route' => 'applyLeave',
                            'menu_order' => 5,
                            'show_in_sidebar'=>0,
                        ],
                        [
                            'menu_name' => 'Get Leave',
                            'menu_route' => 'leaves.getDetails',
                            'menu_order' => 6,
                            'show_in_sidebar'=>0,
                        ],
                        
                        [
                            'menu_name' => 'Delete Leave',
                            'menu_route' => 'leaves.delete',
                            'menu_order' => 7,
                            'show_in_sidebar'=>0,
                        ],
                    ]
                ],
                
            ];

                $createdCount = 0;

                foreach ($menus as $menu) {
                    $mainMenu =  Menu::create([
                        'menu_name' => $menu['menu_name'],
                        'menu_route' => $menu['menu_route'],
                        'menu_icon' => $menu['menu_icon'] ?? null,
                        'parent_id' => null,
                        'menu_order' => $menu['menu_order'],
                        'status' => 1,
                        'show_in_sidebar'=>$menu['show_in_sidebar'],
                        'slug' => Str::slug($menu['menu_name']),

                    ]);

                    if (isset($menu['subMenus'])) {
                        foreach ($menu['subMenus'] as $child) {
                             Menu::create([
                            'menu_name' => $child['menu_name'],
                            'menu_route' => $child['menu_route'],
                            'parent_id' => $mainMenu->id,
                            'menu_order' => $child['menu_order'],
                            'status' => 1,
                            'show_in_sidebar'=>$child['show_in_sidebar'],
                            'slug' => Str::slug($child['menu_name']),
                        ]);
                        }
                    }
                    $this->command->info('Created: ' . $menu['menu_name']);
                    $createdCount++;
                }
                 $this->command->info("Menu setup completed! Created: {$createdCount} records.");
                return;               
                
            } catch (\Exception $e) {
                $this->command->error('Error: ' . $e->getMessage());
                return;
            }
        
    }
}
