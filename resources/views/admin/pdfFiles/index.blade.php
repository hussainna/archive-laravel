@extends('admin.master')

@section('content')
<div style="align-items: center; text-align:center; margin-left:300px; margin-top:30px; width:70%;" class="container">
<div class="card">
    <div class="card-header d-flex">
        <h4 class="flex-grow-1">The PDF</h4>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal">
          Add PDF
        </button>
      </div>
        <div class="card-body">
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="imageModalLabel">Add PDF</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Form to insert image -->
                      <form action="{{url('/insert-pdf')}}" enctype="multipart/form-data" method="POST" >
                        @csrf

                        <div class="form-group">
                            <label for="imageInput">PDF Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter PDF Name">
                          </div>
                        <div class="form-group">
                          <label for="imageInput">PDF File</label>
                          <input type="file" name="pdf" class="form-control" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="row d-flex">
                @foreach($pdf as $p)
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <img style="width: 100%; height:80%;" src="{{url('uploads/pdf/pdf.png')}}" >

                        
                        <a href="{{ url('download-pdf/'.$p->pdf) }}">
                            {{$p->name}} <i class="fas fa-download"></i>
                        </a>            
                    </div>
                @endforeach
            </div>
               
              
       
       
            </div>
    </div>
</div>
@endsection
