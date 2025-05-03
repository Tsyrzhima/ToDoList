<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $description
 * @property string $status
 */
class Task extends Model
{
    protected $fillable = ['title','description','status'];

}
