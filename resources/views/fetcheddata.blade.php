@extends('layout')
@section('body')
<table class="table table-dark table-striped">
<thead>
    <tr >
      
      <th >FirstName</th>
      <th >LastName</th>
      <th >Email</th>
    </tr>
  </thead>
@foreach($values as $value)

  <tbody>
    <th >
{{$value[0]}}
    </th>
    <th >
        {{$value[1]}}
            </th>
            <th >
               {{$value[2]}}
                    </th></tr>
                    </tbody>
@endforeach
</table>
@endsection
