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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contactList as $contact)
                <tr>
                    <td>{{ $contact['name'] }}</td>
                    <td>{{ $contact['phone'] }}</td>
                    <td>{{ $contact['email'] }}</td>
                    <td>{{ $contact['message'] }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('editContact', $contact['id']) }}">編輯</a>
                    </td>
                </tr>
            @endforeach
           </tbody>
        </table>

    </div>
@endsection
