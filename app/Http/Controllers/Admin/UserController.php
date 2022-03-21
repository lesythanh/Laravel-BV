<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Country;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class UserController extends Controller
{
    public function profile()
    {
        $userId = Auth::id();

        $profiles = User::findOrFail($userId);
        $countrys = Country::all();

        return view('admin.user.page-profile', compact('profiles', 'countrys'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $file = $request->avatar;
        $data = $request->all();
        // $thumbnailOld = $user->avatar;
        if(!empty($file))
        {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if($data['password'])
        {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        if($user->update($data))
        {
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            // if(File::exists(public_path($thumbnailOld))){
            //     File::delete(public_path($thumbnailOld));
            // }
            $user->update([
                $user->name = $data['name'],
                $user->email = $data['email'],
                $user->password = $data['password'],
                $user->phone = $data['phone'],
                $user->address = $data['address'],
                $user->id_country = $data['id_country'],
                $user->avatar = $data['avatar']
            ]);

            return redirect()->back()->with('success', __('Update profile success'));
        }else{
            return redirect()->back()->withErrors('Update profile error');
        }
    }
}
