<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'title',
        'body',
        'xp'
    ];

    public function testCases()
    {
        return $this->hasMany('App\TestCase');
    }
}
