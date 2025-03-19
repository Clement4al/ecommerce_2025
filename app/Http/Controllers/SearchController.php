<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function searchdata(Request $request)
    {
    // Validate the search input
    $validator = Validator::make($request->all(), [
        'search' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $searchText = $request->input('search');

    // Use a query scope for searching
    $order = Order::search($searchText)->paginate(10); // Paginate results

    return view('admin.order', compact('order'));
    }
}