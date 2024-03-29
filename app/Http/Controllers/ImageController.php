<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageController extends Controller
{
    public function __invoke(Request $request, string $size, string $file): BinaryFileResponse
    {
        abort_unless(in_array($size, config('imageresizer.sizes')), 400, 'The requested size is not whitelisted.');

        $resizedPath = 'resizes/'.$size.'/'.$file;

        if (! Storage::exists('public/'.$resizedPath)) {
            $image = Image::load(storage_path('app/public/'.$file))->optimize();
            @list($width, $height) = explode('x', $size);

            if ($height) {
                $image->fit(MANIPULATIONS::FIT_CONTAIN, (int) $width, (int) $height);
            } else {
                $image->width((int) $width);
            }

            if (! is_dir(storage_path('app/public/'.pathinfo($resizedPath, PATHINFO_DIRNAME)))) {
                mkdir(storage_path('app/public/'.pathinfo($resizedPath, PATHINFO_DIRNAME)), 0755, true);
            }

            $image->save(storage_path('app/public/'.$resizedPath));
        }

        return response()->file(storage_path('app/public/'.$resizedPath));
    }
}
