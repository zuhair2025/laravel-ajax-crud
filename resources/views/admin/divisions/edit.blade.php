@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Subject</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Update Subject</a></li>
                        <li class="breadcrumb-item active">subjects</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header bg-warning">
                        <h3 class="card-title">Update Subject</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Subject:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Subject">
                                @error('subject')
                                <div class="invalid-feedback">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Image:</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button class="btn btn-success">SAVE</button>
                            <a href="{{route('subjects.index')}}" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop