<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Google_Client;
use Google_Service_Oauth2;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use DateTime;

class googleAuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $meeting = Meeting::find($request->meeting_id);

        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT'));

        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setState($meeting->id);

        $authUrl = $client->createAuthUrl();

        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT'));

        if ($request->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->input('code'));
            $client->setAccessToken($token['access_token']);

            $service = new Google_Service_Calendar($client);
            $userTimeZone = $service->calendarList->get('primary')->getTimeZone();         // Fetch the user's time zone from their Google Calendar settings

            $meeting = Meeting::find($request->state);
            $date = new DateTime($meeting->date);                                        // Convert start_date_time to a DateTime object
            $formattedDate = $date->format('Y-m-d');
            $startTime = $meeting->meeting_time;
            $Date_Time = $formattedDate . 'T' . $startTime . ':00';
            $endTime = date('H:i:s', strtotime($startTime) + 3600);
            $endDateTime = $formattedDate . 'T' . $endTime;


            $event = new \Google_Service_Calendar_Event([                                // Create Google Calendar event with the user's time zone
                'summary' => $meeting->subject,
                'start' => [
                    'dateTime' => $Date_Time,
                    'timeZone' => $userTimeZone,
                ],
                'end' => [
                    'dateTime' =>  $endDateTime,
                    'timeZone' => $userTimeZone,
                ],
                'attendees' => [
                    ['email' => $meeting->organizer_email],
                    ['email' => $meeting->attendee1_email],
                    ['email' => $meeting->attendee2_email],
                ],
            ]);

            // Convert the event to an array before logging
            \Log::info('Google Calendar Event Data:', (array) $event->toSimpleObject());

            try {
                $calendarId = 'primary';
                $event = $service->events->insert($calendarId, $event);
                $meeting->google_access_token = $token['access_token'];
                $meeting->google_refresh_token = $token['refresh_token'];
                $meeting->google_event_id = $event->getId();
                $meeting->save();

                return redirect()->route('meeting.index')->with('success', 'Meeting created successfully!');
            } catch (\Google_Service_Exception $e) {
                \Log::error('Google Calendar API Error:', ['error' => $e->getMessage()]);
                return redirect()->route('meeting.index')->with('error', 'Failed to create Google Calendar event.');
            }
        } else {
            return redirect()->route('meeting.index')->with('error', 'Failed to get authorization code from Google.');
        }
    }
}
