<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Order;
use Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;

 
class HomeController extends Controller
{
    public function index (){
        $product = Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get(); 
        $reply = Reply::all(); 
        return view('home.userpage',compact('product', 'comment', 'reply'));
        
    }
    public function redirect() {

        $usertype=Auth::user()->usertype; 

        if ($usertype == '1')
        {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();

            $total_revenue = 0;
            foreach ($order as $order){
                $total_revenue=$total_revenue + $order->price;

                $formatted_total_revenue = 'N' . number_format($total_revenue, 0, '.', ','); // Format the amount
            }
           $total_delivered = Order::where('delivery_status', '=', 'delivered')->count();

           $total_processing = Order::where('delivery_status', '=', 'processing')->count();

            return view('admin.home', compact('total_product','total_order','total_user','formatted_total_revenue','total_delivered','total_processing'));
        }
        else 
        {
            $product = Product::paginate(10);

            $comment = Comment::orderby('id', 'desc')->get(); 

            $reply = Reply::all(); 

            return view('home.userpage',compact('product', 'comment', 'reply'));
        }
    }

    public function product_details($id){

        $product = Product::find($id);

        return view('home.product_details',compact('product'));

    }

    public function add_cart(Request $request, $id) {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::findOrFail($id); // Use findOrFail to handle non-existent products
    
            // Validate the quantity
            $request->validate([
                'quantity' => 'required|integer|min:1', // Ensure quantity is a positive integer
            ]);
    
            // Check if the product is already in the cart
            $cart = Cart::where('product_id', $id)
                        ->where('user_id', $user->id)
                        ->first();
    
            if ($cart) {
                // Update existing cart item
                $cart->quantity += $request->quantity;
                $cart->price = $this->calculatePrice($product, $cart->quantity);
                $cart->save();

                Alert::success('Product Added successfully', 'We have added product to the cart');

                return redirect()->back();

            } else {
                // Create a new cart item
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                $cart->price = $this->calculatePrice($product, $request->quantity);
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
            }
    
            // Redirect back with a success message

            return redirect()->back();
        } else {
            // Redirect to login if not authenticated
            return redirect('/login');
        }
    }
    
   // Helper method to calculate price
    private function calculatePrice($product, $quantity) {
        return ($product->discount_price ?? $product->price) * $quantity;
    }


    public function show_cart()
    {
        if (Auth::id()){ //check if user is logged in
            $id=Auth::user()->id;

            $carts = Cart::where('user_id','=',$id)->get();

            return view('home.showcart',compact('carts'));
        }
        else {
            return redirect('/login');
        }
        
    }

    public function remove_cart ($id){
            $cart = Cart::find($id);

            $cart->delete();

            return redirect()->back(); 
    }

    public function cash_order(){
        $user = Auth::user();
        $user_id= $user->id;
        $cart = Cart::where('user_id','=',$user_id)->get();

        foreach($cart as $cart){

            $order = new Order;

            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->product_title = $cart->product_title;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->user_id = $cart->user_id;


            $order->payment_status = 'cash on delivery';

            $order->delivery_status = 'processing';

            $order->save();
            
            //here i am deleting the specific data
            $cart_id = $cart->id; //this is the cart id 
            $cart= Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','We Have Recieved Your Order. We will Connect With You soon...');
    }


    public function stripe($totalprice)
    {

        return view('home.stripe',compact('totalprice'));
        
    }

    public function stripePost(Request $request, $totalprice)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $totalprice * 100,

                "currency" => "naira",

                "source" => $request->stripeToken,

                "description" => "Thanks for Payment" 

        ]);

       (Session::flash('success', 'Payment successful!'));

       // return back();



   //  return redirect()->back()->with('success', 'Payment successful!');
    }

    public function show_order(){
        if(Auth::id()){
            $user=Auth::user();

            $userid= $user->id;

            $orders = Order::where('user_id', '=', $userid)->get();

            return view('home.order', compact('orders'));
        }

        else {
            return redirect('login');
        }
    }
    
    public function cancel_order($id)
    {
        $order=order::find($id);

        $order-> delivery_status= 'You have cancel your order';

        $order->save();

        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if(Auth::id()) 
        {
            $request->validate([
                'comment' => 'required|string|max:255',
            ]);
    
            $comment= new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();
        }
        else 
        {
        return redirect('login');
        }
    }
    public function add_reply(Request $request){
        if(Auth::id()) {
            $request->validate([

                'reply' => 'required|string|max:255',
            ]);
    
            $reply = new Reply; 

            $reply->name= Auth::user()->name;
            $reply->user_id= Auth::user()->id;
            $reply->comment_id= $request->commentId;
            $reply->reply= $request->reply;
            $reply->save();
            return redirect()->back();

        }
        else 
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request){

            $comment = Comment::orderby('id', 'desc')->get(); 

            $reply = Reply::all(); 

            $search_text= $request->search;

            $product = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text%")->paginate(10);

            return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function products(){

        $product = Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get(); 
        $reply = Reply::all(); 

        return view('home.all_product', compact('product', 'comment', 'reply'));
        
        Alert::success('Product Added successfully', 'We have added product to the cart');

        return redirect()->back();

    }

    public function search_product(Request $request){

        $comment = Comment::orderby('id', 'desc')->get(); 

        $reply = Reply::all(); 

        $search_text= $request->search;

        $product = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text%")->paginate(10);

        return view('home.all_product', compact('product', 'comment', 'reply'));
}

}
