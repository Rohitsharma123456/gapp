@extends('layout')
@section('body')
<table class="table">
<thead>
    <tr>
      
      <th scope="col">FirstName</th>
      <th scope="col">LastName</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
@foreach($values as $value)

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
