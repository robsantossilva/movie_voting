<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'rating',
        'averageAssessment'
    ];

    protected   $casts = [
        'id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'rating' => 'string',
        'averageAssessment' => 'float'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    // public static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($obj) {
    //         $obj->id = Uuid::uuid4()->toString();
    //     });
    // }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)->withTrashed();
    }

    public function castMembers(): BelongsToMany
    {
        return $this->belongsToMany(CastMember::class)->withTrashed();
    }
}
