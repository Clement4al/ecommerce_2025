<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
  </head>
  <style type="text/css">

    .div_center{
            text-align: center;
            padding-top: 40px;
    }
    .h2_font{
            font-size: 40px;
            padding-bottom: 40px;
    }
    .input_color{
        color: black;
    }
    .center{
        margin: auto;
        text-align: center;
        width: 50%;
        border: 3px solid green;
        margin-top: 30px;
    }
    </style>
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

            <div class="div_center"> 

                <h2 class="h2_font">Add Category</h2>
                <form action="{{url('/add_category')}}" method="POST">
                    @csrf
                    <input class="input_color" type="text" name="category" placeholder="Write category name">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                </form>
            </div>
            <table class="center"> 

                <tr> 
                    <td>Category Name</td>
                    <td>Action</td>
                </tr>

                @foreach ($data as $data)
                    <tr> 
                        <td>{{$data->category_name}}</td>
                        <td>
                            <a onclick="return confirm('Are You Sure You Want To Delete This')"
                             class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a>
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