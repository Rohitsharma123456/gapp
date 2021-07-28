@extends('layout')
@section('body')
<table class="table">
@foreach($values as $value)
<thead>
    <tr>
      
      <th scope="col">FirstName</th>
      <th scope="col">LastName</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <th scope="col">
{{$value[0]}}
    </th>
    <th scope="col">
        {{$value[1]}}
            </th>
            <th scope="col">
               {{$value[2]}}
                    </th></tr>
                    </tbody>
@endforeach
</table>
@endsection
