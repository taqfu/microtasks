<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    public function type(){
        return $this->hasOne("App\PatternType", "id", "pattern_type_id");
    }
    public static function fetch_cycle_percentage ($pattern_type_id, $cycle) {
        $sum = 0;
        $patterns = Pattern:: where ("pattern_type_id", $pattern_type_id)->where ("cycle", $cycle)->get();
        foreach ($patterns as $pattern){
            if ($pattern->status != 2){
                $sum += $pattern->status;
            }
        }

        return round($sum / count($patterns) * 100);
    }
}
