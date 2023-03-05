<x-app-layout>

    @include('posts.delete')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $header['title'] }}
        </h2>

        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4 mb-4">
                    @if ($posts->count())
                        <div class="card-body">
                            @foreach($posts as $post)
                                <div class="card my-3">
                                    <div class="card-body posts">
                                        <h4 class="card-title text-center">{{ $post->title }}</h4>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <p class="card-text"><small class="text-muted"> Posted by {{ $post->user->name }} on {{ $post->created_at->diffForHumans() }}</small></p>

                                        <div class="comment-content" data-post-id="{{ $post->id }}">
                                            <h5 class="mt-3 mb-3">Comments</h5>
                                            <ul class="list-unstyled comments ml-4">
                                                @foreach ($post->comments as $comment)
                                                    <li class="media mb-3">
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1">{{ $comment->user->name }}</h5>
                                                            <p>{{ $comment->comment }}</p>
                                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <form class="comment-form mt-2" action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                                                <textarea class="form-control" name="comment" placeholder="Write your comment..." rows="3"></textarea>
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-primary submit-comment mt-2">Comment</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end spaced">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Full Post</a>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline-block" id="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-remove" data-toggle="modal" data-target="#deleteModal">
                                                Delete
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary show-comments" data-post-id="{{ $post->id }}">Show Comments</button>
                                    </div>
                                </div>
                            @endforeach

                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="card-header">{{ __('No Posts') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
