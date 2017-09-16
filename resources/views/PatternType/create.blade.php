@foreach ($pattern_types as $pattern_type)
    <form method="POST" action="{{route('PatternType.destroy', ['id'=>$pattern_type->id])}}">
        {{csrf_field()}}
        {{method_field('delete')}}
        <input type='submit' value ='x'/> {{$pattern_type->name}}
    </form>
@endforeach
<form method="POST" action="{{route('PatternType.store')}}">
    {{csrf_field()}}
    <input type='text' name='patternTypeName' />
    <input type='submit'/>

</form>
