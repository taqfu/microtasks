<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    public function type(){
        return $this->hasOne("App\PatternType", "id", "pattern_type_id");
    }
}
