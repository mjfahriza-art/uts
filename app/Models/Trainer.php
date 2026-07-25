<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'address', 'phone', 'photo'])]
class Trainer extends Model
{
    use HasFactory;

    protected $table = 'trainers';

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'trainer_id');
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'trainer_id');
    }
}

