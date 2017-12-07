<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class meeting_reports extends Model
{
    use SoftDeletes;

    // protected $table = 'meeting_reports';

    protected $dates = ['deleted_at'];
}
