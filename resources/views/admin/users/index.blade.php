@extends('layout.layout')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.sidebar')
        </div>
        <div class="col-9">
            @include('admin.shared.success_message')
            @include('admin.shared.error_message')
            <h2>Users</h2>

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->toDateString() }}</td>
                            <td class="d-flex align-items-center justify-content-evenly ">
                                <a href="{{ route('users.show', $user->id) }}">View</a>
                                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent text-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
