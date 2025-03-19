<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <style type="text/css">
        label{
            display: inline-block;
            width: 150px;
            font-size: 15px;
            font-weight: bold;
            
        }
        .input{
            color: black;
        }

    </style>
    <!-- Required meta tags -->
    @include('admin.css');
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
                <h1 style="text-align: center; font-size:25px;">
                    Send email to {{$order->email}}
                </h1>

            <form action="{{url('send_user_email',$order->id)}}" method="POST">
                @csrf
            <div style="padding-left: 35%; padding-top:30px; ">
                <label>Email Greeting</label>
                <input style="color: black" type="text" name="greeting">
            </div>

            <div style="padding-left: 35%; padding-top:30px; ">
                <label>Email firstline</label>
                <input style="color: black" type="text" name="firstline">
            </div>

            <div style="padding-left: 35%; padding-top:30px; ">
                <label>Email Body</label>
                <input style="color: black" type="text" name="body">
            </div>

            <div style="padding-left: 35%; padding-top:30px; ">
                <label>Email button name</label>
                <input style="color: black" type="text" name="button">
            </div>

            <div style="padding-left: 35%; padding-top:30px; ">
                <label>Email Url</label>
                <input style="color: black" type="text" name="url">
            </div>

            <div style="padding-left: 35%; padding-top:30px; ">
                <label>Email lastline</label>
                <input style="color: black"  type="text" name="lastline">
            </div>

            <div style="padding-left: 35%; padding-top:30px; ">

                <input type="submit" value="Send Email" class="btn btn-primary">
            </div>
        </form>

            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>