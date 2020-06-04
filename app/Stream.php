<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
	use SoftDeletes;
	protected $table = 'channel_master';
	protected $fillable = ['id', 'channel_name', 'channel_description','channel_url', 'status'];
}
