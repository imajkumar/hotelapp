<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Client;
use App\ClientNote;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Theme;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Helpers\AyraHelp;
//include 'class-list-util.php';
class ClientController extends Controller
{

  public function __construct()
  {
      $this->middleware(['auth']);

  }


    public function index(){
      $theme = Theme::uses('corex')->layout('layout');
      $data = [
        'users' =>'',
      ];
      return $theme->scope('client.index', $data)->render();
    }
    /*
    |--------------------------------------------------------------------------
    | function name:getClient_notes
    |--------------------------------------------------------------------------
    | This function is used to get clients notes
    */
      public function getClient_notes_view(Request $request){
        $theme = Theme::uses('corex')->layout('layout');
        $data = ['info' => 'Hello World'];
        return $theme->scope('client.notes', $data)->render();

      }

      public function getClientsNotesList(Request $request){

          $client_arr=Client::where('is_deleted','!=',1)->get();
          $client_arr=ClientNote::get();

          foreach ($client_arr as $key => $value) {

            $client_id=$value->clinet_id;
            $user_arr=AyraHelp::getClientbyid($client_id);
            $sales_name=AyraHelp::getUserName($value->user_id);
            $created_on=date('j M Y', strtotime($value->created_at));



            $data_arr[]=array(
              'RecordID' =>$value->id,
              'client_name' =>isset($user_arr->firstname) ? $user_arr->firstname : '',
              'client_company' =>isset($user_arr->company) ? $user_arr->company : '',
              'message' => isset($value->message) ? $value->message : '',
              'created_by' =>$sales_name,
              'created_on' =>$created_on,
              'Status' => $value->is_read,
              );
          }

              $JSON_Data =json_encode($data_arr);
              $columnsDefault = [
                'RecordID'     => true,
                'client_name'      => true,
                'client_company'      => true,
                'message'      => true,
                'created_by'      => true,
                'created_on'     => true,
                'Status'     => true,
                'Actions'      => true,
              ];

              $this->DataGridResponse($JSON_Data,$columnsDefault);
      }




    /*
    |--------------------------------------------------------------------------
    | function name:getClientsList
    |--------------------------------------------------------------------------
    | Used to get list of all client as permissions
    */
    public function getClientData(Request $request){
    $user_id=Auth::user()->id;
    $edit_client_permission=0;
    $delete_client_permission=0;
    $user = auth()->user();
    if($user->hasAnyPermission(['View-Client-List'])){
      $userRoles = $user->getRoleNames();
      $user_role = $userRoles[0];
          if($user->hasAnyPermission(['Edit-Client-Data'])){
            $edit_client_permission=1;
          }
          if($user->hasAnyPermission(['Delete-Client-Data'])){
            $delete_client_permission=1;
          }
        //start of admin permissions
      if($user_role=='Admin'){


            //$users_arr = Users::where('is_deleted','!=',1)->orderBy('id', 'desc')->get();
            $users_arr=User::whereHas("roles", function($q){ $q->where("name", "Client"); })->get();


            $data_arr = array();
            $i=0;
            foreach ($users_arr as $key => $value) {
              $i++;
              $created_by=AyraHelp::getUserName(1);




              $data_arr[]=array(
                'RecordID' => $value->id,
                'name' =>$value->name,
                'email' => $value->email,
                'phone' =>$value->phone,
                'created_on' => date('j M Y', strtotime($value->created_at)),
                'created_by' => $created_by,
                'Status' => $value->status

                );
          }
      }

      //end of admin permissions
      if($user_role=='SalesUser'){
            $users_arr = Client::where('is_deleted','!=',1)->where('added_by',$user_id)->orderBy('id', 'desc')->get();
            $data_arr = array();
            $i=0;
            foreach ($users_arr as $key => $value) {
              $i++;
              $created_by=AyraHelp::getUserName($value->added_by);
              $city=AyraHelp::getCityByID(3948)->name;
              $country=AyraHelp::getCountryByID(1)->iso_code_3;

              $location=$value->location;
              $comp=$value->company."( ".$value->brand." )";

              $data_arr[]=array(
                'RecordID' => $value->id,
                'rowid' => $value->id,
                'company' =>$comp,
                'brand' => $value->brand,
                'location' => $location,
                'name' => $value->firstname,
                'phone' => $value->phone,
                'email' =>$value->email,
                'created_on' => date('j M Y', strtotime($value->created_at)),
                'created_by' => $created_by,
                'status' => $value->status,
                'Status' => $value->group_status,
                'edit_p' => $edit_client_permission,
                'delete_p' => $delete_client_permission,
                );
          }
      }
      //end of sales

      $JSON_Data =json_encode($data_arr);
      $columnsDefault = [
        'RecordID'     => true,
        'name'      => true,
        'email'      => true,
        'phone'      => true,
        'created_on' => true,
        'created_by' => true,
        'status' =>true,
        'Actions'      => true,
      ];

      $this->DataGridResponse($JSON_Data,$columnsDefault);

    }else{
      echo "Permission denied :L-38-Clinet";
    }

    }



