<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Theme;
use App\User;
use App\Sample;
use App\Company;
use App\Client;
use App\RowClient;
use App\ContactClient;
use Auth;
use App\Helpers\AyraHelp;
//include 'class-list-util.php';
class SampleController extends Controller
{
  public function __construct()
  {
      $this->middleware(['auth', 'clinetPermission'])->except('print_all','print','getPrintSampleListOwn','getPrintSampleList','getROWClientsList','softdeleteClient','deleteClient','clients_edit','getClientDetails','getClientsListforDelete','deleteSample','samples_edit','samples_edit_info','saveSampleCourier','getSampleDetails','getClientAddress','getClientsList', 'getClientList','getSampleList','getSamplesList','samples');

  }
  public function print_all(){

    $theme = Theme::uses('corex')->layout('layout');
    $max_id = Sample::max('sample_index')+1;
    $user = auth()->user();
    $userRoles = $user->getRoleNames();
    $user_role = $userRoles[0];
    if($user_role=='Admin' || $user_role=='Staff'){
      $sample_arr=Sample::where('status',1)->get();
    }else{
      $sample_arr=Sample::where('status',1)->where('created_by',Auth::user()->id)->get();
    }
    foreach ($sample_arr as $key => $value) {

      $users = Client::where('id',$value->client_id)->first();
    

      $sample_data[] = array(
        'sample_code' => $value->sample_code,
        'client_name' =>AyraHelp::getClientbyid($value->client_id)->firstname,
        'client_phone' =>$users->phone,
        'client_address' =>$value->ship_address,
        'client_company' =>$users->company,
        'sample_details' =>json_decode($value->sample_details),
      );
    }

    $data = [
      'users' =>'$users',
      'sample_id'=>$max_id,
      'sample_data'=>$sample_data
    ];
    return $theme->scope('sample.print', $data)->render();

  }
  public function print($id){
    $theme = Theme::uses('corex')->layout('layout');
    $max_id = Sample::max('sample_index')+1;
    $user = auth()->user();
    $userRoles = $user->getRoleNames();
    $user_role = $userRoles[0];
    if($user_role=='Admin' || $user_role=='Staff'){
      $sample_arr=Sample::where('id',$id)->get();
    }else{
      $sample_arr=Sample::where('id',$id)->where('created_by',Auth::user()->id)->get();
    }
    $sample_data = array();
    foreach ($sample_arr as $key => $value) {
      $users = Client::where('id',$value->client_id)->first();

      $sample_data[] = array(
        'sample_code' => $value->sample_code,
        'client_name' =>AyraHelp::getClientbyid($value->client_id)->firstname,
        'client_phone' =>$users->phone,
        'client_address' =>$value->ship_address,
        'client_company' =>$users->company,
        'sample_details' =>json_decode($value->sample_details),
      );
    }

    $data = [
      'users' =>'$users',
      'sample_id'=>$max_id,
      'sample_data'=>$sample_data
    ];
    return $theme->scope('sample.print', $data)->render();

  }
  public function getPrintSampleListOwn($id){
    $sample_arr=Sample::where('created_by',$id)->get();
    $HTML='';
    foreach ($sample_arr as $key => $value) {
      $users = User::find($value->client_name);
      $HTML .='<table class="table">
        <tbody>
          <tr>
            <th>ID</th>
            <td>'.$value->sample_id.'</td>
            <th>Name</th>
            <td>'.$users->name.'</td>
            <th>Phone</th>
            <td width="150">'.$users->phone.'</td>
          </tr>
          <tr>
            <th>Details</th>
            <td colspan="5">
              '.$value->sample_details.'
            </td>
          </tr>
          <tr>
            <th>Address</th>
            <td colspan="5"> '.$value->ship_address.'</td>
          </tr>

        </tbody>
      </table><hr>';
    }

    echo $HTML;
  }

