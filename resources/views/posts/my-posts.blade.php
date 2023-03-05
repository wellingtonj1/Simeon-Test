<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Create New Post</a>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                                <div class="mb-4">
                                    <h4 class="font-weight-bold">{{ $post->title }}</h4>
                                    <p>{{ $post->description }}</p>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
                                        <form method="post" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No posts found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
