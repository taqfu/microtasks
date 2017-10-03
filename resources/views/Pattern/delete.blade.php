<form method="DELETE" action="{{route('pattern.delete', ['id'=>$id])}}">
{{csrf_field()}}
{{method_field('delete')}}
<input type='submit' class='btn btn-danger btn-block' value='Delete' />
</form>
