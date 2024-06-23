@extends('layouts.app')

@section('content')
    <h1>All Posts</h1>
    
    <a href="{{ route('posts.create') }}">Create New Post</a>
    
    @if($posts->count())
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        {{ $posts->links() }}
    @else
        <p>No posts available.</p>
    @endif
@endsection