@extends('layouts.master')
@section('head-css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category list</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCategoryModal" style="float:right;">New Category</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Rank</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->rank}}</td>
                                <td class="action-area"><a class="btn btn-primary" onclick="showCategory('{{$category->id}}')"><i class="fas fa-eye"></i> Show</a><a class="btn btn-success" onclick="editCategory('{{$category->id}}')"><i class="fas fa-edit"></i> Edit</a><a class="btn btn-danger" onclick="deleteApprove('/delete-category/{{$category->id}}')"><i class="fas fa-trash"></i> Delete</a></td>
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

<!-- New Category Modal -->
<div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-labelledby="newCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">    
    <!-- form start -->
    <form action="/save-category" method="POST">
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
                            <label for="inputFormRank">Rank</label>
                            <input type="number" class="form-control" name="form-rank" id="inputFormRank" value="1">
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
<!-- /.New Category Modal -->

<!-- Show Category Modal -->
<div class="modal fade" id="showCategoryModal" tabindex="-1" role="dialog" aria-labelledby="showCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showCategoryModalLabel">Show Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <label for="showCategoryName">Name</label>
                        <input type="text" readonly class="form-control" name="form-name" id="showCategoryName">
                    </div>              
                    <div class="form-group">
                        <label for="showCategoryRank">Rank</label>
                        <input type="number" readonly class="form-control" name="form-rank" id="showCategoryRank">
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
<!-- /.Show Category Modal -->

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- form start -->
    <form action="/update-category" method="POST">
        @csrf
        <input type="hidden" name="form-id" id="editCategoryId">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="editCategoryName">Name</label>
                            <input type="text" class="form-control" name="form-name" id="editCategoryName">
                        </div>              
                        <div class="form-group">
                            <label for="editCategoryRank">Rank</label>
                            <input type="number" class="form-control" name="form-rank" id="editCategoryRank">
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
<!-- /.Edit Category Modal -->
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
function showCategory(category_id)
{
    $.ajax({
			type: 'GET', 
            url: '/show-category/'+category_id,
            dataType: 'json',
            success: function (data) {
                $('#showCategoryName').val(data.name);
                $('#showCategoryRank').val(data.rank);
                $('#showCategoryModal').modal('show');
                console.log(data);                
               
            },error:function(){ 
                console.log(data);
            }
		});
}

function editCategory(category_id)
{
    $.ajax({
			type: 'GET', 
            url: '/show-category/'+category_id,
            dataType: 'json',
            success: function (data) {
                $('#editCategoryId').val(data.id);
                $('#editCategoryName').val(data.name);
                $('#editCategoryRank').val(data.rank);
                $('#editCategoryModal').modal('show');
                console.log(data);                
               
            },error:function(){ 
                console.log(data);
            }
		});
}
</script>
@endsection
