<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    SoftDeletes
};
use Spatie\Tags\HasTags;

class Notice extends Model
{
    use HasFactory;
    use HasTags;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'public',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'public',
        'author_id',
        'deleted_at',
        'tags'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['topics'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getTopicsAttribute()
    {
        return $this->tags->map(fn ($tag) => [
            'id'   => $tag->id,
            'name' => $tag->name,
            'type' => $tag->type
        ]);
    }
}
