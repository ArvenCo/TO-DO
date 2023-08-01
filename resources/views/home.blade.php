@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('TO-DO') }} 
                    <button class="float-end btn btn-success w-25"  data-bs-toggle="modal" data-bs-target="#TodoAdd">Add</button>
                </div>

                    {{-- <div id="head" class=" row col-11 border-bottom text-center">
                        <div class="col-1 p-2 border-end ">Queue</div>
                        <div class="col p-2 border-end">Name</div>
                        <div class="col-2 p-2 border-end">Status</div>
                        <div class="col-4 p-2 ">Action</div>
                    </div> --}}
                    {{-- <div id="body" class="row col-11 text-center justif-centent-center">
                        <div class="col-12 py-1 row text-center mb-1 border-bottom">
                            <div class="col-1 py-1 px-2 border-end " style="">1</div>
                            <div class="col py-1 px-2 border-end">Sample Name</div>
                            <div class="col-2 py-1 px-2 border-end">OK</div>
                            <div class="col-4 py-1 px-2 row justify-content-around">
                                <button class="col-5 btn btn-primary">Edit</button>
                                <button class="col-5 btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div> --}}
                <div class="card-body row justify-content-center ">
                    
                    <ul class="col-11 list-group ">
                        <li class="list-group-item text-center">
                            <div class="row">
                                <div class="col-1 py-1 px-2 border-end align-middle" style="">1</div>
                                <div class="col py-1 px-2 border-end align-middle">Sample Name</div>
                                <div class="col-2 py-1 px-2 border-end align-middle">OK</div>
                                <div class="col-4 py-1 px-2 row justify-content-around">
                                    <button class="col-5 btn btn-primary">Edit</button>
                                    <button class="col-5 btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                 

                
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="TodoAdd" tabindex="-1" aria-labelledby="TodoAddLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="TodoAddLabel">Add Modal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="todo-form">
            <div class="mb-3">
                <label for="name" class="form-control-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-control-label">Description</label>
                <textarea id="desc" name="desc" id="" class="form-control" rows="4"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    
  </script>
@endsection
