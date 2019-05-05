<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Theme;
use PDF;
use Khill\Lavacharts\Lavacharts;
class HomeController extends Controller
{

    //v2
      public function index(){
        $userRoles=[];
        if (Auth::user()) {   // Check is user logged in
        $user = auth()->user();
        $userRoles = $user->getRoleNames();
        $user_role = $userRoles[0];
        }else{
        $user_role='GUEST';
        }
        switch($user_role){
        case 'Admin':
        return $this->CoreDashboard();
        break;
        case 'Client':
        return $this->CoreDashboard();
        break;
        case 'Staff':
        return $this->CoreDashboard();
        break;
        case 'SalesUser':
        return $this->CoreDashboard();
        break;
        default:
        return $this->Front();
        break;
        }


      }
      public function CoreDashboard(){
        $theme = Theme::uses('corex')->layout('layout');
        $lava = new Lavacharts; // See note below for Laravel
        $finances = $lava->DataTable();
        $finances->addDateColumn('Year')
         ->addNumberColumn('Hotel')
         ->setDateTimeFormat('d-m-Y')
         ->addRow(['1-03-2019', 1 ])
         ->addRow(['2-03-2019', 102 ])
         ->addRow(['3-03-2019', 100 ])
         ->addRow(['4-03-2019', 1000 ])
         ->addRow(['5-03-2019', 1000 ])
         ->addRow(['6-03-2019', 6 ])
         ->addRow(['7-03-2019', 1000 ])
         ->addRow(['8-03-2019', 1000 ])
         ->addRow(['9-03-2019', 4 ])
         ->addRow(['10-03-2019', 1000 ])
         ->addRow(['11-03-2019', 1000 ])
         ->addRow(['12-03-2019', 1000 ])
         ->addRow(['13-03-2019', 1000 ])
         ->addRow(['14-03-2019', 4 ])
         ->addRow(['15-03-2019', 1000 ])
         ->addRow(['16-03-2019', 1000 ])
         ->addRow(['17-03-2019', 1000 ])
         ->addRow(['18-03-2019', 4 ])
         ->addRow(['19-03-2019', 7 ])
         ->addRow(['20-03-2019', 1800 ])
         ->addRow(['21-03-2019', 1000 ])
         ->addRow(['22-03-2019', 109 ])
         ->addRow(['23-03-2019', 1000 ])
         ->addRow(['24-03-2019', 170 ])
         ->addRow(['25-03-2019', 1000 ])
         ->addRow(['26-03-2019', 1000 ])
         ->addRow(['27-03-2019', 1000 ])
         ->addRow(['28-03-2019', 150 ])
         ->addRow(['29-03-2019', 1000 ])
         ->addRow(['30-03-2019', 5 ]);



         $donutchart = \Lava::ColumnChart('Finances', $finances, [
                   'title' => 'Hoted Added Graph',
                   'titleTextStyle' => [
                     'color'    => '#eb6b2c',
                     'fontSize' => 14
                   ]
               ]);
        $data=["name"=>"Ajay"];

        return $theme->scope('dash.index', $data)->render();
      }
      public function ClinetDashboard(){
        echo "under process";
      }
    //v2



public function UploadDropzone(Request $request){
  print_r($request->all());
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function mypdf(){
       $theme = Theme::uses('admin')->layout('layout');
       $data=["name"=>"Ajay"];
       PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
       $pdf = PDF::loadView('pdf.sample', $data);
       return $pdf->download('invoice.pdf');
     }
    public function index_()
    {
        $userRoles=[];
        if (Auth::user()) {   // Check is user logged in
        $user = auth()->user();
        $userRoles = $user->getRoleNames();
        $user_role = $userRoles[0];
        }else{
        $user_role='GUEST';
        }
        switch($user_role){
        case 'Admin':
        return $this->AdminDashboard();
        break;
        case 'Client':
        return $this->UserDashboard();
        break;
        case 'Staff':
        return $this->StaffDashboard();
        break;
        case 'SalesUser':
        return $this->SalesUserDashboard();
        break;
        default:
        return $this->Front();
        break;
        }

    }
    public function AdminDashboard(){
        $theme = Theme::uses('admin')->layout('layout');
        $data = ['info' => 'Hello World'];
        return $theme->scope('home.index', $data)->render();
    }
    public function StaffDashboard(){

        $theme = Theme::uses('staff')->layout('layout');
        $data = ['info' => 'This is user information'];
        return $theme->scope('home.index', $data)->render();
    }
    public function SalesUserDashboard(){

        $theme = Theme::uses('salesagent')->layout('layout');
        $data = ['info' => 'This is user information'];
        return $theme->scope('home.index', $data)->render();
    }
    public function Front(){
        $theme = Theme::uses('default')->layout('layout');
        $data = ['info' => 'Hello World'];
        return $theme->scope('index', $data)->render();
    }
  //  anoops@bointernational.net
    //sahilg@bointernational.net


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
