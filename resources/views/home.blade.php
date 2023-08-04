@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('TO-DO') }}
                    <button class="float-end btn btn-success w-25" data-bs-toggle="modal"
                        data-bs-target="#TodoAdd">Add</button>
                </div>


                <div class="card-body row justify-content-center text-center">
                    <div class="col-6">
                        <h4 class="m-auto py-2 bg-secondary bg-opacity-25 rounded-top-2">TODO</h4>
                        <ul class=" list-group column border-end border-start rounded-0">
                            <li class="list-group-item text-center border-0">
                                <div class="row ">
                                    <div class="col-1 px-2 border-end align-middle">#</div>
                                    <div class=" col px-2 border-end align-middle">TODO
                                    </div>
                                    <div class="col-2 px-2 border-end align-middle">STATUS</div>
                                    <div class="col-4 px-2 row justify-content-around">
                                        ACTION
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <form id="todo-container-form">
                            <ul id="todo-container" class=" list-group column border rounded-top-0">
                                <!-- <li class="list-group-item text-center border-0">
                                    <div class="row ">
                                        <div class="col-1 py-1 px-2 border-end align-middle">1</div>
                                        <div class=" col py-1 px-2 border-end align-middle" data-bs-toggle="collapse"
                                            href="#desc1" role="button" aria-expanded="false"
                                            aria-controls="collapseExample">Sample Name
                                        </div>
                                        <div class="col-2 py-1 px-2 border-end align-middle">OK</div>
                                        <div class="col-4 py-1 px-2 row justify-content-around">
                                            <button class="col-10 btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                    <div class="collapse " id="desc1">
                                        <div class="card  card-body border border-0">
                                            Some placeholder content for the collapse component. This panel is hidden by
                                            default but revealed when the user
                                            activates the relevant trigger.
                                        </div>
                                    </div>
                                </li> -->

                            </ul>
                        </form>
                    </div>
                    <div class="col-6 ">
                        <h4 class="m-auto py-2 bg-secondary bg-opacity-25 rounded-top-2">DONE</h4>
                        <ul class=" list-group column border-end border-start rounded-0">
                            <li class="list-group-item text-center border-0">
                                <div class="row ">
                                    <div class="col-1 px-2 border-end align-middle">#</div>
                                    <div class=" col px-2 border-end align-middle">TODO
                                    </div>
                                    <div class="col-2 px-2 align-middle">STATUS</div>

                                </div>
                            </li>
                        </ul>
                        <ul id="done-container" class="  list-group column border rounded-top-0">
                            
                            <!-- <li class="list-group-item text-center border-0">
                                <div class="row ">
                                    <div class="col-1 py-1 px-2 border-end align-middle">1</div>
                                    <div class=" col py-1 px-2 border-end align-middle" data-bs-toggle="collapse"
                                        href="#desc1" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">Sample Name
                                    </div>
                                    <div class="col-2 py-1 px-2 border-end align-middle bg-success text-light rounded">
                                        Done
                                    </div>

                                </div>
                                <div class="collapse " id="desc1">
                                    <div class="card  card-body border border-0">
                                        Some placeholder content for the collapse component. This panel is hidden by
                                        default but revealed when the user
                                        activates the relevant trigger.
                                    </div>
                                </div>
                            </li> -->
                        </ul>
                    </div>
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
                <h5 class="modal-title" id="TodoAddLabel">Add TO-DO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="todo-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <label for="name" class="form-control-label">New TODO</label>
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
                <button type="button" class="btn btn-primary" id="click-save">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/dragdrop.js') }}"></script>
<script>
    $('#click-save').click(function () {
        $.ajax({
            type: "POST",
            url: "{{ url('api/todo') }}",
            data: $('#todo-form').serialize(),
            success: function (response) {
                alert(response["message"]);
            },
        });
    });

    
    
    $(document).ready( async function () {
        await $.ajax({
            type: "GET",
            url: "{{ url('api/todo') }}",
            success: function (response) {
                let data = response;
                
                let content = "";
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    if(element.user_id == {{ Auth::user()->id }})
                    if (element.status > 1 ){
                        let status = element.level == 1 ? "Ongoing" : "Pending";
                        $("#todo-container").append(`
                            <li class="list-group-item text-center border-0">
                                <div class="row ">
                                    <input type="hidden" name="id[]" value="${element.id}">
                                    <input type="hidden" name="level[]" value="${element.level}">
                                    <div id="todo-id" class="col-1 py-1 px-2 border-end align-middle">${element.level}</div>
                                    <div class=" col py-1 px-2 border-end align-middle" data-bs-toggle="collapse"
                                        href="#desc${element.id}" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">${element.name}
                                    </div>
                                    <div class="col-2 py-1 px-2 border-end align-middle status">${status}</div>
                                    <div class="col-4 py-1 px-2 row justify-content-around">
                                        <a class="col-10 btn btn-danger" data-id="${element.id}">Delete</a>
                                    </div>
                                </div>
                                <div class="collapse " id="desc${element.id}">
                                    <div class="card  card-body border border-0">
                                        ${element.desc}
                                    </div>
                                </div>
                            </li>
                    
                    `);
                    }else{
                        $('#done-container').append(`
                            <li class="list-group-item text-center border-0">
                                <input type="hidden" name="id[]" value="${element.id}">
                                <input type="hidden" name="level[]" value="${element.level}">
                                <div class="row ">
                                    <div class="col-1 py-1 px-2 border-end align-middle">1</div>
                                    <div class=" col py-1 px-2 border-end align-middle" data-bs-toggle="collapse"
                                        href="#desc${element.id}" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">${element.name}
                                    </div>
                                    <div class="col-2 py-1 px-2 border-end align-middle bg-success text-light rounded">
                                        Done
                                    </div>

                                </div>
                                <div class="collapse " id="desc${element.id}">
                                    <div class="card  card-body border border-0">
                                        ${element.desc}
                                    </div>
                                </div>
                            </li>
                        `);
                    
                    }
                  

                }
                
                if($("#done-container>li").length == 0){
                    $("#done-container").html(`
                        <li class="list-group-item text-center border-0"> Drop Here</li>
                    `)
                }
                
            }
        });
        await $('.btn-danger').click(function(){
            let id = $(this).data('id');
            
            $.ajax({
                type: "DELETE",
                url: "{{url('api/todo')}}",
                data: {id},
                success: function (response) {
                    location.reload();
                }
            });
        })
        await  updateLevel();
        
        
    });

    
</script>
@endsection