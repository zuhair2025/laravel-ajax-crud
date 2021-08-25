@extends('layouts.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Countries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Countries</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">DataTable with default features</h3>
                        <button class="btn btn-success pull-right" onclick="create()">Add New</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Country</th>
                                <th>Code</th>
                                <th>Continent</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Code:</label>
                            <input class="form-control" type="text" name="code">
                        </div>
                        <div class="form-group">
                            <label for="">Continent:</label>
                            <input class="form-control" type="text" name="continent">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btnSave" type="button" onclick="store()">Save</button>
                        <button class="btn btn-primary btnUpdate" type="button" onclick="update()">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@section('js')
    <script>
        var adminUrl = '{{url('admin')}}';
        var _modal = $('#myModal');
        var btnSave = $('.btnSave');
        var btnUpdate = $('.btnUpdate');

        $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{csrf_token()}}'}
        });

        function getRecords(){
            $.get(adminUrl + '/getData', function(data, status){
//                alert("Data: " + data + "\nStatus: " + status);
                var html='';
                data.forEach(function (row) {
                    html+='<tr>'
                    html+='<td>'+row.id+'</td>'
                    html+='<td>'+row.name+'</td>'
                    html+='<td>'+row.code+'</td>'
                    html+='<td>'+row.continent+'</td>'
                    html+='<td>'
                    html+='<button type="button" class="btn btn-success btnEdit">Edit</button> '
                    html+='<button type="button" class="btn btn-danger btnDelete" data-id="'+row.id+'" title="Delete Record">Delete</button>'
                    html+='</td><tr>';
                })
                $('table tbody').html(html)
            });
        }

        getRecords()

        function reset(){
            _modal.find('input').each(function(){
                $(this).val(null)
            })
        }

        function getInputs(){
            var id = $('input[name="id"]').val();
            var name = $('input[name="name"]').val();
            var code = $('input[name="code"]').val();
            var continent = $('input[name="continent"]').val();
            return {id:id,name:name,code:code,continent:continent}
        }
        function create(){
            _modal.find('.modal-title').text('New Contact');
            reset();
            _modal.modal('show')
            btnSave.show()
            btnUpdate.hide()
        }
        function store(){
            if(!confirm('Are you sure?')) return;
            $.ajax({
                method: 'POST',
                url: adminUrl + '/countries/store',
                data:getInputs(),
                dataType:'JSON',
                success: function(){
                    console.log('inserted')
                    reset()
                    _modal.modal('hide')
                    getRecords();
                }
            })
        }

        $('table').on('click','.btnEdit',function(){
            _modal.find('.modal-title').text('Edit Country')
            _modal.modal('show')
            btnSave.hide()
            btnUpdate.show()
            var id = $(this).parent().parent().find('td').eq(0).text()
            var name = $(this).parent().parent().find('td').eq(1).text()
            var code = $(this).parent().parent().find('td').eq(2).text()
            var continent = $(this).parent().parent().find('td').eq(3).text()
            $('input[name="id"]').val(id)
            $('input[name="name"]').val(name)
            $('input[name="code"]').val(code)
            $('input[name="continent"]').val(continent)
        })

        function update() {
            if(!confirm('Are you sure?')) return;
            $.ajax({
                method: 'POST',
                url: adminUrl + '/countries/update',
                data:getInputs(),
                dataType:'JSON',
                success: function(){
                    console.log('updated')
                    reset()
                    _modal.modal('hide')
                    getRecords();
                }
            })
        }

        $('table').on('click','.btnDelete',function(){
            if(!confirm('Are you sure?')) return;
            var id = $(this).data('id');
            var data = {id:id}

            $.ajax({
                method: 'POST',
                url: adminUrl + '/countries/delete',
                data:data,
                dataType:'JSON',
                success: function(){
                    console.log('deleted');
                    getRecords();
                }
            })
        })
    </script>
@endsection