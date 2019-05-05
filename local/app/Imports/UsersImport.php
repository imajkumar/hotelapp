<?php

namespace App\Imports;

use App\RawClientData;
use App\Client;
use App\Sample;

use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RawClientData([
           'product'     => $row[0],
           'company_name'     => $row[1],
           'location'     => $row[2],
           'contact_no'     => $row[3],
           'website'     => $row[4],
           'application'     => $row[5],
           'source'     => $row[6]

        ]);




      
        //for client upload
        // return new Client([
        //    'company'     => $row[0],
        //    'brand'     => $row[1],
        //    'address'     => $row[2],
        //    'gstno'     => $row[3],
        //    'firstname'     => $row[4],
        //    'email'     => $row[5],
        //    'phone'     => $row[6],
        //    'added_by'     => $row[7]
        //
        //
        // ]);
    //  for client upload


      //for client sample
      // return new Sample([
      //    'sample_index'     => $row[0],
      //    'sample_code'     => $row[1],
      //    'client_id'     => $row[2],
      //    'courier_id'     => $row[3],
      //    'track_id'     => $row[4],
      //    'created_at'     => $row[5],
      //    'status'     => $row[6],
      //    'created_by'     => $row[7],
      //    'remarks'     => $row[8],
      //
      //    'ship_address'     => $row[9],
      //    'sample_details'     => $row[10],
      //
      //
      //
      // ]);
    //for client upload
    }
}
