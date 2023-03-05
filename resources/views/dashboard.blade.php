<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-1 mb-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">My Profile</div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <p>{{ Auth::user()->email }}</p>
                                        </div>

                                        <div class="text-center">
                                            You've created a {{ Auth::user()->posts->count() }} posts.
                                        </div>
                                        <div class="text-center">
                                            You've commented on posts {{ Auth::user()->comments->count() }} times.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">My Posts</div>
                                    <div class="card-body">
                                        @if(count($posts) > 0)
                                            @foreach($posts as $post)
                                                <div class="media mb-3">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">{{ $post->title }}</h5>
                                                        <p>{{ $post->description }}</p>
                                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{ $posts->links() }}
                                        @else
                                            <p>You have not created any posts yet.</p>
                                            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
