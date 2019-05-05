<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Client;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\AyraHelp;
use Theme;
class OrderController extends Controller
{


/*
|--------------------------------------------------------------------------
| function name:getOrderData
|--------------------------------------------------------------------------
| get the list of all orders in datagrid
*/
public function getOrderData(Request $request){
  print_r($request->all());

}


/*
|--------------------------------------------------------------------------
| function name:getOrderMainList
|--------------------------------------------------------------------------
| get the list of all orders in datagrid
*/
public function getOrderMainList(Request $request){
  $clientOrder_arr=Order::get();
  $data_arr=array();
  foreach ($clientOrder_arr as $key => $value) {
    $client_id=$value->client_id;

    $user_arr=AyraHelp::getClientbyid($client_id);
    $created_by=AyraHelp::getUserName($value->created_by);

    $created_on=date('j M Y', strtotime($value->created_at));
    $due_date=date('j M Y', strtotime($value->due_date));
    $brand=isset($user_arr->brand) ? $user_arr->brand : '';

    $data_arr[]=array(
      'RecordID' =>$value->id,
      'order_id' =>isset($value->order_id) ? $value->order_id : '',
      'phone' =>isset($user_arr->phone) ? $user_arr->phone : '',
      'company' =>isset($user_arr->company) ? $user_arr->company."(".$brand .")" : 'Ajay',
      'created_by' => $created_by,
      'created_on' =>$created_on,
      'due_date' =>$due_date,
      'Status' => $value->status,
      );
  }

      $JSON_Data =json_encode($data_arr);
      $columnsDefault = [
        'RecordID'     => true,
        'order_id'      => true,
        'phone'      => true,
        'company'  => true,
        'created_by'      => true,
        'created_on'     => true,
        'due_date'     => true,
        'Status'     => true,
        'Actions'      => true,
      ];

      $this->DataGridResponse($JSON_Data,$columnsDefault);
}

  /*
  |--------------------------------------------------------------------------
  | function name:getOrdersList
  |--------------------------------------------------------------------------
  | get the list of all orders in datagrid
  */
  public function getOrdersList(Request $request){

      $clientOrder_arr=Order::get();
      foreach ($clientOrder_arr as $key => $value) {
        $client_id=$value->clinet_id;
        $user_arr=AyraHelp::getClientbyid($client_id);
        $created_by=AyraHelp::getUserName($value->created_by);

        $created_on=date('j M Y', strtotime($value->created_at));
        $due_date=date('j M Y', strtotime($value->due_date));



        $data_arr[]=array(
          'RecordID' =>$value->id,
          'order_id' =>isset($value->order_id) ? $value->order_id : '',
          'company' =>isset($user_arr->company) ? $user_arr->company : 'Ajay',
          'created_by' => $created_by,
          'created_on' =>$created_on,
          'due_date' =>$due_date,
          'Status' => $value->status,
          );
      }

          $JSON_Data =json_encode($data_arr);
          $columnsDefault = [
            'RecordID'     => true,
            'order_id'      => true,
            'company'  => true,
            'created_by'      => true,
            'created_on'     => true,
            'due_date'     => true,
            'Status'     => true,
            'Actions'      => true,
          ];

          $this->DataGridResponse($JSON_Data,$columnsDefault);
  }


  /*
  |--------------------------------------------------------------------------
  | function name:index
  |--------------------------------------------------------------------------
  | get the list of all orders
  */
    public function index()
    {
      $theme = Theme::uses('corex')->layout('layout');
      $data = [
        'users' =>'',
      ];
      return $theme->scope('orders.index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $theme = Theme::uses('corex')->layout('layout');
      $data = [
        'users' =>'',
      ];
      return $theme->scope('orders.create', $data)->render();
    }

    /*
    |--------------------------------------------------------------------------
    | function name:store
    |--------------------------------------------------------------------------
    | save order data to order and items in order_items
    */
    public function store(Request $request)
    {
      


      $max_id = Order::max('id')+1;
      $num = $max_id;
      $str_length = 4;
      $order_code = "BO-".substr("0000{$num}", -$str_length);

      $order_obj = new Order;
      $order_obj->order_id = $order_code;
      $order_obj->client_id = $request->client_id;
      $order_obj->due_date = date("Y-m-d", strtotime($request->order_due_date));
      $order_obj->created_by =Auth::user()->id;
      $order_obj->item_qty =count($request->Orders);

      $order_obj->save();
      $lastinsertID=$order_obj->id;
      foreach ($request->Orders as $key => $value) {
         $orderItem_obj = new OrderItem;
          $orderItem_obj->item_name = $value['txtOrderItem'];
          $orderItem_obj->item_qty = $value['txtQTY'];
          $orderItem_obj->order_id = $order_code;
         $orderItem_obj->save();

      }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $theme = Theme::uses('corex')->layout('layout');
      $order= Order::where('id',$id)->first();
      $client= Client::where('id',$order->client_id)->first();
      $data = [
        'users_data' =>$client,
        'orders_dat'=>$sample,
      ];
      return $theme->scope('orders.edit', $data)->render();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
