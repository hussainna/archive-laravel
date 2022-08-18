@extends('admin.master')
@section('content')
<div style="align-items: center; text-align:center; margin-left:300px; margin-top:30px; width:70%;" class="container">
    <div class="card">
        <div class="card-header">
            <h4>Add Product Items</h4>
        </div>
        <div class="card-body">
            <form action="{{url('/insert-product')}}" enctype="multipart/form-data" method="POST" >
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
