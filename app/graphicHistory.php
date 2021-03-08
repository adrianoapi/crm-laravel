<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraphicHistory extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function defaulting()
    {
        return $this->belongsTo(Graphic::class, 'graphic_id', 'id');
    }
}
