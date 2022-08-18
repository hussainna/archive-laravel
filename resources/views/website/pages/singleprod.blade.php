@extends('website.master')
@section('content')
<section class="single-product py-5">
      @csrf
      <div class="container">
        <div class="row">
          <div class="col-10 mx-auto col-lg-4 my-5 text-center">
            <div class="single-product-img-container">
              <img src="{{url('uploads/img/'.$product->img)}}" alt="" style="width: 30%;" class="img-fluid">
            </div>
          </div>
          <!-- info -->
          <div class="col-10 col-lg-8 mx-auto px-lg-5 single-product-info my-5">
            <!-- ratings -->
            <div class="ratings">
              <span class="rating-icon">
                <i class="fas fa-star"></i>
              </span>
              <span class="rating-icon">
                <i class="fas fa-star"></i>
              </span>
              <span class="rating-icon">
                <i class="fas fa-star"></i>
              </span>
              <span class="rating-icon">
                <i class="fas fa-star"></i>
              </span>
              <span class="rating-icon">
                <i class="far fa-star"></i>
              </span>
              <span class="text-capitalize">
                (25 Customer Reviews)
              </span>
            </div>
            <!-- end of ratings -->
            <h2 class="text-uppercase my-2">
              PREMIUM OFFICE ARMCHAIR
            </h2>
            <h2 class="text-uppercase my-2">
              {{$product->price}}
            </h2>
            <p class="lead text-muted">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, quae!
            </p>
            <!-- size -->
            <h5 class="text-uppercase product-size">
              SIZES : XS S M L XL
            </h5>
            <!-- end of size -->
            <!-- cart buttons -->
            <div class="d-flex my-2">
              <span class="btn btn-black discrment mx-1">-</span>
              <input type="text" value="1" style="width: 50px;" class="btn btn-black qty-input form-control text-center mx-1"></input>
              <span class="btn btn-black incrment mx-1">+</span>
            </div>
            <input type="hidden" value="{{$product->id}}" class="prod_id">
            <button class="btn btn-success my-2 mx-2">
              Wishlist
            </button>
            <button class="btn btn-danger addToCart my-2 mx-2">
              Add To Cart
            </button>
            <a href="{{url('/cart')}}" class="btn btn-primary my-2 mx-2">
              Show Cart
            </a>
            <!-- end of cart buttons -->
          </div>
        </div>
      </div>
    </section>
@section('script')
        <script>
            $(document).ready(function(){
                $('.addToCart').click(function(e){
                    e.preventDefault();
                    var prod_id=$(this).closest('.single-product').find('.prod_id').val();
                    var qty=$(this).closest('.single-product').find('.qty-input').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method:'POST',
                        url:'/insert',
                        data:{
                            'prod_id':prod_id,
                            'qty':qty,
                        },
                        success:function(response){
                            alert(response.status);
                        }
                    });


                })
                $('.incrment').click(function(e){
                    e.preventDefault();
                    var qty=$('.qty-input').val();
                    var degry=parseInt(qty,10);
                    degry++;
                    $('.qty-input').val(degry);
                })
                $('.discrment').click(function(e){
                    e.preventDefault();
                    var qty=$('.qty-input').val();
                    var degry=parseInt(qty,10);
                    if(qty>0){
                        degry--;
                    }
                    $('.qty-input').val(degry);
                })
            })
        </script>
        @endsection

@endsection
