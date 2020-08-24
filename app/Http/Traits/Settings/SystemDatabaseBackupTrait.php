<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemDatabaseBackupTrait
{
	public function toIndex()
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        
        foreach ($files as $k => $f) {
           
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $this->humanFilesize($disk->size($f)),
                    'last_modified' => $this->getDate($disk->lastModified($f)),
                ];
            }
        }
       
        $backups = array_reverse($backups);
        $backup_count = count($backups);
        return view('firm.app_manager.'.$this->fileIndex)
             ->with(compact(['backups','backup_count']));
    } 

    public function toBackup()
    {
        try {
            Artisan::call('backup:run', ['--only-db' => true]);
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }

        Session::flash('success', ' Database successfully buckuped.');
        return redirect()->back();  
    }

    public function toDownload($id)
    {
        $file = config('laravel-backup.backup.name') . '/' . $id;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        if ($disk->exists($file)) {

            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);

        } else {

            abort(404, "The backup file doesn't exist.");
        }
    }

    public function toDelete(Request $request)
    {
        $id = $request->input('del_id');
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $id)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $id);
            Session::flash('success', ' Database Backup successfully deleted.');
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
  
    public function getDate($date_modify){

        return Carbon::createFromTimeStamp($date_modify)->formatLocalized('%d %B %Y %H:%M');
    }

    public function humanFilesize($size, $precision = 2) {

        $units = array(' B',' KB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
    
        return round($size, $precision).$units[$i];
    }
}