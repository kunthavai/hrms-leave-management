<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    
    protected $fillable = [
        'menu_name',
        'menu_route',
        'menu_icon',
        'parent_id',
        'menu_order',
    ];

    // Many-to-Many: Menu ↔ Roles
    public function roles()
    {
         return $this->belongsToMany(
                Role::class,
                'role_menu'
            )->withTimestamps();
    }

    // Self relation (for submenu)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id')->where('status','1');
    }

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('status','1');
    }
    
}