    /*
    |--------------------------------------------------------------------------
    | function name:store
    |--------------------------------------------------------------------------
    | this is used to save client information to database
    */
    public function store(Request $request) //v2
    {

     $user=User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => $request->password,
      ]);
      $user->assignRole('Client');

    }


public function softdeleteClient(Request $request){ //v2
  $user = auth()->user();
  if($user->hasAnyPermission(['Delete-Client-Data'])){
    $userid=$request->userId;
    Client::where('id', $userid)
          ->update(['is_deleted' => 1]);
    $data = array(
      'status' => '1',
      'message' => 'Sent for Deleted Deleted successfully',
     );

  }else{
    $data = array(
      'status' => '1',
      'message' => 'Sent for Deleted Deleted successfully',
     );
  }
return response()->json($data);
}

public function getClientDetails(Request $request){ //v2

  $client_arr=Client::where('id', $request->recordID)->first();

  $client_data = array(
    'name' =>isset($client_arr->firstname) ? $client_arr->firstname : '',
    'user_id' =>isset($client_arr->user_id) ? $client_arr->user_id : '',
    'id' =>isset($client_arr->id) ? $client_arr->id : '',
    'email' =>isset($client_arr->email) ? $client_arr->email : '',
    'phone' =>isset($client_arr->phone) ? $client_arr->phone : '',
    'company' =>isset($client_arr->company) ? $client_arr->company : '',
    'address' =>isset($client_arr->address) ? $client_arr->address : '',
    'gst' =>isset($client_arr->gstno) ? $client_arr->gstno : '',
    'brand' =>isset($client_arr->brand) ? $client_arr->brand : '',
    'remarks' =>isset($client_arr->remarks) ? $client_arr->remarks : '',
    'added_by' =>isset($client_arr->added_by) ?$client_arr->added_by : '',
    'city' =>isset($client_arr->city) ?$client_arr->city : '',
    'country' =>isset($client_arr->country) ?$client_arr->country : '',
  );
   return response()->json($client_data);
}

