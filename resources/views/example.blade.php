@extends('layouts.base')

@section('title', 'Dashboard')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Manage Users
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Manage Users</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div> 
@endsection



@section('content')
    
@endsection


@section('styles')
    
@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        // console.log('Page loaded')
    })
</script>
    
@endsection