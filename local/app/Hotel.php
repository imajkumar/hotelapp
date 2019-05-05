<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Hotel extends Model {

    protected $table = 'hotels';
    protected $guarded = [''];
    public $timestamps = false;
}
