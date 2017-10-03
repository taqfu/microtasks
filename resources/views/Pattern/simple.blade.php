
@extends ('master')

@section ('content')
<?php
    $status_class = ["fail", "success", "limbo"];
?>
<div class='simple'>
<table class='simple'><?php $iteration=0; ?>
  <tr><td colspan="{{count($pattern_types)+3}}">
      <form method="POST" action="{{route('pattern.row.new')}}">
          {{csrf_field()}}
          <input id="new-row" type='submit' value = "+Row" class = "btn btn-lg btn btn-link form-control"/>
      </form>
  </tr>
@foreach ($patterns as $pattern)
<?php $iteration++; ?>

    @if ($iteration==1)
        <tr>
    @endif
    <td id='status{{$pattern->id}}'
      title='{{$pattern->type->name}} - c{{$pattern->cycle}} - d{{$pattern->day}} '
      class='simple status {{$status_class[$pattern->status]}}'>
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
</div>

    <form method="GET" action="{{routE('pattern.index')}}">
        {{csrf_field()}}
        <input id="new-row" type='submit' value = "Less Simple" class = "btn btn-lg btn btn-link form-control"/>
    </form>
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
