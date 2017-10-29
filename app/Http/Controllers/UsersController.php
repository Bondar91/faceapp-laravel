<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (intval($id) !== Auth::id())
        {
            abort(403, 'Brak dostępu!');
        }

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
        if (intval($id) !== Auth::id())
        {
            abort(403, 'Brak dostępu!');
        }

        //Pierwszy sposob najczesciej uzywany , pobranie z modelu User
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
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

        return back();
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
