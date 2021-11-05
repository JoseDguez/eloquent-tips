<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    use HasFactory;

    public function scopeSortByStatus($query, $direction)
    {
        $query->orderBy(DB::raw('
            case
                when status = "Pendiente" then 1
                when status = "Activo" then 2
                when status = "Cancelado" then 3
            end
        '), $direction);
    }

    public function scopeSortByActivity($query, $direction)
    {
        // likes + (dislikes * 2)
        // likes + (dislikes * 3)
        // (likes * 2) + dislikes if you want the likes to have more weight, etc...
        $query->orderBy(DB::raw('-(likes + (dislikes * 2))'), $direction);
    }
}
