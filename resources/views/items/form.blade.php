@extends('layouts.app')

@section('content')
<div class="container my-3">
    <h6 class="text-center mb-4">Add Multiple Items</h6>
    <a href="{{url('/items')}}" class="btn btn-success mb-2">Show Items</a>
    
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="item-forms">
            <div class="card mb-3 item-form">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="image-0" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image-0" name="items[0][image]" required>
                        </div>
                        <div class="col-md-2">
                            <label for="title-0" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title-0" name="items[0][title]" placeholder="Title" required>
                        </div>
                        <div class="col-md-2">
                            <label for="description-0" class="form-label">Description</label>
                            <textarea class="form-control" id="description-0" name="items[0][description]" placeholder="Description" maxlength="250" rows="2" required></textarea>
                        </div>
                        <div class="col-md-1">
                            <label for="quantity-0" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity-0" name="items[0][quantity]" placeholder="Quantity" required>
                        </div>
                        <div class="col-md-1">
                            <label for="price-0" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price-0" name="items[0][price]" placeholder="Price" step="0.01" required>
                        </div>
                        <div class="col-md-2">
                            <label for="date-0" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date-0" name="items[0][date]" required>
                        </div>
                        <div class="col-md-2">
                            <button style="margin-top: 30px;" type="button" class="btn btn-danger remove-item w-100">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="button" id="add-item" class="btn btn-success">Add More</button>
            <button type="submit" class="btn btn-primary">Save Items</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let itemCount = 1;

// Add new item form dynamically
document.getElementById('add-item').addEventListener('click', () => {
    const itemForms = document.getElementById('item-forms');
    const newItem = itemForms.firstElementChild.cloneNode(true);

    newItem.querySelectorAll('input, textarea').forEach(input => {
        const oldId = input.id.match(/\d+/)[0];
        input.id = input.id.replace(oldId, itemCount);
        input.name = input.name.replace(oldId, itemCount);
        input.value = '';
    });

    // Update remove button visibility
    newItem.querySelector('.remove-item').classList.remove('d-none');
    itemForms.appendChild(newItem);

    itemCount++;
});

// Remove item form dynamically
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-item')) {
        e.target.closest('.item-form').remove();
    }
});

// Validate form before submission
document.querySelector('form').addEventListener('submit', function (e) {
    const itemForms = document.querySelectorAll('.item-form');
    if (itemForms.length === 0) {
        e.preventDefault(); // Prevent form submission
        alert('Please add at least one item before saving.');
        window.location.reload();
        return false;
    }
});
</script>
@endpush
