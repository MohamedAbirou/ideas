    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="Mario Avatar">
                    <div>
                        <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                            </a></h3>
                        <span class="fs-6 text-muted">{{ $user->email }}</span>
                    </div>
                </div>
                @can('update', $user)
                    <div>
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                    </div>
                @endcan
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <p class="fs-6 fw-light">
                    {{ $user->bio }}
                </p>
                @include('users.shared.user_stats')
                @auth
                    @if (Auth::user()->isNot($user))
                        <div class="mt-3">
                            @if (Auth::user()->follows($user))
                                <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"> Unfollow </button>
                                </form>
                            @else
                                <form action="{{ route('users.follow', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
