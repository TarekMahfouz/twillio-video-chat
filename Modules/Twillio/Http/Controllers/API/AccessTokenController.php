<?php

namespace Modules\Twillio\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Twilio\Jwt\AccessToken;
use Modules\Twillio\Entities\VideoToken;
use Twilio\Jwt\Grants\VideoGrant;

class AccessTokenController extends Controller
{
    public function generate_token(Request $request)
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $apiKeySid = env('TWILIO_API_KEY_SID');
        $apiKeySecret = env('TWILIO_API_KEY_SECRET');

        $identity = $request->identity;
        $room_name = $request->room_name;

        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity,
            $room_name
        );

        // Grant access to Video
        $grant = new VideoGrant();
        // $grant->setRoom('');
        $token->addGrant($grant);

        // Serialize the token as a JWT
        $result=[
            "identity" => $identity,
            "token"=> $token->toJWT()
        ];

        return response()->json($result);
    }

    public function save_token(Request $request)
    {
        VideoToken::create([
            'twilio_token' => $request->twilio_token
        ]);
    }
}
