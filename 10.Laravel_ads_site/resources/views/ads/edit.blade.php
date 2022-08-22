@extends('layouts.app')

@section('content')
    <div id="tabs">
        @if(isset($ad->id))
            <form method="post" action="{{ route('ads.update', ['ad' => $ad->id]) }}">
            @method('put')
        @else
            <form method="post" action="{{ route('ads.create') }}">
        @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title"  value="{{ old('title', $ad->title) }}" required>
                <label for="title">Title</label> 
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description"  required>{{ old('description', $ad->description) }}</textarea>
                <label for="description">Description</label>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
	    </div>
            <br>
            @if(isset($ad->id))
                <button type="submit" class="btn btn-outline-primary">Save</button>
		<input type="hidden" name="id" value="{{ $ad->id}}">
            @else
                <button type="submit" class="btn btn-outline-primary">Create</button>
            @endif
            @csrf
        </form>
    </div>   
@endsection

@section('aside')
    @if(isset($ad->id))
        <h1>Edit your ad</h1>
    @else
        <h1>Create your ad</h1>
    @endif
@endsection
