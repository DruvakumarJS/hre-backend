<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettycashSummary extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'amount',
    'comment',
    'type',
    'balance',
    'transaction_date',
    'mode',
    'reference_number'
   ] ;
}