public function edit_client(Request $request){ //

$rowid=$request->rowid;
$gstI= $request->gst;

  User::where('id', $rowid)
          ->update([
            'firstname' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'brand' =>  $request->brand,
            'gstno' => $gstI,
            'address' => $request->address,
            'remarks' =>$request->remarks
          ]);
  $res_arr = array(
    'status' => 1,
    'Message' => 'Client Edit  successfully.',
  );
  return response()->json($res_arr);

}
/*
|--------------------------------------------------------------------------
| function name:create
|--------------------------------------------------------------------------
| this is used to create client
*/

    public function create()
    {
      $theme = Theme::uses('corex')->layout('layout');
      $data = ['info' => 'Hello World'];
      return $theme->scope('client.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     protected function validator(array $data)
     {
         return Validator::make($data, [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:6', 'confirmed'],
         ]);
     }
     protected function validator_without_email(array $data)
     {
         return Validator::make($data, [
             'name' => ['required', 'string', 'max:255'],
             'password' => ['required', 'string', 'min:6', 'confirmed'],
         ]);
     }

     public function store_(Request $request)
     {
       if($request->email==""){
          $no_email='NoEmail_'.date('ymdHis').'@boitel.xyzz';
          $request->merge(['email' => $no_email]);
          $user = User::create($request->only('email', 'name', 'password','created_by','phone'));
          $user->assignRole('Client');
          $insertedId = $user->id;
           $comp_obj = new Company;
           $comp_obj->user_id = $insertedId;
           $comp_obj->company_name = $request->company;
           $comp_obj->user_role = 'RootClient';
           $comp_obj->brand_name = $request->brnad_name;
           $comp_obj->gst_details = $request->gst;
           $comp_obj->address = $request->address;
           $comp_obj->sale_agent_id = $request->created_by;
           $comp_obj->remarks = $request->remarks;
           $comp_obj->save();

       }else{
         $this->validate($request, [
              'name'=>'required|max:120',
              'phone'=>'required|max:120',
              'email'=>'required|email|unique:users'

          ]);
          $user = User::create($request->only('email', 'name', 'password','created_by','phone'));

          $user->assignRole('Client');

          $insertedId = $user->id;
           $comp_obj = new Company;
           $comp_obj->user_id = $insertedId;
           $comp_obj->company_name = $request->company;
           $comp_obj->user_role = 'RootClient';
           $comp_obj->brand_name = $request->brnad_name;
           $comp_obj->gst_details = $request->gst;
           $comp_obj->address = $request->address;
           $comp_obj->sale_agent_id = $request->created_by;
           $comp_obj->remarks = $request->remarks;
           $comp_obj->save();
       }
          $res_arr = array(
            'status' => 1,
            'Message' => 'Data saved successfully.',
          );
          return response()->json($res_arr);
     }

     /*
     |--------------------------------------------------------------------------
     | function name:show
     |--------------------------------------------------------------------------
     | this is used to view client information
     */
    public function show($id)
    {

        $theme = Theme::uses('corex')->layout('layout');
        $client_data=Client::where('id',$id)->first();

        $user = auth()->user();
        if($user->hasAnyPermission(['view-all-notes'])){
          $client_notes=ClientNote::where('clinet_id',$id)->orderBy('id', 'desc')->get();
        }else{
          $client_notes=ClientNote::where('clinet_id',$id)->where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        }

        $data = ['client_data' => $client_data,'client_notes' => $client_notes];
        return $theme->scope('client.view', $data)->render();

    }
    /*
    |--------------------------------------------------------------------------
    | function name:add_Note
    |--------------------------------------------------------------------------
    | this is used to add client notes
    */
    public function add_Note(Request $request){
      $clienNote=new ClientNote;
      $clienNote->clinet_id = $request->user_id;
      $clienNote->user_id = Auth::user()->id;
      $clienNote->message = $request->message;
      $clienNote->save();
      $res_arr = array(
        'status' => 1,
        'Message' => 'Note saved successfully.',
      );
      return response()->json($res_arr);

    }
    /*
    |--------------------------------------------------------------------------
    | function name:deleteNote
    |--------------------------------------------------------------------------
    | this is used to delete client notes
    */
    public function deleteClientUser(Request $request){

      $notes = User::find($request->rowid);
      $notes->delete();
      $res_arr = array(
        'status' => 1,
        'Message' => 'Note deleted successfully.',
      );
      return response()->json($res_arr);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $theme = Theme::uses('corex')->layout('layout');
      $client_data=User::where('id',$id)->first();
      $data = ['data' => $client_data];
      return $theme->scope('client.edit', $data)->render();

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

      User::where('id', $id)
              ->update([
                'name' => $request->name,
                'email' => $request->email,
                //'password' =>bcrypt($request->password),
                'status' => $request->status,
                'phone' =>  $request->phone

              ]);
      $res_arr = array(
        'status' => 1,
        'Message' => 'Client Edit  successfully.',
      );
      return response()->json($res_arr);

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
