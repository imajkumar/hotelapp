<?php
//app/Helpers/AyraHelp.php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Sample;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
class AyraHelp {

public static function AyraCrypt($data){
 return $encrypted = Crypt::encryptString($data);
}
public static function AyraEnCrypt($data){
 return $decrypted = Crypt::decryptString($data);
}

public static function getLocation(){
  $users = DB::table("location_directory")->get();
  return $users;
}
public static function getLocationByID($id){
  $users = DB::table("location_directory")->where('id',$id)->first();
  return $users;
}
public static function getRooms(){
  $users = DB::table("rooms")->get();
  return $users;
}

public static function getHotes(){
  $user = auth()->user();
  $userRoles = $user->getRoleNames();
  $user_role = $userRoles[0];
  if($user_role=='Admin'){
    $users = DB::table("hotels")->get();
  }

  if($user_role=='Client'){
    $users = DB::table("hotels")->where('created_by',Auth::user()->id)->get();
  }


  return $users;
}
public static function getHotesByID($id){
  $users = DB::table("hotels")->where('id',$id)->first();
  return $users;
}


//get last 30 days sample list

public static function getSample30Days(){
  $users = DB::table("users")
                   ->select('*')
                    ->whereDate('created_at', '>', Carbon::now()->subDays(30))
                   ->get();
                     return $users;
}

    //this is used to get att_values
    public static function getUserName($user_id){
        $user_arr = DB::table('users')->where('id', $user_id)->get();
        return $user_arr[0]->name;
    }
    public static function getUser($user_id){
        $user_arr = DB::table('users')->where('id', $user_id)->first();
        return $user_arr;
    }
    public static function getClientSource(){
        $user_arr = DB::table('clients_source')->get();
        return $user_arr;
    }
    public static function getUserPrefix($user_id){
        $user_arr = DB::table('users')->where('id', $user_id)->get();
        return $user_arr[0]->user_prefix;
    }
    public static function getClientByadded($user_id){
      $user = auth()->user();
      $userRoles = $user->getRoleNames();
      $user_role = $userRoles[0];
      if($user_role=='Admin' || $user_role=='Staff'){
        $user_arr = DB::table('clients')->where('is_deleted','!=',1)->get();
      }else{
        $user_arr = DB::table('clients')->where('is_deleted','!=',1)->where('added_by', $user_id)->get();
      }

         return $user_arr;
    }
    public static function getClientbyid($user_id){
        $user_arr = DB::table('clients')->where('is_deleted','!=',1)->where('id', $user_id)->first();
         return $user_arr;
    }

    public static function getAttr(){
        $getAttr = DB::table('bo_attr')->get();
        return $getAttr;
    }
    public static function getCity(){
        $getAttr = DB::table('country_cities')->select('id', 'name')->get();
        return $getAttr;
    }
    public static function getCityByID($id){
        $getAttr = DB::table('country_cities')->select('id', 'name')->where('id',$id)->first();
        return $getAttr;
    }
    public static function getCountryByID($id){
        $getAttr = DB::table('countries')->select('id', 'iso_code_3')->where('id',$id)->first();
        return $getAttr;
    }


    //this is used to get name of user
    public static function getEmail($user_id) {
        $user = DB::table('users')->where('id', $user_id)->first();

        return (isset($user->email) ? $user->email : '');
    }
    public static function getCompany($user_id) {
        $companys = DB::table('client_company')->where('user_id', $user_id)->first();

        return $companys;
    }
    public static function getCourier() {
        $getCourier = DB::table('courier')->get();

        return $getCourier;
    }
    public static function getCouriers($id) {
      $getCourier = DB::table('courier')->where('id', $id)->first();

      return $getCourier;
    }
    public static function getCouriersBySamnpleid($id) {
      $samples = DB::table('samples')->where('id', $id)->first();

      $getCourier = DB::table('courier')->where('id', $samples->courier_details)->first();

      return $getCourier;


    }

    public static function getClientUsers() {
        $user = DB::table('users')->where('created_by', Auth::user()->id)->get();

        return $user;
    }


    public static function getSampleCount($userid) {
        $user = DB::table('samples')->where('status', '0')->where('created_by', $userid)->get()->toArray();

        return count($user);
    }
    public static function getSalesAgent() {
        $clients_arr = User::whereHas("roles", function($q){ $q->where("name", "SalesUser"); })->get();
        return $clients_arr;
    }
    public static function getAllClients() {
        $clients_arr = User::where('is_deleted','!=',1)->whereHas("roles", function($q){ $q->where("name", "Client"); })->get();
        return $clients_arr;
    }
    public static function getClientByAuth() {
        $clients_arr = User::where('created_by',Auth::user()->id)->where('is_deleted','!=',1)->whereHas("roles", function($q){ $q->where("name", "Client"); })->get();
        return $clients_arr;
    }
    public static function getSampleIDCode() {
      $max_id = Sample::max('sample_index')+1;
      //  echo $request->client_name;
      $uname= strtoupper(AyraHelp::getUserPrefix(Auth::user()->id));
      $uname = substr($uname, 0, 3);
      $num = $max_id;
      $str_length = 4;
      $sid_code = $uname."-".substr("0000{$num}", -$str_length);
      return $sid_code;
    }
    public static function getSamples($id) {
      $sample = DB::table('samples')->where('id', $id)->get();
      return $sample;
    }
public static function getTotalRequestFor(){
    $users_arr = User::where('is_deleted','!=',0)->whereHas("roles", function($q){ $q->where("name", "Client"); })->get();
    return count($users_arr);
}



//this function is used to get baseurl and route path
public static function getBaseURL(){
return url('/');
}
public static function getRouteName(){
    $route_arr= explode(url('/')."/",url()->current());
    if(array_key_exists(1,$route_arr)){
    return $route_arr[1];
    }

}

}
