<?php

namespace Modules\Twillio\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Twillio\Entities\Room;
use Modules\Twillio\Entities\User;

class TwillioController extends Controller
{

    public function authView()
    {
        return view('twillio::login');
    }
    public function registerView()
    {
        return view('twillio::register');
    }

    // Authenticate
    public function submitLogin(Request $request)
    {
        try {
            if($user = Auth::attempt($request->only(['email', 'password']), true)) {
                return redirect()->route('twillio.create.room');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect()->back();
    }
    public function submitRegister(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = $request->only(['name', 'email']);
            $data['password'] = bcrypt($request->password);

            User::create($data);

            if($user = Auth::attempt($request->only(['email', 'password']), true)) {
                return redirect()->route('twillio.create.room');
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return $e->getMessage();
        }
        return redirect()->back();
    }


    public function createRoom()
    {
        return view('twillio::create-room');
    }

    public function storeRoom(Request $request)
    {
        \DB::beginTransaction();
        try {
            $room_name = str_replace(' ', '-', $request->name);

            $room_code = $this->createRoomCode($room_name, Auth::user()->id);

            $data = [
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'code' => $room_code
            ];

            $room = Room::create($data);

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return $e->getMessage();
        }
        return redirect()->route('twillio.home', $room_code);
    }

    public function index($room_code)
    {
        return view('twillio::index')->with(['id' => $room_code]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('twillio.login');
    }


    private function createRoomCode($name, $userID, $count = 4)
    {
        return time()."-$name-$userID-".rand(pow(10, (int)$count - 1), pow(10, (int)$count) - 1);
    }
}
