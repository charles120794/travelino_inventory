<form class="form-horizontal" action="{{ route('settings.route',['path' => $path, 'action' => $createWindow , 'id' => encrypt('') ]) }}" method="post"> {{ csrf_field() }}

    <div class="col-sm-8 col-sm-offset-2">

        <h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-table fa-fw"></i> System Window</h2>
        <hr>

        <div class="box-body">

            <div class="col-sm-12">

                <input type="hidden" name="module_id" id="form_module_id">

                <div class="form-group">
                    <label for="class" class="control-label"> Parent Class </label>
                    <select class="form-control input-sm" id="menu_parent" name="menu_parent">
                        <option value="0"> Main Class </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label"> Name / Title </label>
                    <input type="text" class="form-control input-sm" name="menu_name" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="path" class="control-label"> Path / Slug </label>
                    <input type="text" class="form-control input-sm" name="menu_path" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="type" class="control-label"> Menu Type </label>
                    <select class="form-control input-sm" name="menu_type">
                        <option value="0"> Without Dropdown </option>
                        <option value="1"> With Dropdown </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class" class="control-label"> Font Awesome Icon </label>
                    <input type="text" class="form-control input-sm" name="menu_icon">
                </div>
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit </button>
                </div>

            </div>

        </div>

    </div>
        
</form>
  