<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_permission', ['except' =>['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
//        $posts = $user->posts()->paginate(10);
        if(is_admin())
        {
            $posts = Post::with('comments.user')
                ->with('comments.likes')
                ->with('likes')
                ->where('user_id', $id)
                ->withTrashed()
                ->paginate(10);
        }
        else
        {
            $posts = Post::with('comments.user')
                ->with('comments.likes')
                ->with('likes')
                ->where('user_id', $id)
                ->paginate(10);
        }

        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ],
        ],[
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi posiadać minimum :min',
            'email' => 'Podaj poprawny adres email',
            'unique' => 'Podany adres email jest już używany'
        ]);

        //Pierwszy sposob najczesciej uzywany , pobranie z modelu User
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;

        if ($request->file('avatar'))
        {
            $avatar_path = 'public/users/' . $id . '/avatars';
            $upload_path = $request->file('avatar')->store($avatar_path);
            $avatar_filename = str_replace($avatar_path . '/','', $upload_path);
            $user->avatar = $avatar_filename;
        }

        $user->save();

//        Drugi sposób z uzyciem where i update działą
//        User::where('id', $id)->update([
//            'name' => $request->name,
//            'email' => $request->email,
//            'sex' => $request->sex,
//        ]);

//        Trzeci sposób tutaj używamy metody find i jeżeli w modelu nie podamy pól to wtedy nie zadziałą
//        User::find($id)->update([
//            'name' => $request->name,
//            'email' => $request->email,
//            'sex' => $request->sex,
//        ]);

        return back()->with('alert-success', 'Użytkownik edytowany poprawnie!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
