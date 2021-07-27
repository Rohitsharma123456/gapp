@extends('layout')
@section('body')
<table class="table">
@foreach($values as $value)

    <th>
{{$value[0]}}
    </th>
    <th>
        {{$value[1]}}
            </th>
            <th>
               {{$value[2]}}
                    </th></tr>
@endforeach
</table>
@endsection