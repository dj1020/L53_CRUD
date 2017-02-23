@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>顯示 Contacts 列表</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Contact Content</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contactList as $contact)
                <tr>
                    <td>{{ $contact['name'] }}</td>
                    <td>{{ $contact['phone'] }}</td>
                    <td>{{ $contact['email'] }}</td>
                    <td>{{ $contact['message'] }}</td>
                </tr>
            @endforeach
           </tbody>
        </table>

    </div>
@endsection
