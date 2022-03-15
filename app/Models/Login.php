<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aspnet_users extends Model
{
    protected $table = "application_evaluation_item";

    protected $fillable = [
        "application_evaluation_id",
        "evaluation_item_id",
        "satisfied",
        "remarks",
        "satisifed_cen",
        "remarks_cen"
    ];

    public $timestamps = false;

    public function Evaluation()
    {
        return $this->belongsTo(ApplicationEvaluation::class, 'application_evaluation_id', 'id');
    }

    public function Details()
    {
        return $this->hasOne(ApplicationEvaluationItemLookup::class, 'id', 'evaluation_item_id');
    }
}
