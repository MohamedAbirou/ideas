@extends('layout.layout')

@section('title', 'Ideas')

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
                        <th>Owner</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ideas as $idea)
                        <tr>
                            <td>{{ $idea->id }}</td>
                            <td><a href="{{ route('users.show', $idea->user->id) }}">
                                    {{ $idea->user->name }}</a></td>
                            <td>{{ $idea->content }}</td>
                            <td>{{ $idea->created_at->toDateString() }}</td>
                            <td class="d-flex align-items-center justify-content-evenly ">
                                <a href="{{ route('ideas.show', $idea->id) }}">View</a>
                                <a href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                                <form action="{{ route('admin.ideas.destroy', $idea->id) }}" method="post">
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
                {{ $ideas->links() }}
            </div>
        </div>
    </div>
@endsection
