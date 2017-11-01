<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    /**
     * Crop and resize image avatar
     *
     * @param  int  $id
     */
    public function user_avatar($id, $size)
    {
        $user = User::findOrFail($id);
        $avatar_path = asset('storage/users/' . $id . '/avatars/' . $user->avatar);
        $image = Image::make($avatar_path)->fit($size)->response('jpg', 90);

        return $image;
    }

}
