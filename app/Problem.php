<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function testCases()
    {
        return $this->hasMany('App\TestCase');
    }
}
