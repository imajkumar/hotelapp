<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawClientDataSample extends Model
{
  protected $table = 'raw_client_data_sample';
  protected $guarded = [''];
  public $timestamps = false;
}
