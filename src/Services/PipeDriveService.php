<?php

namespace Pipedrive\Services;

use Illuminate\Support\Facades\Http;
use Pipedrive\Contracts\PipeDriveInterface;

class PipeDriveService implements PipeDriveInterface
{
    private string $oAuthID;
    private string $oAuthSecret;
    private string $redirect;
    private string $oauth;
    private string $endpoint;

    public function __construct()
    {
        $this->oAuthID = config('pipedrive.pipedrive.id');
        $this->oAuthSecret = config('pipedrive.pipedrive.secret');
        $this->redirect = config('pipedrive.pipedrive.redirect');
        $this->oauth = config('pipedrive.pipedrive.oauth');
        $this->endpoint = config('pipedrive.pipedrive.endpoint');
    }

    /**
     * @param $userId
     * @param $redirect
     * @return string
     */
    public function OAuthRedirect($userId = null, $redirect = null): string
    {
        if(!isset($userId)){
            $params = [
                'client_id' =>  $this->oAuthID,
                'redirect_uri' =>  $this->redirect
            ];
        }
        else{
            $params = [
                'client_id' => $userId,
                'redirect_uri' => $redirect
            ];
        }



        $query = http_build_query($params);
        return "$this->oauth/authorize?$query";

    }

    /**
     * @param string $code
     * @return void
     */
    public function getAccessToken(string $code): void
    {
        $username = $this->oAuthID;
        $password = $this->oAuthSecret;
        $getToken = $this->oauth . '/token';

        try {
            $response = Http::withBasicAuth($username, $password)
                ->asForm()
                ->post($getToken, [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => url()->current(),
                    'code' => $code
                ])->json();

            $access_token = $response['access_token'];
            $expired = $response['expires_in'];
            $refreshToken = $response['refresh_token'];

            auth()->user()->token()->updateOrCreate(['user_id' => auth()->id()], [
                'access_token' => $access_token,
                'refresh_token' => $refreshToken,
                'expires_in' => $expired
            ]);

            $this->OAuthAuthorize();
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('message_type', 'danger');
        }

    }

    /**
     * @return void
     */
    public function OAuthAuthorize(): void
    {
        $endpoint = $this->endpoint;

        if (auth()->user()->token->hasExpired()) {
            $this->refreshToken();

        }
        $token = auth()->user()->token->access_token;
        try {
            $responses = Http::withToken($token)->get($endpoint . '/leads')->json();
            $leads = $responses['data'];

            if ($leads) {
                foreach ($leads as $lead) {
                    $labels = json_encode($lead['label_ids']);
                    $created = date('Y-m-d', strtotime($lead['add_time']));

                    auth()->user()->pipeLead()
                        ->updateOrCreate([
                            'pipe_id' => $lead['id'],
                            'user_id' => auth()->id()
                        ],
                            [
                                'pipe_id' => $lead['id'],
                                'lead_title' => $lead['title'],
                                'lead_label' => $labels,
                                'lead_created' => $created,
                            ]);
                }
            }
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('message_type', 'danger');
        }

    }

    /**
     * @return bool
     */
    public function hasMapping(): bool
    {
        $endpoint = $this->endpoint;
        if (auth()->user()->token && auth()->user()->token->hasExpired()) {
            $this->refreshToken();

        }
        try {
            $token = auth()->user()->token->access_token;

            $responses = Http::withToken($token)
                ->get($endpoint . '/organizationFields')
                ->json();

            $fields = $responses['data'];
            if ($fields) {
                foreach ($fields as $key => $value) {
                    if ($key < 30) {
                        continue;
                    }
                    auth()->user()->pipeField()
                        ->updateOrCreate([
                            'pipe_id' => $value['id'],
                            'user_id' => auth()->id()
                        ],
                            [
                                'pipe_id' => $value['id'],
                                'fields' => $value['name'],
                            ]);
                }
            }
            return true;

        } catch (\Exception $e) {
            session()->flash('message', 'you need pipedrive integration for use mapping');
            session()->flash('message_type', 'danger');
            return false;
        }
    }

    /**
     * @return void
     */
    public function refreshToken(): void
    {
        $username = $this->oAuthID;
        $password = $this->oAuthSecret;
        $getToken = $this->oauth . '/token';

        $getRefreshToken = Http::withBasicAuth($username, $password)
            ->asForm()
            ->post($getToken, [
                'grant_type' => 'refresh_token',
                'refresh_token' => auth()->user()->token->refresh_token
            ])->json();

        $access_token = $getRefreshToken['access_token'];
        $refreshToken = $getRefreshToken['refresh_token'];
        $expired = $getRefreshToken['expires_in'];

        auth()->user()->token()->update([
            'access_token' => $access_token,
            'refresh_token' => $refreshToken,
            'expires_in' => $expired

        ]);

    }

}