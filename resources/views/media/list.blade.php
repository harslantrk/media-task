@extends('layouts.master')
@section('head-css')
<!-- DataTables -->
<link rel="stylesheet" href="/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Media list</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newMediaModal" style="float:right;">New Media</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($medias as $key => $media)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$media->name}}</td>
                                <td>{{$media->category->name}}</td>
                                <td class="action-area"><a class="btn btn-primary" onclick="showMedia('{{$media->id}}')"><i class="fas fa-eye"></i> Show</a><a class="btn btn-success" onclick="editMedia('{{$media->id}}')"><i class="fas fa-edit"></i> Edit</a><a class="btn btn-danger" onclick="deleteApprove('/delete-media/{{$media->id}}')"><i class="fas fa-trash"></i> Delete</a></td>
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
</div>
<!-- /.container-fluid -->

<!-- New Media Modal -->
<div class="modal fade" id="newMediaModal" tabindex="-1" role="dialog" aria-labelledby="newMediaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">    
    <!-- form start -->
    <form action="/save-media" method="POST">
    @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputFormName">Name</label>
                            <input type="text" class="form-control" name="form-name" id="inputFormName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="inputFormCategory">Category</label>
                            <select class="form-control" id="inputFormCategory" name="form-category">
                                <option selected disabled>Select</option>
                                @foreach($categories as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>                
                        <div class="form-group">
                            <label for="inputFormDescription">Description</label>
                            <textarea class="form-control" name="form-description" id="inputFormDescription"></textarea>
                        </div>                
                        <div class="form-group">
                            <label for="inputFormSource">Source</label>
                            <input type="text" class="form-control" name="form-source" id="inputFormSource" placeholder="Enter source">
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
  </div>
</div>
<!-- /.New Media Modal -->

<!-- Show Media Modal -->
<div class="modal fade" id="showMediaModal" tabindex="-1" role="dialog" aria-labelledby="showMediaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showMediaModalLabel">Show Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" readonly class="form-control" name="form-name" id="showMediaName">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" readonly class="form-control" name="form-name" id="showMediaCategory">
                    </div>                
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" readonly name="form-description" id="showMediaDescription"></textarea>
                    </div>                
                    <div class="form-group">
                        <label>Source</label>
                        <input type="text" readonly class="form-control" name="form-name" id="showMediaSource">
                    </div>
                </div>
                <!-- /.card-body -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- /.Show Media Modal -->

<!-- Update Media Modal -->
<div class="modal fade" id="editMediaModal" tabindex="-1" role="dialog" aria-labelledby="editMediaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">    
    <!-- form start -->
    <form action="/update-media" method="POST">
        @csrf
        <input type="hidden" name="form-id" id="editMediaId">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMediaModalLabel">Edit Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="form-name" id="editMediaName">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" id="editMediaCategory" name="form-category">
                                <option selected disabled>Select</option>
                                @foreach($categories as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>                
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="form-description" id="editMediaDescription"></textarea>
                        </div>                
                        <div class="form-group">
                            <label>Source</label>
                            <input type="text" class="form-control" name="form-source" id="editMediaSource">
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
  </div>
</div>
<!-- /.Update Media Modal -->
@endsection
@section('foot-js')

<!-- DataTables  & Plugins -->
<script src="/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
function showMedia(media_id)
{
    $.ajax({
			type: 'GET', 
            url: '/show-media/'+media_id,
            dataType: 'json',
            success: function (data) {
                $('#showMediaName').val(data.name);
                $('#showMediaCategory').val(data.category.name);
                $('#showMediaDescription').text(data.description);
                $('#showMediaSource').val(data.source);
                $('#showMediaModal').modal('show');
                console.log(data);                
               
            },error:function(){ 
                console.log(data);
            }
		});
}

function editMedia(media_id)
{
    $.ajax({
			type: 'GET', 
            url: '/show-media/'+media_id,
            dataType: 'json',
            success: function (data) {
                $('#editMediaId').val(data.id);
                $('#editMediaName').val(data.name);
                $('#editMediaCategory').val(data.category.id);
                $('#editMediaDescription').text(data.description);
                $('#editMediaSource').val(data.source);
                $('#editMediaModal').modal('show');
                console.log(data);                
               
            },error:function(){ 
                console.log(data);
            }
		});
}
</script>
@endsection
