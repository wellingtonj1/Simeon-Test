<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $header['title'] }}
        </h2>

        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-4">
                    <div class="card-body">
                        <form method="POST" action="{{ isEdit() ? route('posts.update', $post) : route('posts.store') }}">
                            @csrf
                            {{ isEdit() ? method_field('PUT') : '' }}

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" required autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description', $post->description) }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0 mt-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Post') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
