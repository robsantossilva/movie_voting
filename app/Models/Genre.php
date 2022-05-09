<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected   $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string'
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($obj) {
    //         $obj->id = Uuid::uuid4()->toString();
    //     });
    // }
}
