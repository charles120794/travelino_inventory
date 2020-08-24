<?php

namespace App\Http\Traits\Settings;

use Session;
use Storage;
use App\Model\Settings\SystemMedia;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemMediaUploaderTrait
{

    public function upload_image_content($method, $id = null, $request)
    {

        $this->validate($request, [
            'images.*' => 'mimes:'.$this->validatefile('image'),
        ]);

        if($request->hasfile('images'))
        {

            foreach($request->file('images') as $key => $file)
            {
         
                $extension = $file->getClientOriginalExtension();

                $filename = $this->fileName() . '.' . $extension;

                // $directory = storage_path('app/public/' . $this->create_image_path()); 
                $directory = Storage::disk('public_path')->putFile($this->create_image_path(), $file);

                $insertFileIntoDB = $this->create_media_info([
                    'media_name' => $filename,
                    'media_path' => $directory,
                ]);
 
                // if($insertFileIntoDB) {
                //     return Storage::disk('public_path')->putFile($this->create_image_path(), $file);
                // } 
            }

            Session::flash('success', count($request->images) . ' image(s) success addedd.');
            return back();

        } else {

            Session::flash('failed','Invalid Type of Images');
            return back();

        }

    }

    public function update_image_content($method, $id = null, $request)
    {

        if($request->input('submit') == 'update') {

            (new SystemMedia)
            ->where('media_id', decrypt($request->input('media_id')))
            ->update([
                'media_name'         => $request->input('media_name'),
                'media_description'  => $request->input('media_description'),
                'media_alt_name'     => $request->input('media_alt_name'),
                'media_tags'         => $request->input('media_tags'),
                'media_updated_by'   => $this->thisUser()->users_id,
                'media_updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
            ]);

            return response()->json([
                'message' => 'Image Details successfully updated.',
                'action' => 'update',
            ]);

        } else if($request->input('submit') == 'delete') {

            $SystemMedia = (new SystemMedia)->where('media_id', decrypt($request->input('media_id')));

            if($SystemMedia->count() > 0) {

                if($SystemMedia->first()['media_status'] == 'used') {

                    return response()->json([
                        'message' => 'Cannot delete already used image.',
                        'action' => 'invalid',
                    ]);

                } else {

                    if($SystemMedia->delete()) {

                        Storage::disk('public')->delete($request->input('media_image_path'));

                        return response()->json([
                            'message' => 'Selected Image successfully deleted.',
                            'action' => 'delete',
                        ]);

                    }

                }

            }

        }

    }

    public function get_uploaded_image($method, $id = null, $request)
    {
        $images = SystemMedia::orderBy('media_id','desc')->get();

        return $this->myViewMethodLoader($method)->with('images', $images);
    }

    protected function create_image_path()
    {
        $dateTimeToday = (new CommonService);

        return 'uploads/images/' . $dateTimeToday->dateTimeToday('Y') . '/' . $dateTimeToday->dateTimeToday('m');
    }

    protected function create_media_info($collect = [])
    {
        return SystemMedia::insert([
            'media_name' => $collect['media_name'],
            'media_path' => $collect['media_path'],
            'media_date_added' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ]);
    }

    public function fileName()
    {
        return str_random(25);
    }

    public function my_file_checker($request)
    {
        $this->validate($request, [
            'images' => 'mimes:'.$this->validatefile('image'),
            'files'  => 'mimes:'.$this->validatefile('document'),
        ]);
    }

    public function validatefile($type)
    {
        $getarray = app('SystemMediaExtension')->where('extension_type', $type)->where('status', '1')->get();

        return implode(",", array_pluck($getarray, 'extension_name'));
    }
    
}
