<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 */
class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'type'];
}
