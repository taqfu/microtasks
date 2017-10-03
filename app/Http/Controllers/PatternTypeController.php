<?php

namespace App\Http\Controllers;

use App\Pattern;
use App\PatternType;
use Illuminate\Http\Request;

class PatternTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('PatternType.create', [
            "pattern_types"=>PatternType::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pattern_type = new PatternType;
        $pattern_type->name = $request->patternTypeName;
        $pattern_type->save();
        $random_pattern_type = PatternType::first();
        $template_patterns = Pattern::where('pattern_type_id', $random_pattern_type->id)
          ->orderBy('date', 'asc')->get();
        foreach($template_patterns as $template_pattern){
            $pattern = new Pattern;
            $pattern->status = 2;
            $pattern->date = $template_pattern->date;
            $pattern->day = $template_pattern->day;
            $pattern->cycle = $template_pattern->cycle;
            $pattern->pattern_type_id = $pattern_type->id;
            $pattern->save();
        }
        return redirect(route("PatternType.create"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatternType  $patternType
     * @return \Illuminate\Http\Response
     */
    public function show(PatternType $patternType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatternType  $patternType
     * @return \Illuminate\Http\Response
     */
    public function edit(PatternType $patternType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatternType  $patternType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatternType $patternType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatternType  $patternType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pattern_type = PatternType::find($id);
        $pattern_type->retired_at = date("Y-m-d H:i:s");
        $pattern_type->save();

        return back();
    }
    public function undelete($id){
      $pattern_type = PatternType::find($id);
      $pattern_type->retired_at = null;
      $pattern_type->save();

      return back();
    }

}
