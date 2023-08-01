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
                <div class="card-header">{{ __('TO-DO') }}</div>

                <div class="card-body row justify-content-center">
                    <table class="col-12" >
                        <thead>
                            <tr class="row">
                                <td class="col-auto">Level</td>
                                <td class="col">Name</td>
                                <td class="col-3">Status</td>
                                <td class="col-5">Action</td>
                            </tr>
                        </thead>
                    </table>
                 

                
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
