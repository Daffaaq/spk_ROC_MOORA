<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = ['alternative_id', 'criteria_id', 'value', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function classification()
    {
        return $this->hasMany(Classification::class);
    }
}
