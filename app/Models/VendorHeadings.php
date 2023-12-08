<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorHeadings extends Model
{
    use HasFactory;

    protected $fillable = [
    	'headings',
    	'description'];
}
