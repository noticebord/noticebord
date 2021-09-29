<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\Tag;

class Topic extends Tag
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    public function notices() {
        return $this->morphedByMany(Notice::class, 'taggable', foreignPivotKey: 'taggable_id');
    }
}