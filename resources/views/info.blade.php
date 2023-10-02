@extends('layouts.base')
@section('content')

    <table class="table table-striped">
        <tr>
            <th>Task Name</th>
            <th>description</th>
            <th>Date of creation</th>
            <th>Date of modification</th>
        </tr>
        <tr>
            <td><p>{{ $todo->name }}</p></td>
            <td><p>{{ $todo->description }}</p></td>
            <td>{{$todo->created_at}}</td>
            <td>{{$todo->updated_at}}</td>
        </tr>
    </table>
@endsection
