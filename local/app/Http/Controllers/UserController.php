<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\RowClient;
use App\ContactClient;
use DB;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Theme;
class UserController extends Controller
{
    public function __construct()
    {
       //  $this->middleware(['auth', 'isAdmin'])->except(['samples']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //userProfile
     public function userProfile(){
       $theme = Theme::uses('corex')->layout('layout');
       $users = User::orderby('id', 'desc')->get();

       $data = ['users' =>$users];
       return $theme->scope('users.profile', $data)->render();
     }
     //userProfile


     //getCountry
      public function getCountry(Request $request,$id){

          $getAttr = DB::table('country_cities')->select('country_id')->where('id', $id)->first();
          $getAttrC = DB::table('countries')->where('id', $getAttr->country_id)->first();
          $data = array('id' => $getAttrC->id,'name' => $getAttrC->name );
          return response()->json($data);
      }
     //getCountry
     public function getCity(Request $request){
       $q=$request->q;


      $getAttr = DB::table('country_cities')->select('id', 'name')->where('name', 'like', "$q%")->get();
       header('Content-Type: application/json');
       header('Access-Control-Allow-Origin: *');
       header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
       header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
       $data = array(
         'total_count' =>1222 ,
         'incomplete_results' =>1222,
         'items' =>$getAttr,
       );
       return response()->json($data);
     }
     public function setContactClient(Request $request){
       $contactClient = new ContactClient;
       $contactClient->name = $request->name;
       $contactClient->email = $request->email;
       $contactClient->phone = $request->phone;
       $contactClient->parent_userid = $request->recordID;
       $contactClient->addedby = $request->added_by;
       $contactClient->created_at = date('Y-m-d H:i:s');
       $contactClient->save();
       $res_arr = array(
         'status' => 1,
         'Message' => 'Data saved successfully.',
       );
       return response()->json($res_arr);

     }

     public function saveRowClient(Request $request){
        $rowClient = new RowClient;
        $rowClient->name = $request->name;
        $rowClient->email = $request->email;
        $rowClient->phone = $request->phone;
        $rowClient->company = $request->company;
        $rowClient->remarks = $request->remarks;
        $rowClient->brand_name = $request->brand_name;
        $rowClient->gst = $request->gst;
        $rowClient->address = $request->address;
        $rowClient->save();
        $res_arr = array(
          'status' => 1,
          'Message' => 'Data saved successfully.',
        );
        return response()->json($res_arr);
     }
     // save row client

     public function rowClientList(){
       $theme = Theme::uses('admin')->layout('layout');
       $users = User::orderby('id', 'desc')->get();
       $users_staff = User::role('Staff')->get();
       $data = ['users' =>$users,'users_staff'=>$users_staff];
       return $theme->scope('users.row_client_list', $data)->render();
     }
     public function add_ajax_clients(Request $request){
       $this->validate($request, [
           'name'=>'required|max:120',
           'email'=>'required|email|unique:users',
           'password'=>'required|min:6|confirmed'
       ]);
      $user = User::create($request->only('email', 'name', 'password'));
      $role_r = 'Client';
      $user->assignRole($role_r);
      $insertedId = $user->id;
       $comp_obj = new Company;
       $comp_obj->user_id = $insertedId;
       $comp_obj->company_name = $request->compname;
       $comp_obj->user_role = 'RootClient';
       $comp_obj->brand_name = $request->brand_name;
       $comp_obj->gst_details = $request->gst_details;
       $comp_obj->address = $request->address;
       $comp_obj->sale_agent_id = $request->sale_agent;
       $comp_obj->remarks = $request->remarks;
       $comp_obj->save();
       $res_arr = array(
         'status' => 1,
         'Message' => 'Data saved successfully.',
       );
       return response()->json($res_arr);


     }

     public function clinetListforDelete(){
       $theme = Theme::uses('admin')->layout('layout');
       $users = User::orderby('id', 'desc')->get();
       $users_staff = User::role('Staff')->get();
       $data = ['users' =>$users,'users_staff'=>$users_staff];
       return $theme->scope('users.view_clientsfordelte', $data)->render();
     }
     public function clinetList(){
       $theme = Theme::uses('admin')->layout('layout');
       $users = User::orderby('id', 'desc')->get();
       $users_staff = User::role('Staff')->get();
       $data = ['users' =>$users,'users_staff'=>$users_staff];
       return $theme->scope('users.view_clients', $data)->render();
     }
     public function sampleList(){
       $theme = Theme::uses('admin')->layout('layout');
       $users = User::orderby('id', 'desc')->get();
       $data = ['users' =>$users];
       return $theme->scope('users.view_samples', $data)->render();
     }


    public function index()
    {
        $users = User::all();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password'));

        $roles = $request['roles'];

        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();
            $user->assignRole($role_r);
            }
        }

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);

        $input = $request->only(['name', 'email', 'password']);
        $roles = $request['roles'];
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }
        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }
}
