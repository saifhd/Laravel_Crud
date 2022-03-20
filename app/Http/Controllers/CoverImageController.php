<?php

namespace App\Http\Controllers;

use App\Models\CoverImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoverImageController extends Controller
{

    public function destroyCoverImage($id)
    {
        $cover_image = CoverImage::findOrFail($id);
        Storage::disk('public')->delete($cover_image->image_path);
        $cover_image->delete();

        return redirect()->back()->with('success','Cover Image Deleted');
    }
}
