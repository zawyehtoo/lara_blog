<div class="comment">
    <h5 class="mt-5">Comment and Reply</h5>
    @forelse ($blog->comments()->whereNull("parent_id")->latest("id")->get() as $comment)
        <div class="card mb-2">
            <div class="card-body  d-flex justify-content-between align-items-top">
                <div>
                    <h5 class="mb-0">
                        <i class="bi bi-chat-square-text-fill me-2"></i>{{ $comment->user->name }}
                        <span class=" ms-4 badge bg-dark"><i
                                class="bi bi-clock-fill"></i>{{ $comment->created_at->diffForHumans() }}</span>
                    </h5>
                    <p class="mt-2">{{ $comment->content }}</p>
                </div>
                <div class="">
                    @can('delete', $comment)
                        <form action="{{ route('comment.destroy', $comment->id) }}" class="d-inline-block" method="post">
                            @csrf
                            @method('delete')
                            <button class=" btn btn-sm btn-outline-dark">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    @endcan
                    <button class=" btn btn-sm btn-outline-dark reply-btn"><i class="bi bi-reply"></i></button>
                </div>
            </div>
            @auth
                <div class="reply-box d-none ms-5 mt-0 me-2 mb-3 ">
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <textarea name="content" class="form-control" cols="30" rows="2"
                            placeholder="replying to {{ $comment->user->name }}'s comment"></textarea>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>replying as <span class="text-primary">{{ Str::upper(Auth::user()->name) }}</span>
                            </p>
                            <button class="btn btn-dark mt-2">reply</button>
                        </div>
                    </form>
                </div>
            @endauth
            @foreach ($comment->replies()->latest("id")->get() as $reply)
                <div class="card ms-5 mb-3 me-2">
                    <div class="card-body  d-flex justify-content-between align-items-top">
                        <div>
                            <h5 class="mb-0">
                                <i class="bi bi-reply-fill me-2"></i>{{ $reply->user->name }}
                                <span class=" ms-4 badge bg-dark"><i
                                        class="bi bi-clock-fill"></i>{{ $reply->created_at->diffForHumans() }}</span>
                            </h5>
                            <p class="mt-2">{{ $reply->content }}</p>
                        </div>
                        @can('delete', $reply)
                        <form action="{{ route('comment.destroy', $reply->id) }}" class="d-inline-block" method="post">
                            @csrf
                            @method('delete')
                            <button class=" btn btn-sm btn-outline-dark">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    @endcan
                    </div>
                </div>
            @endforeach


        </div>
    @empty
        <div class="card">
            <div class="card-body">
                <p>There is no comment yet!</p>
            </div>
        </div>
    @endforelse
    @auth
        <div class="comment-box mt-3">

            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                <textarea name="content" class="form-control" cols="30" rows="5"></textarea>
                <div class="d-flex justify-content-between align-items-center">
                    <p>Commenting as <span class="text-primary">{{ Str::upper(Auth::user()->name) }}</span></p>
                    <button class="btn btn-dark mt-2">Comment</button>
                </div>
            </form>
        </div>
    @endauth
</div>

@vite(['resources/js/reply.js'])
