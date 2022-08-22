@extends('layouts.app')

@section('content')
    <table class="table table-bordered">
        <tbody class="table-primary">
            <tr><td colspan="2"></td></tr>
            <tr>
                <td>Title: {{ $ad->title }}</td>
                <td>Created: {{$ad->created_at->toDateString() }} ({{ $ad->created_at->diffForHumans()}}) </td>
            </tr>
            <tr>
                <td colspan="2">Author: {{ $ad->author_name}}</td>
            </tr>
            <tr>
                <td colspan="2">Description: {{ $ad->description}}</td>
            </tr> 
        </tbody>
    </table>
@endsection

@section('aside')
    @can('update', $ad)
        <form action="{{ route('ads.edit', ['ad' => $ad->id]) }}" method="get">
            @csrf
            <button type="sumbit" class="btn btn-primary">Edit</button>
        </form>
        <br>
    @endcan
    @can('delete', $ad)
        <form action="{{ route('ads.destroy', ['ad' => $ad->id]) }}" method="post">
            @method('delete')
            @csrf
            <button type="sumbit" class="btn btn-primary">Delete</button>
        </form>
        <br>
    @endcan
    @guest
        <a href="{{ route('home') }}">Sign in to contact author</a>
    @endguest
    @auth
        @if( $ad->author_id !== \Illuminate\Support\Facades\Auth::user()->id)
            <a href="{{ redirect()->back() }}">Contact author</a>
        @endif
    @endauth
@endsection

