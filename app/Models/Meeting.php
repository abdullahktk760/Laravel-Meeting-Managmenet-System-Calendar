<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;
    protected $casts = [
        'date' => 'datetime:Y-m-d',  // This will cast the date to a Carbon instance
    ];
    protected $fillable = [
        'subject',
        'date',
        'meeting_time',
        'organizer_email',
        'attendee1_email',
        'attendee2_email',
        'google_event_id',
        'google_access_token',
        'google_refresh_token'
    ];

    public function getShortSubjectAttribute()
    {
        $truncatedSubject = Str::limit($this->subject, 12);
        return ucfirst($truncatedSubject);
    }

    public function getShortDateAttribute()
    {
        return $this->date->format('M d');
    }

    public function getShortTimeAttribute()
    {
        return date('h:i A', strtotime($this->meeting_time));
    }

    public function getOrganizerNameAttribute()
    {

        $firstTwoCharacters = substr($this->organizer_email, 0, 2);
        return mb_convert_case($firstTwoCharacters, MB_CASE_UPPER, "UTF-8");
    }

    public function getFirstAttendeeNameAttribute()
    {

        $firstTwoCharacters = substr($this->attendee1_email, 0, 2);
        return mb_convert_case($firstTwoCharacters, MB_CASE_UPPER, "UTF-8");
    }

    public function getSecondAttendeeNameAttribute()
    {

        $firstTwoCharacters = substr($this->attendee2_email, 0, 2);
        return mb_convert_case($firstTwoCharacters, MB_CASE_UPPER, "UTF-8");
    }

}
