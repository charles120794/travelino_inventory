<div class="modal fade" id="modaleditwarehouse">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'update-warehouse', 'id' => encrypt(1)]) }}"> @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Update Warehouse </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Warehouse</label> <span class="text-red">*</span>
                        <input type="hidden" name="warehouse_id" id="warehouse_id">
                        <input type="text" class="form-control" name="warehouse_description" id="warehouse_description" autocomplete="warehouse-description" maxlength="100" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Update </button>
                </div>
            </form>
        </div>
    </div>
</div>