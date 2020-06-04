<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model {
	use SoftDeletes;
	protected $table = 'channel_list';
	protected $fillable = ['channel_id', 'class_name', 'class_key', 'status'];

	public function channel_master() {
		return $this->belongsTo('App\Stream', 'channel_id');
	}
}
