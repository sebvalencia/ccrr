<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © Your Website 2018</small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 @auth("web")
                <a class="btn btn-primary" href="{{route('user.logout')}}">Logout</a>
                    @endauth
                    
                    @auth("admin")
                         <a class="btn btn-primary" href="{{route('admin.logout')}}">Logout</a>
                      @endauth
                    
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog"  id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         Esta seguro de eliminar el usuario <strong><span id="deleteName"></span></strong>? 
        
        
    
      </div>
      <div class="modal-footer">
            <form method="post" action="" id="deleteForm">
            @csrf
             {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-warning" value="Confirmar">Confirmar </button>  
        </form>
        
      </div>
    </div>
  </div>
</div>