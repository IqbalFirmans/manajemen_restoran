<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';
    protected $guarded = [];


    public function scopeFilter($query, array $fillters)
    {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('status', 'like', '%' . $search . '%')
                ->orWhere('table_number', 'like', '%' . $search . '%')
                ->orWhere('capacity', 'like', '%' . $search . '%');
            });
        });
    }


}
