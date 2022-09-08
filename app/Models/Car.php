<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'name',
        'color',
        'year',
        'image',
        'status',
        'user_id'
    ];
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rent(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_rents')->withPivot(['devolved']);
    }
}
