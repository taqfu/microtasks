
@extends ('master')

@section ('content')
<?php 
    $status_class = ["fail", "success", "limbo"];
?>
<table class='simple'><?php $iteration=0; ?>
@foreach ($patterns as $pattern)
<?php $iteration++; ?>
    @if ($iteration==1)
        <tr>
    @endif
    <td id='status{{$pattern->id}}' 
      title='{{$pattern->type->name}} - c{{$pattern->cycle}} - d{{$pattern->day}} ' 
      class=' status {{$status_class[$pattern->status]}}'>
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

<?php 
    $hour = date ("H", strtotime("-7 hours")); 
    $min = date ("i", strtotime("-7 hours")); 
    $sec = date ("s", strtotime("-7 hours")); 
?>
    <div id='clock'>
        <span id='hour'><?= $hour; ?> </span>:
        <span id='min'><?= $min; ?> </span>:
        <span id='sec'><?= $sec; ?> </span>
    </div>
@endsection
