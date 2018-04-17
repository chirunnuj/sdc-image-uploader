<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Users;

class UserController extends Controller
{
    
    public function __construct() 
    {
    	$this->middleware('auth');
    }

    public function list() {
        //$users = DB::select('select * from users');
        $users = $this->fetchUsers();
    	return view('users.list', ['users'=>$users]);
    }

    public function add(Request $request) {
       

        $user = $this->createUser($request);    // Convert user from the form to User object
        if(isset($user) && !empty($user)) {
            $validatedData = $request->validate([
            'name'  =>  'required|max:255',
            'email' =>  'required|email',
            'pwd'  =>  'required',
            ]);
        }

        //$name = $request->name;
        //$email = $request->email;
        //$pwd = $request->pwd;
        //$role = $request->role;

        DB::table('users')->insert(
            ['name'=>$user->name, 
            'email'=>$user->email, 
            'password'=>bcrypt($user->pwd), 
            'role'=>$user->role,
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]
        );

        $users = $this->fetchUsers();
        return view('users.list', ['users'=>$users]);
    }

    public function edit($id) 
    {

        if(isset($id) && !empty($id)) {
            $userId = $id;
            $user = $this->fetchUsers($userId);
        } 
        
       
        $allUsers = $this->fetchUsers();
        return view('users.list', ['users'=>$allUsers, 'userEdit'=>$user[0]]);
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            'name'  =>  'required|max:255',
            'email' =>  'required|email',
            'pwd'  =>  'required',
        ]);

        $user = $this->createUser($request);    // Convert user from the form to User object

        // Update the selected user
        if(isset($user) && !empty($user)) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['name'=> $user->name, 'email'=>$user->email, 'role'=>$user->role]);

            //DB::update('update users set name = ?, email = ?, role = ? where id = ?', 
            //[$user->name, $user->email, $user->role, $user->id]);
        }
        

        $users = $this->fetchUsers();           // Retrieve all users for the listing
        $userEdit = $this->createUser();        // Create an empty user to fill the User Detail form
        $userEdit->id = $request->id;
        return view('users.list', ['users'=>$users, 'userEdit'=>$userEdit]);
    }

    public function delete($id) 
    {
    	$userId = $id;

        $deleted = DB::delete('delete from users where id = ?', [$userId]);
        //DB::table('users')->findOrFail($userId)->delete();

        $users = $this->fetchUsers();
        return view('users.list', ['users'=>$users]);
    }




    function fetchUsers($id = 0) 
    {
        if($id > 0) {
            return DB::select('select * from users where id = ?', [$id]);
        } else {
            return DB::select('select * from users');
        }
    }

    function createUser($data = null) {

        $user = new Users();

        if(isset($data) && !empty($data)) {
            $user->id = $this->checkInt($data->id);
            $user->name = $this->checkString($data->name);
            $user->email = $this->checkString($data->email);
            $user->password =$this->checkString($data->password);
            $user->role = $this->checkString($data->role);
        } else {
            $user->id = 0;
            $user->name = "";
            $user->email = "";;
            $user->password ="";
            $user->role = "staff";
        }

        return $user;
    }

    function checkInt($data) {
        if(isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
    }

    function checkString($data) {
        if(isset($data) && !empty($data)) {
            return $data;
        } else {
            return "";
        }
    }
 
}
