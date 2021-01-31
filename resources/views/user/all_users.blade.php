@extends('layouts.app')
@section('title', 'Home')
@section('content')

<h1>All Users</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Registered Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->user_name }}</td>
                <td>{{ $user->user_email }}</td>
                <td>{{ $user->user_create_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



@endsection