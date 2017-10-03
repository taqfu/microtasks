@extends ("master")

@section ("content")
<form method="GET" action="{{route('pattern.index')}}">
  <input type='submit' value ='Back' class = "btn btn-primary"/>
</form>
<div class='container'>
@foreach ($pattern_types as $pattern_type)
    @if ($pattern_type->retired_at==null)
        <form method="POST" action="{{route('PatternType.destroy', ['id'=>$pattern_type->id])}}">
            {{csrf_field()}}
            {{method_field('delete')}}
            <input type='submit' value ='x' class = "btn btn-danger"/> {{$pattern_type->name}}
        </form>
    @else
    <form method="POST" action="{{route('PatternType.undelete', ['id'=>$pattern_type->id])}}">
        {{csrf_field()}}
        {{method_field('put')}}
        <input type='submit' value ='+' class = "btn btn-success"/> {{$pattern_type->name}}
    </form>
    @endif

@endforeach
<form method="POST" action="{{route('PatternType.store')}}">
    {{csrf_field()}}
    <input type='text' name='patternTypeName' />
    <input type='submit' class = "btn  "/>

</form>
</div>
@endsection