  public function getPrintSampleList(Request $request){
      $sample_arr=Sample::get();
      $HTML='';
      foreach ($sample_arr as $key => $value) {
        $users = User::find($value->client_name);
        $HTML .='<table class="table">
          <tbody>
            <tr>
              <th>ID</th>
              <td>'.$value->sample_id.'</td>
              <th>Name</th>
              <td>'.$users->name.'</td>
              <th>Phone</th>
              <td width="150">'.$users->phone.'</td>
            </tr>
            <tr>
              <th>Details</th>
              <td colspan="5">
                '.$value->sample_details.'
              </td>
            </tr>
            <tr>
              <th>Address</th>
              <td colspan="5"> '.$value->ship_address.'</td>
            </tr>

          </tbody>
        </table><hr>';
      }

      echo $HTML;
  }
  public function softdeleteClient(Request $request){
    $userid=$request->userId;
    User::where('id', $userid)
          ->update(['is_deleted' => 1]);
    $data = array(
      'status' => '1',
      'message' => 'Sent for Deleted Deleted successfully',
     );
    return response()->json($data);
  }

public function deleteClient(Request $request){
  $userid=$request->userId;
  $users = User::find($userid);
  $users->delete();
  $res=Company::where('user_id',$userid)->delete();
  $data = array(
    'status' => '1',
    'message' => 'Deleted successfully',
   );
  return response()->json($data);

}
public function clients_edit(Request $request){
  $user_id=$request->user_id;
    if($request->email==""){
          $no_email='NoEmail_'.date('ymdHis').'@boitel.xyzz';
          User::where('id', $user_id)
                 ->update([
                   'name' => $request->name,
                   'email' => $no_email,
                   'phone' => $request->phone
                 ]);
                 Company::where('user_id', $user_id)
                        ->update([
                          'company_name' => $request->company,
                          'brand_name' => $request->brnad_name,
                          'gst_details' => $request->gst,
                          'address' => $request->address,
                          'remarks' => $request->remarks
                        ]);
    }else{

      User::where('id', $user_id)
             ->update([
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone
             ]);
             Company::where('user_id', $user_id)
                    ->update([
                      'company_name' => $request->company,
                      'brand_name' => $request->brnad_name,
                      'gst_details' => $request->gst,
                      'address' => $request->address,
                      'remarks' => $request->remarks
                    ]);
    }

                 $data = array(
                   'status' => '1',
                   'message' => 'Updated successfully',
                  );
return response()->json($data);

}
public function deleteSample(Request $request){

  $sample =Sample::find( $request->s_id);

  if($sample->status!=1){
    $data = array(
      'status' => '0',
      'message' => 'Could not delete',
     );
  }else{
    $sample->delete();
    $data = array(
      'status' => '1',
      'message' => 'Deleted successfully',
     );
  }

return response()->json($data);

}

public function samples_edit_info(Request $request){
   $sent_datev= date("Y-m-d", strtotime($request->sent_on));
          Sample::where('id', $request->s_id)
         ->update([
           'client_name' => $request->client_name,
           'sample_details' => $request->sample_details,
           'courier_details' => $request->courier_name,
           'track_id' => $request->track_id,
           'sample_sent_on' => $sent_datev,
           'status' => $request->status,
           'remarks' => $request->remarks,
           'ship_address' => $request->client_address,

         ]);
         Company::where('user_id', $request->client_name)
        ->update([
          'address' => $request->client_address
        ]);

         $data = array(
           'status' => '1',
           'message' => 'Data updated successfully'
          );

 return response()->json($data);

}
public function samples_edit(Request $request){
          Sample::where('id', $request->s_id)
         ->update([
           'client_name' => $request->client_name,
           'sample_details' => $request->sample_details,
           'courier_details' => $request->courier_name,
           'track_id' => $request->track_id,
           //'status' => $request->status,
           'remarks' => $request->remarks,
           'ship_address' => $request->client_address,

         ]);
         Company::where('user_id', $request->client_name)
        ->update([
          'address' => $request->client_address
        ]);

         $data = array(
           'status' => '1',
           'message' => 'Data updated successfully'
          );

 return response()->json($data);

}

