<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('imageUpload')) {
    function imageUpload($request, $attribute = null, $imgPath = null, $oldImgPath = null): ?string
    {
        // dd($request);
        $path = $oldImgPath ?? null;
        if ($request->hasFile($attribute)) {
            if ($oldImgPath) {
                Storage::delete($oldImgPath);
            }
            if ($attribute && $imgPath) {
                $path = $request->file($attribute)->store($imgPath);
            }
        }

        return $path;
    }
}

if (!function_exists('generate_url')) {
    function generate_url(?string $path = null, $fallback_url = null, string $disk = 'public'): string
    {
        return (!empty($path) && Storage::disk($disk)->exists($path))
            ? Storage::url($path)
            : $fallback_url ?? null;
    }
}
