@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ route('posts') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="body">Email</label>
                <textarea type="text" name="body" id="body" cols="30" rows="4" placeholder="Post something!"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    value="{{ old('body') }}"
                ></textarea>

                @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
        </form>

        @if ($posts->count())
            @foreach ($posts as $post)
                <div class="mb-4">
                    <a href="" class="font-bold">{{ $post->user->name }}</a><span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    <p class="mb-2">{{ $post->body }}</p>

                    @if (!$post->likedBy(auth()->user()))
                        <form action="{{ route('post.likes', $post) }}" method="POST" class="mr-1 inline">
                            @csrf
                            <button type="submit" class="text-blue-500">Like</button>
                        </form>

                    @else

                        <form action="{{ route('post.likes', $post) }}" method="POST" class="mr-1 inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500">Unlike</button>
                        </form>

                    @endif

                    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>

                </div>

            @endforeach

            {{ $posts->links() }}
        @else
            <p>There are no posts</p>
        @endif
    </div>
  </div>
@endsection
