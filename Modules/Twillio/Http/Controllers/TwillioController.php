<?php

namespace Modules\Twillio\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class TwillioController extends Controller
{

    protected $sid;
    protected $token;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->sid = env('TWILIO_ACCOUNT_SID');
        $this->token = env('TWILIO_ACCOUNT_TOKEN');
        $this->key = env('TWILIO_API_KEY_SID');
        $this->secret = env('TWILIO_API_KEY_SECRET');
    }

    public function index()
    {
        $rooms = [];
        try {
            $client = new Client($this->sid, $this->token);
            $allRooms = $client->video->rooms->read([]);

            $rooms = array_map(function($room) {
                return $room->uniqueName;
            }, $allRooms);

        } catch (\Exception $e) {
            echo "<p style='color: brown;'>Error: " . $e->getMessage(). "</p><br/><hr>";
        }
        return view('twillio::index', ['rooms' => $rooms]);
    }

    public function createRoom(Request $request)
    {
        $client = new Client($this->sid, $this->token);

        $exists = $client->video->rooms->read([ 'uniqueName' => $request->roomName]);

        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $request->roomName,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);

            \Log::debug("created new room: ".$request->roomName);
        }

        return redirect()->action('VideoRoomsController@joinRoom', [
            'roomName' => $request->roomName
        ]);
    }

    public function joinRoom($roomName)
    {
        // A unique identifier for this user
        $identity = Auth::user()->name;

        \Log::debug("joined with identity: $identity");
        $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $identity);

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);

        $token->addGrant($videoGrant);

        return view('room', [ 'accessToken' => $token->toJWT(), 'roomName' => $roomName ]);
    }
}
