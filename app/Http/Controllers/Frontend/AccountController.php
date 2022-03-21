<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $members = User::findOrFail($userId);

        return view('frontend.account.account', compact('members'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $member = User::findOrFail($userId);

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
            $data['password'] = $member->password;
        }

        if($member->update($data))
        {
            if(!empty($file)){
                $file->move('upload/image', $file->getClientOriginalName());
            }
            // if(File::exists(public_path($thumbnailOld))){
            //     File::delete(public_path($thumbnailOld));
            // }
            $member->update([
                $member->name = $data['name'],
                $member->email = $data['email'],
                $member->password = $data['password'],
                $member->phone = $data['phone'],
                $member->address = $data['address'],
                $member->avatar = $data['avatar']
            ]);

            return redirect()->back()->with('success', __('Update profile success'));
        }else{
            return redirect()->back()->withErrors('Update profile error');
        }
    }
}
