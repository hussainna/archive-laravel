@extends('admin.master')

@section('content')
<div style="align-items: center; text-align:center; margin-left:300px; margin-top:30px; width:70%;" class="container">
<div class="card">
        <div class="card-header">
            <h4>The Featured Items</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $p)
                    <tr>
                        <td>{{$p->name}}</td>
                        <td>{{$p->price}}</td>
                        <td><img style="width: 50px;" class="cate-image" src="{{url('uploads/img/'.$p->img)}}" ></td>
                        <td><a class="btn btn-primary" href="{{url('/product-edit/'.$p->id)}}">Edit</a></td>
                        <td><a class="btn btn-danger" href="{{url('/product-remove/'.$p->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
