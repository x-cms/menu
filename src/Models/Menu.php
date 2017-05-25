<?php

namespace Xcms\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