   public function saveSampleCourier(Request $request){
     $sent_date=$request->sent_date;
     $sent_datev= date("Y-m-d", strtotime($sent_date));

       $sample_arr=Sample::where('id',$request->s_id)->first();
       Sample::where('id', $request->s_id)
              ->update([
                'courier_id' => $request->courier_id,
                'track_id' => $request->track_id,
                'status' =>$request->sample_status,
                'courier_remarks' => $request->remarks,
                'sent_on' => $sent_datev
              ]);
              $data = array(
                'status' => '1',
                'message' => 'Data saved successfully'
               );
      return response()->json($data);
   }


public function getClientsListforDelete(Request $request){
$users_arr = User::where('is_deleted','!=',0)->whereHas("roles", function($q){ $q->where("name", "Client"); })->get();
$data_arr = array();
$i=0;
foreach ($users_arr as $key => $value) {
 $i++;
$use_name=AyraHelp::getUserName($value->id);
$sale_agent=AyraHelp::getUserName($value->created_by);
$data_arr[]=array(
  'id' => $i,
  'rowid' => $value->id,
  'client_name' => $use_name,
  'email' => $value->email,
  'staff_name' =>$sale_agent,
  'status' => $value->status
  );
}

$resp_jon= json_encode($data_arr);
$data = $alldata = json_decode($resp_jon);

$datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

// search filter by keywords
$filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
  ? $datatable['query']['generalSearch'] : '';
if ( ! empty($filter)) {
  $data = array_filter($data, function ($a) use ($filter) {
      return (boolean)preg_grep("/$filter/i", (array)$a);
  });
  unset($datatable['query']['generalSearch']);
}

// filter by field query
$query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
if (is_array($query)) {
  $query = array_filter($query);
  foreach ($query as $key => $val) {
      $data = list_filter($data, [$key => $val]);
  }
}

$sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
$field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

$meta    = [];
$page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
$perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

$pages = 1;
$total = count($data); // total items in array

// sort
usort($data, function ($a, $b) use ($sort, $field) {
  if ( ! isset($a->$field) || ! isset($b->$field)) {
      return false;
  }

  if ($sort === 'desc') {
      return $a->$field > $b->$field ? true : false;
  }

  return $a->$field < $b->$field ? true : false;
});

// $perpage 0; get all data
if ($perpage > 0) {
  $pages  = ceil($total / $perpage); // calculate total pages
  $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
  $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
  $offset = ($page - 1) * $perpage;
  if ($offset < 0) {
      $offset = 0;
  }

  $data = array_slice($data, $offset, $perpage, true);
}

$meta = [
  'page'    => $page,
  'pages'   => $pages,
  'perpage' => $perpage,
  'total'   => $total,
];


// if selected all records enabled, provide all the ids
if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
  $meta['rowIds'] = array_map(function ($row) {
      return $row->id;
  }, $alldata);
}


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$result = [
  'meta' => $meta + [
          'sort'  => $sort,
          'field' => $field,
      ],
  'data' => $data,
];

echo json_encode($result, JSON_PRETTY_PRINT);

}

