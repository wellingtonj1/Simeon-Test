<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back To All Posts</a>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <div class="card my-3">
                            <div class="card-body posts">
                                <h2 class="card-title text-center">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->description }}</p>
                                <p class="card-text"><small class="text-muted"> Posted by {{ $post->user->name }} on {{ $post->created_at->diffForHumans() }}</small></p>

                                <!-- Comments -->
                                <h4>Comments</h4>
                                @if (count($post->comments) > 0)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <ul class="list-unstyled">
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
                                        </div>
                                    </div>
                                @else
                                    <p>No comments yet.</p>
                                @endif

                                <!-- Comment Form -->
                                <h3>Add a Comment</h3>
                                <form method="post" action="{{ route('posts.comments.store', $post->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" placeholder="Write your comment..." rows="3"></textarea>
                                    </div>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
