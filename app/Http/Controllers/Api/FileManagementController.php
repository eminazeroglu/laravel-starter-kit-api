<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\System\UploadService;
use Illuminate\Http\Request;

class FileManagementController extends Controller
{
    protected UploadService $uploadService;

    public function __construct()
    {
        $this->uploadService = new UploadService();
    }

    /*
     * Photo Upload
     * */
    public function photoUpload(Request $request)
    {
        return $this->uploadService->setPhoto($request);
    }

    /*
     * Photo Remove
     * */
    public function photoRemove(Request $request)
    {
        return $this->uploadService->photo_remove($request);
    }

    /*
     * Photo Remove All
     * */
    public function photoRemoveAll(Request $request)
    {
        return $this->uploadService->photo_remove_all($request);
    }

    /*
     * Editor Photo Upload
     * */
    public function editorPhotoUpload(Request $request)
    {
        return $this->uploadService->setEditorPhoto($request);
    }
}
