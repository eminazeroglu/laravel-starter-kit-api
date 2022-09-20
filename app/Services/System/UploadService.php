<?php

namespace App\Services\System;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    protected $imageService;

    public function __construct()
    {
        $this->imageService = new ImageUploadService();
    }

    /*
     * Set Photo
     * */
    public function setPhoto($request)
    {
        $file      = $request->url;
        $name      = $request->file_name;
        $path      = $request->path ?? 'default';
        $degree    = $request->degree ?? 0;
        $thumbnail = $request->thumbnail;
        $folder    = date('d-m-Y');

        $image = $this->imageService
            ->setFile($file)
            ->setBase64(true)
            ->setThumbnail($thumbnail['width'] ?? 200, $thumbnail['height'] ?? 200)
            ->setPath($path . '/' . $folder)
            ->setRotate($degree)
            ->setRemoveFile($name ?? null)
            ->upload();
        if ($image):
            return response()->json(helper()->multiplePhoto($folder . '/' .$image, $path));
        endif;
        return response()->json('Server Error', 500);
    }

    /*
     * Set Editor Photo
     * */
    public function setEditorPhoto($request)
    {
        $image = $this->imageService
            ->setFile($request->file('file'))
            ->setPath('editor')
            ->upload();
        if ($image):
            $imageName = $this->imageService->getPhoto('editor', $image);
            return response()->json([
                'location' => $imageName['original']
            ]);
        endif;
        return response()->json('Server Error', 500);
    }

    /*
     * Photo Remove
     * */
    public function photo_remove($request)
    {
        $validator = validator()->make($request->all(), [
            'hash' => 'required'
        ]);
        if ($validator->fails()):
            return response()->json($validator->errors(), 422);
        endif;
        $hash = json_decode(helper()->deCrypto($request->input('hash')), true);
        $path = $hash['path'] ?? null;
        $name = $hash['name'] ?? null;
        if ($path && $name):
            $delete = $this->imageService->delete($path, $name);
            if ($delete):
                return response()->json('Success');
            endif;
        endif;
        return response()->json('Server Error', 500);
    }

    /*
     * Photo Remove All
     * */
    public function photo_remove_all($request)
    {
        $hash = $request->input('hash');
        if (count($hash) > 0):
            foreach ($hash as $item):
                $decode = json_decode(helper()->deCrypto($item), true);
                $path   = @$decode['path'];
                $name   = @$decode['name'];
                if ($path && $name):
                    $this->imageService->delete($path, $name);
                endif;
            endforeach;
        endif;
        return response()->json('Success');
    }
}
