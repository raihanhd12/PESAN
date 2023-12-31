<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'report_id',
        'status',
        'note'
    ];

    protected $with = ['user', 'report'];
    

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
