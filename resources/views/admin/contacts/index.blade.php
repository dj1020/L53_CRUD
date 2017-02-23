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
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>Doe</td>
                <td>john@example.com</td>
            </tr>
            <tr>
                <td>Mary</td>
                <td>Moe</td>
                <td>Moe</td>
                <td>mary@example.com</td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection
