@extends('layouts.app')

@section('content')
    <style>
        .upper {
            margin-top: 40px;
        }
    </style>
    <div class="card upper">
        <div class="card-header">
            Add Product
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form id="form" method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="product_name">Product Name :</label>
                    <input type="text" class="form-control" name="product_name" required/>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity In Stock :</label>
                    <input type="text" class="form-control" name="quantity" required/>
                </div>
                <div class="form-group">
                    <label for="price">Price Per Item :</label>
                    <input type="text" class="form-control" name="price"/>
                </div>
                <input type="submit" id="submit" class="btn btn-primary" value="Add">
                <input type="reset" class="btn btn-danger" value="Cancel">
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // click on button submit
            $("#submit").on('click', function(){
                // send ajax
                $.ajax({
                    url: "{{ url('/') }}",
                    type : "POST",
                    dataType : 'json',
                    data : $("#form").serialize(),
                    success : function(result) {
                        console.log(result);
                    },
                    error: function(xhr, resp, text) {
                        console.log(xhr, resp, text);
                    }
                })
            });
        });

    </script>
    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            Products
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <td>Product name</td>
                    <td>Quantity in stock</td>
                    <td>Price per item</td>
                    <td>Datetime submitted</td>
                    <td>Total value number</td>
                    <td>Options</td>
                </tr>
                @if ($products != null)
                    @foreach($products as $index => $product)
                        <tr>
                            <td>{{$product['product_name']}}</td>
                            <td>{{$product['quantity']}}</td>
                            <td>{{$product['price']}}</td>
                            <td>{{$product['date']}}</td>
                            <td>{{$product['total_value']}}</td>
                            <td>
                                <input type="button" value="edit" class="btn btn-success">
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Sum Total :  </td>
                    <td>{{$full_price}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
