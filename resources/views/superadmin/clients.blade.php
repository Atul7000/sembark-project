@extends('layouts.app')

@section('content')
<h1>Clients</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Users</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>
                @foreach ($client->users as $user)
                    {{ $user->name }} ({{ $user->role ?? 'super_admin' }})<br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
