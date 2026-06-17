<div class="modal-content">

  <div class="modal-header">
    <h5 class="modal-title">Confirm Delete</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  </div>
<form id="deleteForm" method="POST" action="{{ route('leaves.delete', $leave->id) }}">
      @csrf
      @method('DELETE')
  <div class="modal-body">
    Are you sure you want to delete ?
    
  </div>

  <div class="modal-footer">
    

      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Cancel
      </button>

      <button type="submit" class="btn btn-danger">
        Yes, Delete
      </button>
   
  </div>
   </form>

</div>