public function getClientDetails(Request $request){
  $User_arr=User::where('id',$request->recordID)->first();
  $client_arr=Company::where('user_id',$request->recordID)->first();
  $ContactClient_arr=ContactClient::where('parent_userid',$request->recordID)->get();


  //ajemail
  $email=$User_arr->email;
   if (strpos($email, 'NoEmail_') !== false) {
   $email_='';
   }else {
       $email_=$email;
   }

  $client_data = array(
    'name' =>isset($User_arr->name) ? $User_arr->name : '',
    'user_id' =>$User_arr->id,
    'email' =>isset($email_) ? $email_ : '',
    'phone' =>isset($User_arr->phone) ? $User_arr->phone : '',
    'company' =>isset($client_arr->company_name) ? $client_arr->company_name : '',
    'address' =>isset($client_arr->address) ? $client_arr->address : '',
    'gst_details' =>isset($client_arr->gst_details) ? $client_arr->gst_details : '',
    'brand_name' =>isset($client_arr->brand_name) ? $client_arr->brand_name : '',
    'remarks' =>isset($client_arr->remarks) ?$client_arr->remarks : '',
  );
  $client_contact_data = array(
    'name' =>isset($ContactClient_arr->name) ? $ContactClient_arr->name : '',
    'user_id' =>$User_arr->id,
    'email' =>isset($ContactClient_arr->email) ? $ContactClient_arr->email : '',
    'phone' =>isset($ContactClient_arr->phone) ? $ContactClient_arr->phone : '',

  );

  $data = array(
    'client_data' => $client_data,
    'agent_data' => $client_data,
    'sample_details' => $client_data,
    'client_contact' => json_encode($ContactClient_arr),

   );
   return response()->json($data);


}

    public function getSampleDetails(Request $request){
      $user = auth()->user();
      $userRoles = $user->getRoleNames();
      $user_role = $userRoles[0];
      if($user_role=='Admin'){
        $edit_pe=1;
      }
      if($user_role=='Staff'){
        $edit_pe=1;
      }
      if($user_role=='SalesUser'){
        $edit_pe=0;
      }
      $sample_arr=Sample::where('id',$request->recordID)->first();
      //print_r($sample_arr);
       $client_id=$sample_arr->client_id;
       $sales_agentid=$sample_arr->created_by;

       $client_arr=Client::where('id',$client_id)->first();

       $agent_arr=User::where('id',$sales_agentid)->first();


      $client_data = array(
        'name' =>isset($client_arr->name) ? $client_arr->name : '',
        'sample_code' =>isset($sample_arr->sample_code) ? $sample_arr->sample_code : '',
        'company' =>isset($client_arr->company) ? $client_arr->company : '',
        'user_id' =>$client_arr->id,
        's_id' =>$sample_arr->id,
        'edit_pe' =>$edit_pe,
        'contact_name' =>$client_arr->firstname,
        'email' =>isset($client_arr->email) ? $client_arr->email : '',
        'phone' =>isset($client_arr->phone) ? $client_arr->phone : '',
        'status' =>isset($sample_arr->status) ? $sample_arr->status : 1,
        'location' =>isset($sample_arr->location) ? $sample_arr->location : '',
        'address' =>isset($sample_arr->ship_address) ? $sample_arr->ship_address : '',
        'gst_details' =>isset($client_comp_arr->gst_details) ? $client_comp_arr->gst_details : '',
        'brand_name' =>isset($client_comp_arr->brand_name) ? $client_comp_arr->brand_name : '',
        'remarks' =>isset($client_comp_arr->remarks) ? $client_comp_arr->remarks : '',
        'sent_on' =>isset($sample_arr->sent_on) ?  date("d-M-Y", strtotime($sample_arr->sent_on) ): '',
      );
      $agent_data = array(
        'name' =>$agent_arr->name,
        'email' =>$agent_arr->email,
        'phone' =>$agent_arr->phone,

      );
      switch ($sample_arr->status) {
        case '1':
          $status_HTML='<span style="width: 100px;"><span class="m-badge  m-badge--primary m-badge--wide">NEW</span></span>';

          break;
        case '2':
          $status_HTML='<span style="width: 100px;"><span class="m-badge  m-badge--info m-badge--wide">SENT</span></span>';

            break;
        case '3':
          $status_HTML='<span style="width: 100px;"><span class="m-badge  m-badge--success m-badge--wide">RECIEVED</span></span>';

              break;
        case '4':
          $status_HTML='<span style="width: 100px;"><span class="m-badge  m-badge--warnnig m-badge--wide">FEEDBACK</span></span>';
                break;

      }

if(empty($sample_arr->courier_details)){
 $courier_details="";
}else{
$courier_details=AyraHelp::getCouriers($sample_arr->courier_details)->courier_name." | ".AyraHelp::getCouriers($sample_arr->courier_details)->courier_address;

}




$cour_arr=AyraHelp::getCouriers($sample_arr->courier_id);
$c_name=isset($cour_arr->courier_name) ? $cour_arr->courier_name : '';




      $sample_data = array(
        'sid_code' =>$sample_arr->sid_code,
        'sample_id' =>$sample_arr->sample_id,
        'sample_details' =>$sample_arr->sample_details,
        'courier_details' =>$courier_details,
        'courier_id' =>$sample_arr->courier_id,
        'courier_name' =>$c_name,
        'track_id' =>$sample_arr->track_id,
        'created_at' =>date('d,F Y', strtotime($sample_arr->created_at->toDateString())),
        'status' =>$status_HTML,
        'status_id' =>$sample_arr->status,
        'created_by' =>AyraHelp::getUserName($sample_arr->created_by),
        'remarks' =>$sample_arr->remarks,
        'courier_remarks' =>$sample_arr->courier_remarks,
        'feedback' =>$sample_arr->feedback,

      );

      $data = array(
        'client_data' => $client_data,
        'agent_data' => $agent_data,
        'sample_details' => $sample_data,
       );
       return response()->json($data);
    }
    public function getClientAddress(Request $request){
      $cid=$request->cid;
      $comp_arr=Client::where('id',$cid)->get();
      echo $comp_arr[0]->address;

    }

    public function index()
    {
        $theme = Theme::uses('corex')->layout('layout');
        $users = User::orderby('id', 'desc')->get();
        $data = ['users' =>$users];
        return $theme->scope('sample.index', $data)->render();

    }

