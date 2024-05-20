<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingValidation;
use App\Models\Meeting;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use DateTime;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meeting = Meeting::latest()->get();
        return view('meeting.index', compact('meeting'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MeetingValidation $request)
    {

        $client = new \Google_Client();
        $client->setAuthConfig(base_path('app/Credentials/key_tester_account.json'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri('http:/meeting');
        $meeting = new Meeting();
        $meeting->subject = $request->subject;
        $meeting->date = $request->date;
        $meeting->meeting_time = $request->meeting_time;
        $meeting->organizer_email = $request->organizer_email;
        $meeting->attendee1_email = $request->attendee_1;
        $meeting->attendee2_email = $request->attendee_2;

        $meeting->save();
        return redirect()->route('google.redirect', ['meeting_id' => $meeting->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meeting = Meeting::find($id);
        return view('meeting.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meeting = Meeting::find($id);
        return response()->json($meeting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MeetingValidation $request, $id)
    {
        $meeting = Meeting::find($id);

        if ($meeting) {
            if ($meeting->google_event_id != null) {

                $meeting->subject = $request->subject;
                $meeting->date = $request->date;
                $meeting->meeting_time = $request->meeting_time;
                $meeting->organizer_email = $request->organizer_email;
                $meeting->attendee1_email = $request->attendee_1;
                $meeting->attendee2_email = $request->attendee_2;
                $meeting->save();
                $client = $this->refreshAccessToken($meeting);
                $this->updateGoogleCalendarEvent($client, $meeting);

                return redirect()->route('meeting.index')->with('success', 'Meeting updated successfully.');
            } else {
                return redirect()->route('meeting.index')->with('error', 'Meeting Can not be Update delete this event and add new event.');
            }
        } else {
            return redirect()->route('meeting.index')->with('error', 'Meeting not found.');
        }
    }

    private function updateGoogleCalendarEvent($client, $meeting)
    {

        $date = new DateTime($meeting->date);            // Convert start_date_time to a DateTime object
        $formattedDate = $date->format('Y-m-d');
        $startTime = $meeting->meeting_time;
        $date_Time = $formattedDate . 'T' . $startTime . ':00';
        $endTime = date('H:i:s', strtotime($startTime) + 3600);
        $endDateTime = $formattedDate . 'T' . $endTime;

        $endTime = date('H:i:s', strtotime($startTime) + 3600);

        $endDateTime = $formattedDate . 'T' . $endTime;
        $service = new Google_Service_Calendar($client);
        $userTimeZone = $service->calendarList->get('primary')->getTimeZone();     // Fetch the user's time zone from their Google Calendar settings

        $event = new \Google_Service_Calendar_Event([
            'summary' => $meeting->subject,
            'start' => [
                'dateTime' => $date_Time,
                'timeZone' =>  $userTimeZone,
            ],
            'end' => [
                'dateTime' => $endDateTime,
                'timeZone' =>  $userTimeZone,
            ],
            'attendees' => [
                ['email' => $meeting->organizer_email],
                ['email' => $meeting->attendee1_email],
                ['email' => $meeting->attendee2_email],
            ],
        ]);

        $service->events->update('primary', $meeting->google_event_id, $event);

        \Log::info('Google Calendar Event Updated:', (array)$event->toSimpleObject());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $meeting = Meeting::find($id);

        if ($meeting) {
            if ($meeting->google_event_id != null) {
                $client = $this->refreshAccessToken($meeting);
                $service = new Google_Service_Calendar($client);

                try {
                    $service->events->delete('primary', $meeting->google_event_id);
                    $meeting->delete();

                    return redirect()->route('meeting.index')->with('success', 'Meeting deleted successfully.');
                } catch (\Google_Service_Exception $e) {
                    \Log::error('Google Calendar API Error:', ['error' => $e->getMessage()]);
                    return redirect()->route('meeting.index')->with('error', 'Failed to delete Google Calendar event.');
                }
            } else {
                $meeting->delete();
                return redirect()->route('meeting.index')->with('success', 'Meeting deleted successfully.');
            }
        } else {
            return redirect()->route('meeting.index')->with('error', 'Meeting not found.');
        }
    }

    private function refreshAccessToken($meeting)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT'));

        $client->refreshToken($meeting->google_refresh_token);

        $newToken = $client->getAccessToken();

        $meeting->google_access_token = $newToken['access_token'];
        if (isset($newToken['refresh_token'])) {
            $meeting->google_refresh_token = $newToken['refresh_token'];
        }
        $meeting->save();

        return $client;
    }
}
