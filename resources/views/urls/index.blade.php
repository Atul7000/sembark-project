@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Short URLs</h1>
        <div class="form-container">
            <form method="POST" action="{{ url('/urls') }}">
                @csrf
                <div class="form-group">
                    <label for="long_url">Long URL:</label>
                    <input type="url" name="long_url" id="long_url" class="form-control" placeholder="Enter a valid URL" required>
                </div>
                <button type="submit" class="btn btn-primary">Shorten</button>
            </form>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Short URL</th>
                        <th>Long URL</th>
                        <th>Hits</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($urls as $url)
                        <tr>
                            <td>
                                <a href="{{ $url->short_url }}" target="_blank">
                                    {{ $url->short_url }}
                                </a>
                            </td>
                            <td>{{ $url->long_url }}</td>
                            <td>{{ $url->hit_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No URLs found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $urls->links() }}
        </div>
    </div>
@endsection