public function getROWClientsList(){
  $users_arr = RowClient::get();
  $data_arr = array();
  $i=0;
  foreach ($users_arr as $key => $value) {
   $i++;

  $data_arr[]=array(
    'id' => $i,
    'rowid' => $value->id,
    'client_id' => $value->id,
    'email' => $value->email,
    'name' => $value->name,
    'phone' => $value->phone,
    'status' => $value->client_group
    );
  }

  $resp_jon= json_encode($data_arr);
  $data = $alldata = json_decode($resp_jon);

  $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

  // search filter by keywords
  $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
    ? $datatable['query']['generalSearch'] : '';
  if ( ! empty($filter)) {
    $data = array_filter($data, function ($a) use ($filter) {
        return (boolean)preg_grep("/$filter/i", (array)$a);
    });
    unset($datatable['query']['generalSearch']);
  }

  // filter by field query
  $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
  if (is_array($query)) {
    $query = array_filter($query);
    foreach ($query as $key => $val) {
        $data = list_filter($data, [$key => $val]);
    }
  }

  $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
  $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

  $meta    = [];
  $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
  $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

  $pages = 1;
  $total = count($data); // total items in array

  // sort
  usort($data, function ($a, $b) use ($sort, $field) {
    if ( ! isset($a->$field) || ! isset($b->$field)) {
        return false;
    }

    if ($sort === 'desc') {
        return $a->$field > $b->$field ? true : false;
    }

    return $a->$field < $b->$field ? true : false;
  });

  // $perpage 0; get all data
  if ($perpage > 0) {
    $pages  = ceil($total / $perpage); // calculate total pages
    $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
    $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
    $offset = ($page - 1) * $perpage;
    if ($offset < 0) {
        $offset = 0;
    }

    $data = array_slice($data, $offset, $perpage, true);
  }

  $meta = [
    'page'    => $page,
    'pages'   => $pages,
    'perpage' => $perpage,
    'total'   => $total,
  ];


  // if selected all records enabled, provide all the ids
  if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
    $meta['rowIds'] = array_map(function ($row) {
        return $row->id;
    }, $alldata);
  }


  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

  $result = [
    'meta' => $meta + [
            'sort'  => $sort,
            'field' => $field,
        ],
    'data' => $data,
  ];

  echo json_encode($result, JSON_PRETTY_PRINT);
}




    public function getClientList(Request $request,$userid){
    $users_arr=User::where('created_by',$userid)->where('is_deleted','!=',1)->get();

    $data_arr_ = array();
    $i=0;
   foreach ($users_arr as $key => $value) {
     $i++;
     $use_name=AyraHelp::getUserName($value->id);
     $companys=AyraHelp::getCompany($value->id);


     if(isset($companys->company_name)){
        $comp_name=$companys->company_name;
     }else{
       $comp_name="";
     }

     $email=$value->email;


      if (strpos($email, 'NoEmail_') !== false) {
      $email_='';
      }else {
          $email_=$email;
      }

    $data_arr_[]=array(
      'id' => $i,
      'rowid' => $value->id,
      'client_name' => $use_name,
      'phone' => $value->phone,
      'company' => $comp_name,
      'email' => $email_,
      'status' => $value->status
      );
  }
  $resp_jon= json_encode($data_arr_);
  $data = $alldata = json_decode($resp_jon);

  $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

  // search filter by keywords
  $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
      ? $datatable['query']['generalSearch'] : '';
  if ( ! empty($filter)) {
      $data = array_filter($data, function ($a) use ($filter) {
          return (boolean)preg_grep("/$filter/i", (array)$a);
      });
      unset($datatable['query']['generalSearch']);
  }

  // filter by field query
  $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
  if (is_array($query)) {
      $query = array_filter($query);
      foreach ($query as $key => $val) {
          $data = list_filter($data, [$key => $val]);
      }
  }

  $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
  $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

  $meta    = [];
  $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
  $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

  $pages = 1;
  $total = count($data); // total items in array

  // sort
  usort($data, function ($a, $b) use ($sort, $field) {
      if ( ! isset($a->$field) || ! isset($b->$field)) {
          return false;
      }

      if ($sort === 'desc') {
          return $a->$field > $b->$field ? true : false;
      }

      return $a->$field < $b->$field ? true : false;
  });

  // $perpage 0; get all data
  if ($perpage > 0) {
      $pages  = ceil($total / $perpage); // calculate total pages
      $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
      $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
      $offset = ($page - 1) * $perpage;
      if ($offset < 0) {
          $offset = 0;
      }

      $data = array_slice($data, $offset, $perpage, true);
  }

  $meta = [
      'page'    => $page,
      'pages'   => $pages,
      'perpage' => $perpage,
      'total'   => $total,
  ];


  // if selected all records enabled, provide all the ids
  if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
      $meta['rowIds'] = array_map(function ($row) {
          return $row->id;
      }, $alldata);
  }


  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

  $result = [
      'meta' => $meta + [
              'sort'  => $sort,
              'field' => $field,
          ],
      'data' => $data,
  ];

  echo json_encode($result, JSON_PRETTY_PRINT);

  }



