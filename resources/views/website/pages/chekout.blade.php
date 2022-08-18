@extends('website.master')
@section('content')
<div class="container" style="height: 60vh; margin-top:100px;">
<div class="row">
    <div class="col-md-6">
    <form action="{{url('/place-order')}}" method="POST">
     @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Basice Details
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">Email</label>
                        <input type="text"name="email" class="form-control" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">password</label>
                        <input type="text" name="password" class="form-control" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">Address1</label>
                        <input type="text" name="address" class="form-control" id="">
                    </div>

                    <div class="col-md-6">
                        <label for="">Country</label>
                        <input type="text" name="country" class="form-control" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">city</label>
                        <input type="text" name="city" class="form-control" id="">
                    </div>
                </div>
            </div>
            <button class="btn btn-danger my-2">Place Order</button>
        </div>
        </form>
        <div id="paypal-button-container"></div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Order Items
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $total=0; @endphp
                    @foreach($cart as $c)
                        <tr>
                            <td>{{$c->product->name}}</td>
                            <td>{{$c->product->price}}</td>
                            <td>{{$c->qty}}</td>
                        </tr>
                        @php $total +=$c->product->price * $c->qty ; @endphp
                    @endforeach
                    </tbody>
                </table>
                <label class="my-2">Total: {{$total}}</label>

            </div>
        </div>
    </div>
</div>

    </div>


    @section('script')

    <script src="https://www.paypal.com/sdk/js?client-id=AS_eM6AP5MMUnAQct_1EiBxZoe6oZYjmzHOM4mE4cQvvIuz73uAG6OkLC1op2txB_a1cZ5y_sSXlWXzI"></script>

    <script>

      paypal.Buttons({

        // Sets up the transaction when a payment button is clicked

        createOrder: (data, actions) => {

          return actions.order.create({

            purchase_units: [{

              amount: {

                value: '{{$total}}' // Can also reference a variable or function

              }

            }]

          });

        },

        // Finalize the transaction after payer approval

        onApprove: (data, actions) => {

          return actions.order.capture().then(function(orderData) {

            // Successful capture! For dev/demo purposes:

            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            const transaction = orderData.purchase_units[0].payments.captures[0];

            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);



        });

        }

      }).render('#paypal-button-container');

    </script>

    <script>
        $(document).ready(function(){
            $('.paypal').click(function(e){
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method:'POST',
                        url:'/payment',
                        data:{
                            'total':'{{$total}}'
                        },
                        success:function(response){
                            alert(response.status);
                        }
                    });
            })
        })
    </script>

    @endsection
@endsection
