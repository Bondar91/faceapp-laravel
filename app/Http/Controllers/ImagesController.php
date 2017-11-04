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

        if (is_null($user->avatar))
        {
            $image = Image::make('https://cdn0.iconfinder.com/data/icons/user-pictures/100/unknown2-512.png')->fit($size)->response('jpg', 90);
        }
        elseif (strpos($user->avatar, 'http') !== false)
        {
            $image = Image::make($user->avatar)->fit($size)->response('jpg', 90);
        }
        else
        {
            $avatar_path = asset('storage/users/' . $id . '/avatars/' . $user->avatar);
            $image = Image::make($avatar_path)->fit($size)->response('jpg', 90);
        }


        return $image;
    }

}