public function getSamplesList(Request $request){
    $user = auth()->user();
    $userRoles = $user->getRoleNames();
    $user_role = $userRoles[0];
    if($user_role=='Admin' || $user_role=='Staff'){
          $users_arr = Sample::orderBy('id', 'desc')->get();
          $data_arr = array();
          $i=0;
          foreach ($users_arr as $key => $value) {
            $i++;
            $created_by=AyraHelp::getUserName($value->created_by);
            $client_arr=AyraHelp::getClientbyid($value->client_id);

            $data_arr[]=array(
              'RecordID' => $value->id,
              'sample_code' => $value->sample_code,
              'company' =>isset($client_arr->company) ? $client_arr->company : '',
              'phone' => isset($client_arr->phone) ? $client_arr->phone : '',
              'created_on' => date('j M Y', strtotime($value->created_at)),
              'created_by' => $created_by,
              'location' => $value->location,
              'Status' => $value->status,
              'sent_access' => 1
              );
        }
    }
      if($user_role=='SalesUser'){
            $users_arr = Sample::where('created_by',Auth::user()->id)->orderBy('id', 'desc')->get();
            $data_arr = array();
            $i=0;
            foreach ($users_arr as $key => $value) {
              $i++;
              $created_by=AyraHelp::getUserName($value->created_by);
              $client_arr=AyraHelp::getClientbyid($value->client_id);

              $data_arr[]=array(
                'RecordID' => $value->id,
                'sample_code' => $value->sample_code,
                'company' =>$client_arr->company,
                'phone' => $client_arr->phone,
                'created_on' => date('j M Y', strtotime($value->created_at)),
                'created_by' => $created_by,
                'location' => $value->location,
                'Status' => $value->status,
                'sent_access' => 1
                );
          }
      }


      $JSON_Data =json_encode($data_arr);
      $columnsDefault = [
        'RecordID'      => true,
        'sample_code'      => true,
        'company'      => true,
        'phone'      => true,
        'created_on'      => true,
        'created_by'     => true,
        'location'     => true,
        'Status' =>true,
        'sent_access' =>true,
        'Actions'      => true,
      ];

      $this->DataGridResponse($JSON_Data,$columnsDefault);


}

public function getSamplesList_(Request $request){
$users_arr=Sample::orderBy('id', 'desc')->get();
$data_arr = array();
$i=0;
foreach ($users_arr as $key => $value) {
 $i++;

 $client_arr=AyraHelp::getClientbyid($value->client_id);
 $sales_user=AyraHelp::getUser($value->created_by);
 $data_arr[]=array(
  'id' => $i,
  'rowid' => $value->id,
  'client_name' =>$client_arr->firstname,
  'sid_code' => $value->sid_code,
  'sample_id' => $value->sample_code,
  'sample_details' => $value->sample_details,
  'created_by' =>$sales_user->name,
  'created_by_id' =>$sales_user->id,

  'courier_details' => $value->courier_details,
  'track_id' =>  $value->track_id,
  'status' =>  $value->status

);
}
$resp_jon= json_encode($data_arr);
$data = $alldata = json_decode($resp_jon);

$datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

// search filter by keywords
$filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
  ? $datatable['query']['generalSearch'] : '';
if ( ! empty($filter)) {
  $data = array_filter($data, function ($a) use ($filter) {
      return (boolean)preg_grep("/$filter/i", (array)$a);
  });
  unset($datatable['query']['generalSearch']);
}

// filter by field query
$query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
if (is_array($query)) {
  $query = array_filter($query);
  foreach ($query as $key => $val) {
      $data = list_filter($data, [$key => $val]);
  }
}

$sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
$field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

$meta    = [];
$page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
$perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

$pages = 1;
$total = count($data); // total items in array

// sort
usort($data, function ($a, $b) use ($sort, $field) {
  if ( ! isset($a->$field) || ! isset($b->$field)) {
      return false;
  }

  if ($sort === 'desc') {
      return $a->$field > $b->$field ? true : false;
  }

  return $a->$field < $b->$field ? true : false;
});

// $perpage 0; get all data
if ($perpage > 0) {
  $pages  = ceil($total / $perpage); // calculate total pages
  $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
  $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
  $offset = ($page - 1) * $perpage;
  if ($offset < 0) {
      $offset = 0;
  }

  $data = array_slice($data, $offset, $perpage, true);
}

$meta = [
  'page'    => $page,
  'pages'   => $pages,
  'perpage' => $perpage,
  'total'   => $total,
];


// if selected all records enabled, provide all the ids
if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
  $meta['rowIds'] = array_map(function ($row) {
      return $row->id;
  }, $alldata);
}


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$result = [
  'meta' => $meta + [
          'sort'  => $sort,
          'field' => $field,
      ],
  'data' => $data,
];

