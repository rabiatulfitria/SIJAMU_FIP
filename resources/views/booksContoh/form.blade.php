@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($book) ? 'Edit Book' : 'Add Book' }}</h1>
    <form action="{{ isset($book) ? route('books.update', $id) : route('books.store') }}" method="POST">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book['title'] ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book['author'] ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" name="year" class="form-control" value="{{ $book['year'] ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update' : 'Add' }}</button>
    </form>
</div>
@endsection
