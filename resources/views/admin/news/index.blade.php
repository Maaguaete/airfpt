<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('admin.layout.layout')
@section('title', 'AirFpt News')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    <img class="align-text-top mt-0 pt-0" src="{{asset('img/news-icon.jpg')}}" width="50" height="48" alt="" style="border-radius:  5px; padding-left: 1px;">
                    News
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{Route('admin.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">News</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">News</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Topic</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Post date</th>
                                <th>Update date</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $n)
                            <tr>
                                <td>{{ $n->id }}</td>
                                <td>{{ $n->topic }}</td>
                                <td>{{ $n->title }}</td>
                                <td> {{ Str::limit($n->content, 200) }}</td>
                                <td>{{ $n->created_at }}</td>
                                <td>{{ $n->updated_at }}</td>
                                <td><img width="100px" src="{{ url('./img/trucduy/'.$n->image) }}" /></td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ Route('airfpt.user.details',$n->id) }}">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ Route('admin.news.update',$n->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ Route('admin.news.delete',$n->id) }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>



                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection
@section('script-section')
<script>
    $(function() {
        $('#product').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
@endsection