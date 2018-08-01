<?php

namespace App\Models\Tasklist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Tasklist\Status;

use Carbon\Carbon;

class Tasks extends Model {

	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $table = 'tasks';
	protected $fillable = ['title', 'description', 'completed_at'];
	protected $hidden = ['user_id', 'status_id'];

    public static function boot() {
        parent::boot();

        static::saving(function($model){

            if ($model->status->name == 'concluído'){
                $model->completed_at = Carbon::now();
            } else {
                $model->completed_at = null;
            }
        });
    }

	public function scopeWithAll($query) {
        return $query->with(['user', 'status']);
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

	public function status() {
		return $this->hasOne(Status::class, 'id', 'status_id');
	}

}
