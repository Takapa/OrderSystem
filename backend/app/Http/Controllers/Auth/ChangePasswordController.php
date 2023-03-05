<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ChangePasswordController extends Controller
{
    //
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'new_password' => 'required|string|min:6|confirmed',
        ]);
    }
   
    public function edit($id)
    {
     $user = $this->user->findOrFail($id);
      return view('auth.passwords.edit')
              ->with('user', $user);
    }
   
    public function update(Request $request, $id)
  {
    $user = $this->user->findOrFail($id);
    // 現在のパスワードを確認
    if (!password_verify($request->current_password, $user->password)) {
      return redirect()->back()
              ->with('warning', 'パスワードが違います');
    }
    // Validation（8文字以上あるか，2つが一致しているかなどのチェック）
    $this->validator($request->all())->validate();
    // パスワードを保存
    $user->password = bcrypt($request->new_password);
    $user->save();
    return redirect()->back()
            ->with('status', 'パスワードを変更しました');
  }

}
