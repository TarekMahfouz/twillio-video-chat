<?php

namespace App\Http\Controllers\WebZoom;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class MeetingController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = Zoom::user()->find('tarek.mahfouz@elabs-corp.com');
    }

    public function index(Request $request)
    {
        $users = Zoom::user()->all();
        $meetings = $this->user->meetings;

        return view('zoom.index')->with([
            'users' => $users,
            'meetings' => $meetings,
        ]);
    }

    public function createUser(Request $request)
    {
        return view('zoom.users.create');
    }

    public function storeUser(Request $request)
    {
        // $user = Zoom::user();
        $user = Zoom::user()->create([
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'password',
            'email' => $request->email
        ]);
        return 'ok';
    }

    public function users(Request $request)
    {
        $users = Zoom::user()->all();
        return view('zoom.users.list')->with(['users' => $users]);
    }

    // CREATE NEW MEETING
    public function createMeeting(Request $request)
    {
        return view('zoom.meetings.create');
    }

    public function storeMeeting(Request $request)
    {
        $meeting = Zoom::meeting()->make([
            'topic' => $request->topic,
            'type' => 8,
            'start_time' => new Carbon('2020-08-12 10:00:00'), // best to use a Carbon instance here.
        ]);

        $meeting->recurrence()->make([
            'type' => 2,
            'repeat_interval' => 1,
            //'weekly_days' => 2,
            'end_times' => 5
        ]);

        $meeting->settings()->make([
            'join_before_host' => true,
            'approval_type' => 1,
            'registration_type' => 2,
            'enforce_login' => false,
            'waiting_room' => false,
        ]);

        $this->user->meetings()->save($meeting);

        return redirect()->route('zoom.list.meetings');
    }

    public function meetings(Request $request)
    {
        $meetings = $this->user->meetings;
        // return $meetings;
        return view('zoom.meetings.list')->with(['meetings' => $meetings]);
    }

    public function getMeeting($id)
    {
        $meeting = Zoom::meeting()->find($id);
        return view('zoom.meetings.show')->with(['meeting' => $meeting]);
    }

    public function endMeeting($id)
    {
        $meeting = Zoom::meeting()->find($id);
        $meeting->endMeeting();
        return redirect()->route('zoom.list.meetings');
    }

    public function deleteMeeting($id)
    {
        $meeting = Zoom::meeting()->find($id);
        $meeting->delete();

        return redirect()->route('zoom.list.meetings');
    }
}
