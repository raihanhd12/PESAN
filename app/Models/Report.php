<?php

namespace App\Models;

use App\Models\Reporter;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia, LogsActivity;

    protected $fillable = [

        'reporter_id',
        'category_id',
        'ticket_id',
        'title',
        'description',
        'status',

    ];
    protected $with = ['reporter', 'category'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable('*');
            // ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            // ->useLogName('Tracker');
    }

    public function reporter()
    {
        return $this->belongsTo(Reporter::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function tracker()
    {
        return $this->hasMany(Tracker::class);
    }
}
