<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gorevler extends Model
{
    use SoftDeletes;
    protected $table = 'gorevler';
}
