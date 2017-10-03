@extends ('master')

@section ('content')
<?php
    $status_class = ["fail", "success", "limbo"];
?>
<form method="GET" action="{{route('PatternType.create')}}" style='display:inline;'>
  <input type='submit' value ='New Pattern Type' class = "btn btn-primary"/>
</form>
<form method="GET" action="{{route('pattern.simple')}}" style='display:inline;'>
  <input type='submit' value ='Simple' class = "btn btn-primary"/>
</form>
<table border=1>

  <tr>
    <td>Date</td>
    <td>Cycle</td>
    <td>Day</td>
    @foreach ($pattern_types as $pattern_type)
        <td>{{$pattern_type->name}}</td>
    @endforeach
</tr>
<tr><td colspan="{{count($pattern_types)+3}}">
    <form method="POST" action="{{route('pattern.row.new')}}">
        {{csrf_field()}}
        <input type='submit' value='+' class = "btn btn-primary btn-block "/>
    </form>
</tr>
<?php $iteration=0; ?>
@foreach ($patterns as $pattern)
<?php $iteration++; ?>
    @if ($iteration==1)
    <tr><td class='date'>{{date('M j y', strtotime($pattern->date))}}</td>
      <td class='cycle'>{{$pattern->cycle}}</td>
      <td class='day'>{{$pattern->day}}</td>
    @endif
    <td id='status{{$pattern->id}}' title='{{$pattern->type->name}} - c{{$pattern->cycle}} - d{{$pattern->day}} ' class=' status {{$status_class[$pattern->status]}}'>
      @if ($pattern->day == 1 && $pattern->status != 2)
          {{\App\Pattern::fetch_cycle_percentage ($pattern->pattern_type_id, $pattern->cycle)}}%
      @endif
        <form id='change-status{{$pattern->id}}' method="POST" action="{{route('pattern.update', ['pattern'=>$pattern])}}">
            {{csrf_field()}}
            {{method_field('put')}}
        </form>
    </td>
    @if ($iteration==count($pattern_types))
        </tr>
        <?php $iteration=0; ?>
    @endif
@endforeach

</table>

@endsection
