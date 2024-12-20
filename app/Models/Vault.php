<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vault extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable= [
    	'name',
    	'type',
    	'sub_folders',
    	'folder',
    	'filename',
    	];
}
