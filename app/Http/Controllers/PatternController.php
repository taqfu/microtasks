<?php

namespace App\Http\Controllers;

use App\Pattern;
use App\PatternType;
use Illuminate\Http\Request;

class PatternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $retired_ids = [];
      $retired_pattern_types = PatternType::where('retired_at', '!=', null)->get();
      foreach ($retired_pattern_types as $retired_pattern_type){
          $retired_ids[] = $retired_pattern_type->id;
      }
        return view ("Pattern.index", [
          "patterns"=>Pattern::whereNotIn('pattern_type_id', $retired_ids)->orderBy('date', 'desc')->orderBy('pattern_type_id', 'asc')->get(),
            "pattern_types"=>PatternType::orderBy('id')->where('retired_at', null)->get(),

        ]);
    }
    public function simpleIndex()
    {
        $retired_ids = [];
        $retired_pattern_types = PatternType::where('retired_at', '!=', null)->get();
        foreach ($retired_pattern_types as $retired_pattern_type){
            $retired_ids[] = $retired_pattern_type->id;
        }
        return view ("Pattern.simple", [
            "patterns"=>Pattern::whereNotIn('pattern_type_id', $retired_ids)->orderBy('date', 'desc')->orderBy('pattern_type_id', 'asc')->get(),
            "pattern_types"=>PatternType::orderBy('id')->where('retired_at', null)->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newRow(){
        //if last row is all status=2 then don't create a new one
        $num_of_days_in_a_cycle=10;
        $last_pattern = Pattern::orderBy('id', 'desc')->first();
		$last_pattern->day++;
        if($last_pattern->day>$num_of_days_in_a_cycle){
            $last_pattern->day=1;
            $last_pattern->cycle++;
        }
        $pattern_types = PatternType::orderBy('id')->get();
        foreach($pattern_types as $pattern_type){
            $pattern = new Pattern;
            $pattern->pattern_type_id = $pattern_type->id;
            $pattern->status=2;
            $pattern->date=date("Y-m-d", strtotime("+1 day", strtotime($last_pattern->date)));
            $pattern->day=$last_pattern->day;
            $pattern->cycle=$last_pattern->cycle;
            $pattern->save();
        }
        return back();
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function show(Pattern $pattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function edit(Pattern $pattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pattern $pattern)
    {
        $pattern->status++;
        if ($pattern->status>2){
            $pattern->status=0;
        }
        $pattern->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pattern  $pattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pattern $pattern)
    {
        //
    }

    public function delete($id){

        return view ("Pattern.delete", ['id'=>$id]);
    }
}
