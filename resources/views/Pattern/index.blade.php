@extends ('master')

@section ('content')
<?php 
    $status_class = ["fail", "success", "limbo"];
?>
<a href="{{route('PatternType.create')}}">New Pattern Type</a>

<table border=1><tr><td>Date</td><td>Cycle</td><td>Day</td>


    @foreach ($pattern_types as $pattern_type)
        <td>{{$pattern_type->name}}</td>
    @endforeach
</tr>
<?php $iteration=0; ?>
@foreach ($patterns as $pattern)
<?php $iteration++; ?>
    @if ($iteration==1)
    <tr><td class='date'>{{date('M j y', strtotime($pattern->date))}}</td><td class='cycle'>{{$pattern->cycle}}</td><td class='day'>{{$pattern->day}}</td>
    @endif
    <td id='status{{$pattern->id}}' title='{{$pattern->type->name}} - c{{$pattern->cycle}} - d{{$pattern->day}} ' class=' status {{$status_class[$pattern->status]}}'>
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
<tr><td colspan="{{count($pattern_types)+3}}">
    <form method="POST" action="{{route('pattern.row.new')}}">
        {{csrf_field()}}
        <input type='submit' value='New Row' />
    </form>
</tr>
</table>

@endsection