echo json_encode($result, JSON_PRETTY_PRINT);

}



    public function getSampleList(Request $request,$userid){
    $users_arr=Sample::where('created_by',$userid)->get();
    $data_arr = array();
    $i=0;
   foreach ($users_arr as $key => $value) {
     $i++;
     $use_name=AyraHelp::getUserName($value->client_name);
     $companys=AyraHelp::getCompany($value->client_name);


     if(isset($companys->company_name)){
        $comp_name=$companys->company_name;
     }else{
       $comp_name="";
     }

    $data_arr[]=array(
      'id' => $i,
      'rowid' => $value->id,
      'sid_code' => $value->sid_code,
      'sample_id' => $value->sample_id,
      'company' => $comp_name,
      'client_name' => $use_name,
      'sample_details' => $value->sample_details,
      'courier_details' => $value->courier_details,
      'track_id' =>  $value->track_id,
      'status' =>  $value->status

    );
  }
  $resp_jon= json_encode($data_arr);
  $data = $alldata = json_decode($resp_jon);

  $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

  // search filter by keywords
  $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
      ? $datatable['query']['generalSearch'] : '';
  if ( ! empty($filter)) {
      $data = array_filter($data, function ($a) use ($filter) {
          return (boolean)preg_grep("/$filter/i", (array)$a);
      });
      unset($datatable['query']['generalSearch']);
  }

  // filter by field query
  $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
  if (is_array($query)) {
      $query = array_filter($query);
      foreach ($query as $key => $val) {
          $data = list_filter($data, [$key => $val]);
      }
  }

  $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
  $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'id';

  $meta    = [];
  $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
  $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

  $pages = 1;
  $total = count($data); // total items in array

  // sort
  usort($data, function ($a, $b) use ($sort, $field) {
      if ( ! isset($a->$field) || ! isset($b->$field)) {
          return false;
      }

      if ($sort === 'desc') {
          return $a->$field > $b->$field ? true : false;
      }

      return $a->$field < $b->$field ? true : false;
  });

  // $perpage 0; get all data
  if ($perpage > 0) {
      $pages  = ceil($total / $perpage); // calculate total pages
      $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
      $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
      $offset = ($page - 1) * $perpage;
      if ($offset < 0) {
          $offset = 0;
      }

      $data = array_slice($data, $offset, $perpage, true);
  }

  $meta = [
      'page'    => $page,
      'pages'   => $pages,
      'perpage' => $perpage,
      'total'   => $total,
  ];


  // if selected all records enabled, provide all the ids
  if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
      $meta['rowIds'] = array_map(function ($row) {
          return $row->id;
      }, $alldata);
  }


  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

  $result = [
      'meta' => $meta + [
              'sort'  => $sort,
              'field' => $field,
          ],
      'data' => $data,
  ];

  echo json_encode($result, JSON_PRETTY_PRINT);

  }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $theme = Theme::uses('corex')->layout('layout');
      $max_id = Sample::max('sample_index')+1;
      $data = [
        'users' =>'$users',
        'sample_id'=>$max_id
      ];
      return $theme->scope('sample.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $sample_data= json_encode($request->aj);
      $max_sample_index = Sample::max('sample_index')+1;

      $sid_code =AyraHelp::getSampleIDCode();

      $this->validate($request, [
          'client_id'=>'required|max:120',
      ]);

      $sample = new Sample;
      $sample->sample_index = $max_sample_index;
      //$sample->sample_code = $sid_code;
      $sample->sample_code = $request->sample_id;
      $sample->sample_details = $sample_data;
      $sample->client_id = $request->client_id;
      $sample->created_by = Auth::user()->id;
      $sample->remarks = $request->remarks;
      $sample->ship_address = $request->client_address;
      $sample->status = 1;
      $sample->save();
      $res_arr = array(
        'status' => 1,
        'Message' => 'Data saved successfully.',
      );
      return response()->json($res_arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $theme = Theme::uses('corex')->layout('layout');
       $sample_data=Sample::where('id',$id)->first();
       $client_data=Client::where('id',$sample_data->client_id)->first();



      //
      // $user = auth()->user();
      // if($user->hasAnyPermission(['view-all-notes'])){
      //   $client_notes=ClientNote::where('clinet_id',$id)->orderBy('id', 'desc')->get();
      // }else{
      //   $client_notes=ClientNote::where('clinet_id',$id)->where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
      // }

      $data = ['client_data' => $client_data,'sample_data' => $sample_data];
      return $theme->scope('sample.view', $data)->render();


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
     $sample= Sample::where('id',$id)->first();
     $client= Client::where('id',$sample->client_id)->first();
     $data = [
       'usersdata' =>$client,
       'samples'=>$sample,
     ];
     return $theme->scope('sample.edit', $data)->render();
   }
    public function edit_($id)
    {

       $theme = Theme::uses('corex')->layout('layout');
        $sample= Sample::where('id',$id)->first();
        $client= Client::where('id',$sample->client_id)->first();
        $data = [
          'usersdata' =>$client,
          'samples'=>$sample,
        ];
        return $theme->scope('sample.edit', $data)->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function samples_update(Request $request)
     {


         $sample= Sample::find($request->sample_id);
         $sample->client_name = $request->clinet_name;
         $sample->sample_details = $request->sample_details;
         $sample->courier_details = $request->courier_details;
         $sample->track_id = $request->track_id;
         $sample->status =  $request->status;
         $sample->remarks =  $request->remarks;
         $sample->ship_address = $request->client_address;
         $sample->save();
         return redirect()->route('users.sampleList')
             ->with('flash_message',
          'Sample successfully updated.');
     }

    public function update(Request $request, $id)
    {
      $user = auth()->user();
      $userRoles = $user->getRoleNames();
      $user_role = $userRoles[0];

    $sent_datev= date("Y-m-d", strtotime($request->sent_on));
        $sample= Sample::find($id);
        $sample->client_id = $request->client_id;
        $sample->sample_details =json_encode($request->aj);
        $sample->remarks =  $request->remarks;
        $sample->ship_address = $request->client_address;
        $sample->location = $request->location;
        $sample->remarks = $request->remarks;
        if($user_role=='Admin' || $user_role=='Staff'){
          $sample->courier_id = $request->courier_id;
          $sample->sent_on = $sent_datev;
          $sample->status = $request->sample_status;
          $sample->track_id = $request->track_id;
          $sample->courier_remarks = $request->courier_remarks;
        }
        $sample->save();
        $res_arr = array(
          'status' => 1,
          'Message' => 'Data updated successfully.',
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
    public function delete_sample($id){
      $sample = Sample::find($id);
      $sample->delete();
      return redirect()->route('sample.index')
          ->with('flash_message',
       'Sample successfully deleted.');
    }
    public function edit_sample($userid,$id){
      $theme = Theme::uses('staff')->layout('layout');
      $sample_data=Sample::where('id', $id)
            ->where('created_by', $userid)
            ->get();


      $users = User::where('created_by',$userid)->get();
      $data = ['samples' =>$sample_data,'users' =>$users];
      return $theme->scope('sample.edit', $data)->render();

    }
    public function edit_samples_($id){
      $theme = Theme::uses('admin')->layout('layout');
      $sample_data=Sample::where('id', $id)
            ->where('created_by', Auth::user()->id)
            ->get();
      $users = User::where('created_by', Auth::user()->id)->get();
      $data = ['samples' =>$sample_data,'users' =>$users];
      return $theme->scope('users.edit_sample', $data)->render();

    }
    public function edit_samples($id){
      $theme = Theme::uses('admin')->layout('layout');
      $data = ['samples' =>$id,'users' =>'33'];
      return $theme->scope('users.edit_sample', $data)->render();

    }


}
