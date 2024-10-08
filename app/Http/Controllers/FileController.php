<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getFile($filename) {
        $fileIsset = Storage::exists($filename);
        $fileAccess = Storage::visibility($filename);
        if(!Auth::check()) {
            return ResponseController::login_failed();
        }
        if($fileAccess != 'public') {
            return ResponseController::forbidden();
        }
        if(!$fileIsset) {
            return ResponseController::not_found();
        }
        return Storage::download($filename);
    }

    public function uploadFile() {
        $allowedTypes = [
            'doc',
            'pdf',
            'docx',
            'zip',
            'jpeg',
            'jpg',
            'png'
        ];
        $sizeLimit = 2097152;

        $files = Request::file('files');

        foreach($files as $file) {
            //...
            $fileExtAllowed = false;
            foreach ($allowedTypes as $type) {
                if ($type == $file->extension()) {
                    $fileExtAllowed = true;
                }
            }

            if (!$fileExtAllowed) {
                return ResponseController::validation_failed([
                    'message' => 'file extension not allowed'
                ]);
            }
        }
    }

    public function deleteFile() {
        //...
    }

    public function editFile() {
        //...
    }
}
