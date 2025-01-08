<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Fruit",
 *     required={"name"},
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="name", type="string", example="Apple"),
 *     @OA\Property(property="created_at", type="string", format="datetime", example="2025-01-09 10:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="datetime", example="2025-01-09 10:00:00")
 * )
 */
class Fruit extends Model
{
    protected $fillable = ['name'];

}
