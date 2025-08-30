@if (Session::has('success'))
<div class="modal fade" id="exampleModalSuccess" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-body"> 
       <div class="modal-toggle-wrapper text-center">  
         <ul class="modal-img list-unstyled">
           <li> 
             <img src="{{asset('assets/images/gif/dashboard-8/successful.gif')}}" alt="success" width="120">
           </li>
         </ul>
         <h4 class="pb-2">Berhasil!</h4>
         <p class="c-light">{{ session('success') }}</p>
         <button class="btn btn-success d-flex m-auto" type="button" data-bs-dismiss="modal">OK</button>
       </div>
     </div>
   </div>
 </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModalSuccess'));
        myModal.show();
    });
</script>
@endif

@if (Session::has('error'))
<div class="modal fade" id="exampleModalError" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-body"> 
       <div class="modal-toggle-wrapper text-center">  
         <ul class="modal-img list-unstyled">
           <li> 
             <img src="{{asset('assets/images/gif/danger.gif')}}" alt="error" width="120">
           </li>
         </ul>
         <h4 class="pb-2">Oops! Terjadi Kesalahan</h4>
         <p class="c-light">{{ session('error') }}</p>
         <button class="btn btn-danger d-flex m-auto" type="button" data-bs-dismiss="modal">Tutup</button>
       </div>
     </div>
   </div>
 </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModalError'));
        myModal.show();
    });
</script>
@endif
