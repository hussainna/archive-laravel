@extends('website.master')
@section('content')
<div class="container" style="height: 60vh; margin-top:80px; width:50%">
@csrf
        <div class="card shadow product_data">
            <div class="card-body">
                @php $total=0; @endphp
                @foreach($cart as $c)
                <div class="row product-data" style="margin-bottom: 20px;">
                  <input type="hidden" class="cart_id" value="{{$c->id}}">
                    <div class="col-md-2">
                        <img style="width: 50%;" src="{{url('uploads/img/'.$c->product->img)}}" alt="">
                    </div>
                    <div class="col-md-5">
                        <h3>{{$c->product->name}}</h3>
                    </div>
                    <div class="col-md-3">
                        <h5>Quantity: {{$c->qty}}</h5>
                    </div>
                    <div class="col-md-2">
                        <h3 class="delete btn btn-danger">Remove</h3>
                    </div>
                </div>
                @php $total +=$c->product->price * $c->qty ; @endphp

                @endforeach
                <a href="{{url('/check-out')}}" class="my-2 btn btn-primary">Ceck Out</a>

                <div class="card-footer">
                    <h6 class="total">Total Price: {{$total}}</h6>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function(){
                $('.delete').click(function(e){
                    e.preventDefault();
                    var cart_id=$(this).closest('.product-data').find('.cart_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method:'POST',
                        url:'/delete-cart',
                        data:{
                            'cart_id':cart_id,
                        },
                        success:function(response){
                            window.location.reload();
                        }
                    });


                })
            })
        </script>
        @endsection
@endsection
