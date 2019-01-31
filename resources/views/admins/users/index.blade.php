@extends('layoutsdashboard.base')

@section('css')

@endsection
@section('content')


<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Usuarios</li>
      </ol>
      <!-- Example DataTables Card-->
      
       @if(Session::has('message_store'))
       <div class="alert alert-danger">
                        <strong>usuario creado</strong>
         </div>
      @endif
      
       @if(Session::has('message_update'))
       <div class="alert alert-danger">
                        <strong>usuario editado</strong>
         </div>
      @endif
       @if(Session::has('message_destroy'))
       <div class="alert alert-danger">
                        <strong>usuario eliminado</strong>
         </div>
      @endif
      
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
         
          <a href="{{route('users.create')}}" class="btn btn-primary">Crear</a>
            <a href="{{route('exportar')}}" class="btn btn-primary">Exportar</a>
          
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>              
                  <th>email</th>                  
                   <th>acciones</th>    
                
                </tr>
              </thead>
         
              <tbody>
               @foreach($users as $user)
                <tr>
                  <td>{{$user->name}}</td>                
                  <td>{{$user->email}}</td>
                 <td>
                     <a href="{{route('users.edit',$user->id)}}"><i class="fas fa-user-edit"></i></a>
                     <a href="#" onclick="showConfirmDeleteModal('{{route('users.destroy',$user->id)}}','{{$user->name}}')"><i class="fas fa-trash-alt"></i></a>
                 </td>
                
                 
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>



@endsection


@section('js')
<script src="{{asset('adminstyle/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('adminstyle/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('adminstyle/js/sb-admin-datatables.js')}}"></script>
<script>

function showConfirmDeleteModal (url,name){
    $('#deleteForm').prop('action', url);
    $('#deleteName').text(name);
     $('#deleteModal').modal();
}
</script>
@endsection