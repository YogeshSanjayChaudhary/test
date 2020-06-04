<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
	use SoftDeletes;
	protected $table = 'content';
	protected $fillable = ['content_id', 'content_description', 'video_url', 'video_key', 'status'];
}
