<?php

namespace App\Models\Tasklist;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $table = 'status';
	protected $fillable = ['name'];

}
