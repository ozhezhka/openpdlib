<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$users = User::where('id','>','0')->orderBy('created_at', 'desc')->get();
	return view('admin.users.users')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$list = array();
	$conf_list = Config::get('auth.user_status_list');
	foreach ($conf_list as $item) $list[$item] = trans('user.'.$item);
	return view('admin.users.create')->with('user_status_list',$list);
    }


    protected function validatorCreate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
	    'password' => 'required|string|min:6|confirmed',
	    'status' => 'required|in:user,admin',
        ]);
    }


    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'confirmed',
	    'status' => 'required|in:user,admin',
        ]);
    }

    protected function validatorFind(array $data)
    { 
        return Validator::make($data, [
	    'id' => 'integer|nullable',
            'email' => 'email|max:255|nullable',
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	$data=$request->all();
	$this->validatorCreate($data)->validate();

	$data['password']=bcrypt($data['password']);
	$user=User::create($data);
	$user->password=$data['password'];
        $user->save();
	
        return redirect('/admin/user/'.($user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	$id=intval($id);
	if ($id==0) return redirect('/admin');
	$user = User::findOrFail($id);
	return view('admin.users.user')->with('user', $user);
    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postFind(Request $request)
    {
	$data=$request->all();
        $this->validatorFind($data)->validate();

	if (isset($data['id'])&&$data['id']>0) {
		$user = User::find(intval($data['id']));
		if ($user==null) return view('admin.index')->withMessage(trans('admin.no_id'));
		if (isset($data['email'])&&$data['email']!=''&&$data['email']!=$user->email)
			  return 
view('admin.index')->withMessage(trans('admin.id_email_mismatch',['id'=>$data['id']]));
		return view('admin.users.user')->with('user', $user);
		} 
	else if (isset($data['email'])&&$data['email']!='') {
		$user = User::where('email', '=', $data['email'])->first();
		if ($user==null) return view('admin.index')->withMessage(trans('admin.no_email'));
		return view('admin.users.user')->with('user', $user);
		}
	return view('admin.index');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$id=intval($id);
	if ($id==0) return redirect('/admin/user/');
        $list = array();
        $conf_list = Config::get('auth.user_status_list');
        foreach ($conf_list as $item) $list[$item] = trans('user.'.$item);
	$user = User::findOrFail($id);
        return view('admin.users.update')->with(array('user_status_list'=>$list,'user'=>$user));
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

	$id = intval($id);
	if ($id==0) return redirect('/admin/user/');

        $data=$request->all();
        $this->validatorUpdate($data)->validate();

        $user=User::findOrFail($id);
	$user->fill($data);
	if (isset($data['password'])) {
		if (trim($data['password'])>"")
		$user->password=bcrypt($data['password']);
		}

        $user->save();

        return redirect('/admin/user/'.($user->id));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=intval($id);
        if ($id==0) return redirect('/admin/user/');
        $user = User::findOrFail($id);
	$user->delete();
        return redirect('/admin/user/');

    }
}
