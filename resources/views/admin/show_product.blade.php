<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style type="text/css">
        .center{
            margin: auto;
            width: 50%;
            border: 2px solid white;
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
            padding: 30px;
        }
        
/*   .h2_class : For "All Products"  */


        .h2_class {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }


        th {
            white-space: nowrap;
            padding: 15px;
            background-color: #191c24;
        }


        th, td {
            border: 2px solid grey;
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
                  
                @if(session()->has('message'))
                    <div class="alert alert-success"> 
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{session()->get('message')}}
                    </div>
                @endif

        <h2 class="size_font">All Products</h2>
                <table class="center">
                    <tr class="color">
                        <th class="th_deg">Title</th>
                        <th class="th_deg">Description</th>
                        <th class="th_deg">price</th>
                        <th class="th_deg">discount_price</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg"> Category</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Delete</th>
                        <th class="th_deg">Edit</th>
                    </tr>
                    @foreach ($product as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->category}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$product->image}}">
                        </td>
                        <td> 
                            <a class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This')" href="{{url('delete_product',$product->id)}}">Delete</a>
                        </td>
                        <td> 
                            <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Edit</a>
                        </td>
            
                    </tr>
                @endforeach
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