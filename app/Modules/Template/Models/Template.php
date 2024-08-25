<?php

namespace App\Modules\Template\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template',
    ];
}
