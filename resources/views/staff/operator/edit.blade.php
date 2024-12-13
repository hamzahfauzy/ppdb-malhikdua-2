@extends('layouts.staff')
@section('title','Data Pembayaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Operator : {{$operator->name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/staff">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('staff.operator.index')}}">Operator</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content profile">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body login-card-body">
                @if ($msg = session('contact_exists'))
                    <div class="alert alert-danger" role="alert">
                        {{ $msg }}
                    </div>
                @endif
                <form action="{{route('staff.operator.update', $operator->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    @include('staff.operator.form')
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
