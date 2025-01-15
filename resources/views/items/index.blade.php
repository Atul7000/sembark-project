@extends('layouts.app')

@section('content')
<div class="container my-3">
    <h6 class="text-center mb-4">Item List</h6>
    <a href="{{ url('/form') }}" class="btn btn-success mb-2">Add Items</a>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Filter Items</div>
        <div class="card-body">
            <form method="GET" action="{{ route('items.index') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ request('title') }}" placeholder="Search by title">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="start_date" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="end_date" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 mb-3" style="margin-top: auto;">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Item Table -->
    <div class="card">
        <div class="card-header bg-secondary text-white">Item List</div>
        <div class="card-body">
            @if($items->count())
                <table class="table table-striped table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <img src="{{ url('storage/' . $item->image_path) }}" alt="Item Image" class="img-thumbnail" style="width: 50px; height: 50px;">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $items->links() }}
                </div>
            @else
                <p class="text-center text-muted">No items found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
