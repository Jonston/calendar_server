<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    const TYPE_EXPERT_MEETING = 'expert_meeting';
    const TYPE_QUESTION_ANSWER = 'question_answer';
    const TYPE_CONFERENCE = 'conference';
    const TYPE_WEBINAR = 'webinar';

    const TYPES = [
        self::TYPE_EXPERT_MEETING,
        self::TYPE_QUESTION_ANSWER,
        self::TYPE_CONFERENCE,
        self::TYPE_WEBINAR,
    ];

    protected $fillable = [
        'title',
        'description',
        'location',
        'start',
        'end',
        'type',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    protected $appends = [
        'date',
        'datetime',
    ];

    public function date(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->start->format('Y-m-d')
        );
    }

    public function datetime(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->start->format('Y-m-d H:i:s')
        );
    }

    public function scopeWhereYear($query, int $year): void
    {
        $query->whereRaw('YEAR(start) = ?', [$year]);
    }

    public function scopeWhereMonth($query, int $month): void
    {
        $query->whereRaw('MONTH(start) = ?', [$month]);
    }
}
