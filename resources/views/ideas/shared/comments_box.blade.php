<style>
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #f5f5f500;
        border-radius: 10px;
    }

    ::-webkit-scrollbar {
        width: 10px;
        background-color: #f5f5f500;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #006350;
        border-radius: 10px;
        background-image: -webkit-linear-gradient(90deg,
                rgba(0, 0, 0, .2) 25%,
                transparent 25%,
                transparent 50%,
                rgba(0, 0, 0, .2) 50%,
                rgba(0, 0, 0, .2) 75%,
                transparent 75%,
                transparent)
    }
</style>

<div>
    @auth
        <form action="{{ route('ideas.comment.store', $idea->id) }}" method="post">
            @csrf
            @method('POST')
            <div class="mb-3">
                <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
            </div>
        </form>
    @endauth
    @guest
        <h5 class="mt-2">Login to comment on this post</h5>
    @endguest

    <hr>

    <div class="overflow-y-scroll pe-2" style="max-height: 200px">
        @forelse ($idea->comments as $comment)
            <div class="d-flex align-items-start">
                <img style="width:30px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageURL() }}"
                    alt="{{ $comment->user->name }} Avatar">
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <p class="card-title mb-0"><a href="{{ route('users.show', $comment->user->id) }}">
                                {{ $comment->user->name }}
                            </a></p>
                        <small class="fs-6 fw-light text-muted"> {{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="fs-6 mt-3 fw-light">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>
        @empty
            <p class="text-center mt-2">No comments found.</p>
        @endforelse
    </div>
</div>
