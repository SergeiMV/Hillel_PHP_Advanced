@extends('home')

@section('content')
    <table class="table table-bordered">
    @forelse($ads as $ad)
        @if($ad->id%2 == 0)
            <tbody class="table-warning">
        @else
            <tbody class="table-primary">
        @endif
        <tr><td colspan="2"></td></tr>
        <tr>
            <td>Title:  <a href="{{ route('ads.show', ['ad' => $ad->id]) }}">{{ $ad->title }}</a></td>
            <td>Created: {{$ad->created_at->toDateString() }} ({{ $ad->created_at->diffForHumans()}}) </td>
        </tr>
        <tr>
            <td colspan="2">Author: {{ $ad->author_name}}</td>
        </tr>
        <tr>
            <td colspan="2">Description: {{ $ad->description}}</td>
        </tr> 
        @can('edit', $ad)
            <tr>
                <td colspan="2">
                    <form action="{{ route('ads.edit', ['ad' => $ad->id]) }}" method="get">
                        @csrf
                        <button type="sumbit" class="btn btn-primary">Edit</button>
                    </form>
                </td>
            </tr>
        @endcan
        @can('delete', $ad)
            <tr>
                <td colspan="2">
                    <form action="{{ route('ads.destroy', ['ad' => $ad->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="sumbit" class="btn btn-primary">Delete</button>
                    </form>
                </td>
            </tr>
        @endcan
        <tr><td colspan="2"></td></tr>
        </tbody>
        @empty
            <tr>
                <td colspan="2">No ads in here, try another page.</td>
            </tr>
        @endforelse
    </table>

{{ $ads->links() }}

@endsection
