<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>

        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($posts->count())
                        <div class="card-header">{{ __('Posts') }}</div>

                        <div class="card-body">
                            @foreach($posts as $post)
                                <div class="card my-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <p class="card-text"><small class="text-muted"> Posted by {{ $post->user->name }} on {{ $post->created_at->diffForHumans() }}</small></p>
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Full Post</a>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card-header">{{ __('No Posts') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
