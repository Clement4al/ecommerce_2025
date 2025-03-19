<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category()
    {
        if (Auth::id()){

            $data = Category::all();

            return view('admin.category',compact('data'));
        }
        else
        {
            return redirect('login');
        }
       
    }

    public function add_category(Request $request)
    {
        if (Auth::id()){
        $data =  new category();

        $data->category_name=$request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category added successfully');    
    }
    
    else
    {
        return redirect('login');

    }
}
    public function delete_category($id)
    {
        if (Auth::id()){

        $data = category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
    else{
        return redirect('login');

    }
}
    public function view_product()
    {
        if (Auth::id()){

        $category = category::all();
        
        return view('admin.product',compact('category'));
    }
    else {
        return redirect('login');

    }
    }
    public function add_product(Request $request)
    {
        if (Auth::id()){

        $product = new Product();
    
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();
    
        return redirect()->back()->with('message', 'product added successfully');
    }
    else{
        return redirect('login');

    }
}

    public function show_product(){

        if (Auth::id()){

        $product = Product::all();

        return view('admin.show_product', compact('product'));
    }
else{
    return redirect('login');

}
    }
    public function delete_product($id){
        if (Auth::id()){

        $product = product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }
    else{
        return redirect('login');

    }
}
    public function update_product($id){

        if (Auth::id()){

        $product = product::find($id);

        $category = category::all();
        
        return view('admin.update_product',compact('product','category'));

    }
    else
    {
        return redirect('login');

    }
}
    public function update_product_confirm(Request $request , $id)
    {
        if (Auth::id()){

        $product = product::find($id);

        $product->title= $request->title;
        $product->description= $request->description;
        $product->price= $request->price;
        $product->discount_price= $request->discount_price;
        $product->category= $request->category;

        
        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $imagename);
            $product->image = $imagename;
        }
        
        $product->save();
    
        return redirect()->back()->with('message', 'Product Updated Successfully');

    }
else {
    return redirect('login');
    }
}
    public function order()
    {
        $order = Order::all(); // Use paginate instead of all()
        
        return view('admin.order', compact('order'));
    }

    public function delivered($id){

        $order= Order::find($id);

        $order->delivery_status="delivered";

        $order->payment_status="paid";

        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id){

        $order=Order::find($id);

        $pdf = Pdf::loadView('admin.pdf',compact('order'));

        return $pdf->download('order_details.pdf');

    }
    public function send_email($id){
        $order=Order::find($id);
        return view('admin.email_info',compact('order'));
    }

    public function send_user_email(Request $request, $id){

        $order=order::find($id);

        $details = [
            'greeting' =>$request->greeting,
            'firstline' =>$request->firstline,
            'body' =>$request->body,
            'button' =>$request->button,
            'url' =>$request->url,
            'lastline' =>$request->lastline,

        ];

        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();

    }
    public function searchdata(Request $request)
    {
        $searchText = $request->search;
    
        // Search for orders by name or email
        $orders = Order::where('name', 'LIKE', "%$searchText%")
                       ->orWhere('email', 'LIKE', "%$searchText%")
                       ->get();
        
        return view('admin.order', compact('orders'));
    }
}

