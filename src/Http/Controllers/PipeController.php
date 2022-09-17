<?php

namespace Pipedrive\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Pipedrive\Facades\Pipe;
use Illuminate\Support\Facades\Http;
use Pipedrive\Http\PipeUploader;

class PipeController extends Controller
{
    public function redirect(Request $request)
    {
        if ($request->has('userId')) {
            $username = $request->userId;
            $password = $request->userSecret;
            $apiToken = $request->apiToken;
            $redirect = config('pipedrive.pipedrive_custom_ui.redirect');

            Session::put([
                'username' => $username,
                'password' => $password,
            ]);

            PipeUploader::create([
                'api_token' => $apiToken
            ]);
            $url = Pipe::OAuthRedirect($username, $redirect);
        } else {
            $url = Pipe::OAuthRedirect();
        }

        return redirect()->away($url);

    }

    public function init()
    {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            Pipe::getAccessToken($code);
            return redirect()->route('wave.dashboard');
        } else {
            return redirect()->route('wave.dashboard')->with(['message' => 'aborted', 'message_type' => 'danger']);

        }

    }

    public function token()
    {
        $token = PipeUploader::all()->last();
        return view('pipedrive::modal', compact('token'));
    }

    public function customUi()
    {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $username = Session::get('username');
            $password = Session::get('password');
            $getToken = config('pipedrive.pipedrive_custom_ui.oauth');

            try {
                Http::withBasicAuth($username, $password)
                    ->asForm()
                    ->post("$getToken/token", [
                        'grant_type' => 'authorization_code',
                        'redirect_uri' => url()->current(),
                        'code' => $code
                    ])->json();

                return redirect()->route('wave.dashboard')->with(['message' => 'uploader install', 'message_type' => 'success']);
            } catch (\Exception $e) {
                return redirect()->route('wave.dashboard')->with(['message' => 'aborted', 'message_type' => 'danger']);
            }

        }
    }

}
