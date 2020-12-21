@extends('admin.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                       {{$breadcrumb}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
        <div class="container-fluid justify-content-center">
           {{$slot}}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection

@section('script')
    {{ $script ?? '' }}
@endsection

@section('head')
    {{ $head ?? '' }}
@endsection

