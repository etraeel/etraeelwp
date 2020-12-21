<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-users')->only(['index']);
        $this->middleware('can:create-user')->only(['create' , 'store']);
        $this->middleware('can:edit-user')->only(['edit' , 'update']);
        $this->middleware('can:delete-user')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users  = User::query();
        if($keyword = request('search')){
            $users->where('email' , 'LIKE',"%{$keyword}%")->orWhere('name' , 'LIKE',"%{$keyword}%")->orWhere('mobile' , 'LIKE',"%{$keyword}%");
        }
        $users = $users->latest()->paginate(8);
        return view('admin.users.all' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate( [

            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);


        $user = User::create($data);
        if ($request->has('verify')){
            $user->markEmailAsVerified();
        }
        if ($request->input('type' ) == 'stuff'){
            $user->forceFill([
                'type' => 'stuff'
            ])->save();
        }
        if ($request->input('type' ) == 'admin'){
            $user->forceFill([
                'type' => 'admin'
            ])->save();
        }


        alert()->success('کاربر با موفقیت ایجاد شد ');
        return redirect(route('admin.users.index'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return user
     */
    public function edit(User $user)
    {

        return view('admin.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate( [

            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if (! is_null($request->password)){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $data['password'] = $request->password;
        }


        $user->update($data);
        if($request->verify){
            $user->forceFill([
                'email_verified_at' => now(),
            ])->save();
        }else{
            $user->forceFill([
                'email_verified_at' => null,
            ])->save();
        }

        if ($request->input('type' ) == 'stuff'){
            $user->forceFill([
                'type' => 'stuff'
            ])->save();
        }
        if ($request->input('type' ) == 'admin'){
            $user->forceFill([
                'type' => 'admin'
            ])->save();
        }

        if ($request->input('type' ) == 'user'){
            $user->forceFill([
                'type' => 'user'
            ])->save();
        }
        alert()->success('کاربر با موفقیت ویرایش شد ');
        return redirect(route('admin.users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('کاربر با موفقیت حذف شد ');
        return back();
    }
}
