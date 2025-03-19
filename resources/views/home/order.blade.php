<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Clement's Fashion</title>
     <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
        <!-- Font Awesome style -->
        <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}" />
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="{{ asset('home/css/style.css') }}" />
        <!-- Responsive style -->
        <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}" />

    <style type="text/css">
        .center{
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }
        .table,th,td
        {
            border: 1px solid black;

        }
        .th_deg{
            padding: 10px;
            background-color: aqua;
            font-size: 20px;
            font-weight: bold;
        }
    </style>

   </head>
   <body>
         <!-- header section strats -->
          @include('home.header');
         <div class="center">
            <table>
                <tr>
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Payment Status</th>
                    <th class="th_deg">Delivery Status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Cancel Order </th>

                </tr>
                @foreach($orders as $order)
                <tr>
                    <td> {{$order->product_title}} </td>
                    <td> {{$order->quantity}}</td>
                    <td>{{$order->price}} </td>
                    <td> {{$order->payment_status}}</td> 
                    <td> {{$order->delivery_status}}</td>
                    <td> 
                        <img height="100" width="180" src="product/{{$order->image}}">
                    </td>
                    <td> 
                        @if($order->delivery_status=='processing')
                        
                            <a onclick="return confirm('Are You Sure To Cancel This Order !!!')" class="btn btn-danger" href="{{url('cancel_order',$order->id)}}">Cancel Order</a>

                        @else
                        <p style="color:blue;">Not Allowed</p>
                        @endif
                    </td>

                </tr>

                @endforeach
            </table>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>