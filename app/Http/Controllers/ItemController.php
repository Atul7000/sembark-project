<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        // Filtering
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Pagination
        $items = $query->orderBy('id', 'desc')->paginate(10);

        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'items.*.image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'items.*.title' => 'required|max:255',
            'items.*.description' => 'required|max:250',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.date' => 'required|date',
        ],
        [
            // Custom messages for 'image'
            'items.*.image.required' => 'The image field is required.',
            'items.*.image.image' => 'The image field must be a valid image.',
            'items.*.image.mimes' => 'The image must be of type: jpeg, png, jpg, or gif.',
            'items.*.image.max' => 'The image must not be greater than :max kilobytes.',
            
            // Custom messages for 'description'
            'items.*.description.max' => 'The description field must not be greater than :max characters.',
            'items.*.description.required' => 'The description field is required.',
            
            // Additional custom messages for other fields
            'items.*.title.required' => 'The title field is required.',
            'items.*.quantity.min' => 'The quantity must be at least :min.',
            'items.*.price.min' => 'The price must be at least :min.',
            'items.*.date.date' => 'The date field must be a valid date.',
        ]
    );

        foreach ($request->items as $item) {
            $imagePath = $item['image']->store('images', 'public');

            Item::create([
                'image_path' => $imagePath,
                'title' => $item['title'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'date' => $item['date'],
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Items saved successfully.');
    }
}
