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

            <div class="table-responsive">
                <table class="table table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Comment's Owner</th>
                            <th>Idea's Owner</th>
                            <th>Idea's Content</th>
                            <th>Comment's Content</th>
                            <th>Created At</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td><a href="{{ route('users.show', $comment->user->id) }}">
                                        {{ $comment->user->name }}</a></td>
                                <td>
                                    <a href="{{ route('users.show', $comment->idea->user->id) }}">
                                        {{ $comment->idea->user->name }}</a>
                                </td>
                                <td>{{ Str::limit($comment->idea->content, 15) }}</td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ $comment->created_at->toDateString() }}</td>
                                <td class="d-flex align-items-center justify-content-evenly ">
                                    <a href="{{ route('ideas.show', $comment->idea->id) }}">View</a>
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <a href="#!" onclick="this.closest('form').submit();return false;">Delete</a> --}}
                                        <button type="submit" class="border-0 bg-transparent text-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
