<?php

namespace Modules\Twillio\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class AccessTokenController extends Controller
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

    public function generate_token()
    {
        $identity = uniqid();

        // Create an Access Token
        $token = new AccessToken(
            $this->sid,
            $this->key,
            $this->secret,
            3600,
            $identity
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom('cool room');
        $token->addGrant($grant);

        // Serialize the token as a JWT
        echo $token->toJWT();
    }
}
