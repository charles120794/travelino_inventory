<div class="modal fade" id="modalshowrecentcashier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-list"></i> Transaction History </h4>
    		</div>
    		<div class="modal-body" id="modal_load_recent_cashier">
                
    		</div>
    		<div class="modal-footer">
    			<button type="submit" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).on('click', '.cashier-history-page-number', function(event){
        retrieve_recent_cashier($(this).data('page'));
        event.preventDefault();
    });
</script>
@endpush