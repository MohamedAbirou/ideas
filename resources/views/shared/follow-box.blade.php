<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Top Users</h5>
    </div>
    <div class="card-body">
        @foreach ($topUsers as $user)
            <div class="hstack d-flex align-items-center justify-content-between  gap-2 mb-3">
                <div class="d-flex align-items-center">
                    <div class="avatar me-2">
                        <a href="{{ route('users.show', $user->id) }}"><img style="width: 30px"
                                class="avatar-img rounded-circle" src="{{ $user->getImageURL() }}" alt=""></a>
                    </div>
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                        <p class="mb-0 small text-truncate">{{ $user->email }}</p>
                    </div>
                </div>
                @auth
                    @if (Auth::user()->isNot($user))
                        <div class="mt-3">
                            @if (Auth::user()->follows($user))
                                <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary-soft rounded-circle icon-md ms-auto"><i
                                            class="fa-solid fa-minus">
                                        </i></button>
                                </form>
                            @else
                                <form action="{{ route('users.follow', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary-soft rounded-circle icon-md ms-auto"><i
                                            class="fa-solid fa-plus">
                                        </i></button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
</div>
