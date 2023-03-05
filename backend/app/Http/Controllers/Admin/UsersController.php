<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function index()
    {
        $all_users = User::withTrashed()->get();

        return view('admin.users.index')->with('all_users',$all_users);
    }

    public function deactivate($id){
        User::destroy($id);

        return redirect()->back();
    }

    public function activate($id){
        User::withTrashed()->FindOrfail($id)->restore();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|min:1|max:50',
            'email' => 'required|email|max:50|',[Rule::unique('users', 'email')->whereNull('email')]
        ]);

        $user           = $this->user->findOrFail($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->save();
        
        return redirect()->back();
    }

}

