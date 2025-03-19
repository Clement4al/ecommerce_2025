<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style type="text/css">
.title_deg{
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    text-align: center;
    font-size: 50px;
    font-weight: bold;
    color: rgb(239, 243, 245);
}
.center{
            margin: auto;
            width: 100%;
            /* border: 2px solid white; */
            text-align: center;
            margin-top: 40px;
        }
        .size_font{
            text-align: center;
            padding-top: 20px;
            font-size: 40px;
        }
        .img_size{
            height: 150px;
            width: 150px
        }
        .color{
            background: gold;
        }
        .th_deg{
            /* padding: 30px; */
        }
        
/*   .h2_class : For "All Products"  */


        .h2_class {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }


        th {
            padding: 15px;
            background-color: #191c24;
        }


        th, td {
            /* border: 2px solid grey; */
        }
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
        <!-- partial:partials/_navbar.html -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title_deg">All Orders</h1>

            {{-- <div style="padding-left: 400px; padding-bottom:20px;">
                <form action="" method="">
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div> --}}
            <div style="display: flex; justify-content: center; padding-bottom: 20px; padding-top: 20px;">
                <form action="{{url('search')}}" method="get" style="display: flex; align-items: center;">
                    @csrf
                    <input type="text" name="search" placeholder="Search..." 
                           style="padding: 10px; border: 2px solid #007bff; border-radius: 25px; 
                                  width: 300px; font-size: 16px; color:black; transition: border-color 0.3s; 
                                  outline: none;" 
                           onfocus="this.style.borderColor='#0056b3';" 
                           onblur="this.style.borderColor='#007bff';">
                    <input type="submit" value="Search" 
                           style="padding: 10px 20px; margin-left: 10px; border: none; 
                                  border-radius: 25px; background-color: #007bff; 
                                  color: white; font-size: 16px; cursor: pointer; 
                                  transition: background-color 0.3s;" 
                           onmouseover="this.style.backgroundColor='#0056b3';" 
                           onmouseout="this.style.backgroundColor='#007bff';">
                </form>
            </div>
                <table class="center">
                    <tr class="color">
                        <th class="th_deg">Name</th>
                        <th class="th_deg">Email</th>
                        <th class="th_deg">Phone</th>
                        <th class="th_deg">Address</th>
                        <th class="th_deg">Product title</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Payment Status</th>
                        <th class="th_deg">Delivery Status </th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Delivered</th>
                        <th class="th_deg">Print PDF</th>
                        <th class="th_deg">Send Email</th>
                    </tr>
                    @forelse ($order as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                                <img src="/product/{{$order->image}}">
                        </td>
                        <td>
                            @if($order->delivery_status == 'processing')
                                <a href="{{url('delivered', $order->id)}}" onclick="return confirm('Are You This Product is delivered!!!')" class="btn btn-primary">Delivered</a>
                           
                             @else

                                <p style="color: rgb(5, 179, 5)">Delivered</p> 

                            @endif
                        </td>

                        <td>
                            <a href="{{url('print_pdf',$order->id)}}"  class="btn btn-secondary"> Print PDF</a>
                        </td>

                        <td>
                            <a href="{{url('send_email',$order->id)}}"  class="btn btn-info"> Send Email</a>
                        </td>
                    </tr>
                    {{-- you cant use foreach with empty --}}
                    @empty
                        <tr>
                            <td colspan="16" >
                               Ops.. No Data Found
                            </td>
                        </tr>
                    
                @endforelse
                </table>

            </div>

        </div>
        <!-- partial -->
     <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>