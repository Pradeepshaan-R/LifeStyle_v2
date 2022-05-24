<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\PasswordForgotMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * @group App Auth
 *
 * All auth related methods for Apps via API
 */
class AuthController extends Controller
{
    private $baseUrl;
    //private $baseUrl = 'https://stas.services'; //live server
    //private $baseUrl = 'https://test.aventagecrm.com'; //live server

    public function __construct()
    {
        $this->baseUrl = config("app.api_url_base");
    }

    /**
     * Login (via API)
     *
     * once logged in, we need to send the following to client
     * 1. user record
     * 2. access token
     *
     * @bodyParam email string  required The email of the user. Example: manager@test.com
     * @bodyParam password string  required The password of the user. Example: secret
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response("Bad request. Please verify email and password.", 400);
        }

        $user = User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            /*
            return response([
            'message' => ['These credentials do not match our records.'],
            ], 401);
             */
            return response("These credentials do not match our records", 401);
        }
        $accessToken = $user->createToken('AppToken')->plainTextToken;

        //$user = Auth::user();
        //$user['role'] = Auth::user()->roles[0]->name;
        //$user['role'] = auth()->user()->roles[0]->name;
        //$user['role'] = $user->role[0]->name;
        //$userSetting = UserSetting::get_current($user->id);
        unset($user['permissions']);
        unset($user['roles']);
        unset($user['uuid']);
        unset($user['active']);
        unset($user['confirmed']);
        unset($user['password_changed_at']);
        unset($user['confirmation_code']);
        unset($user['last_login_at']);
        unset($user['last_login_ip']);
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['deleted_at']);
        unset($user['provider']);
        unset($user['provider_id']);
        unset($user['to_be_logged_out']);
        unset($user['email_verified_at']);
        unset($user['type']);
        unset($user['timezone']);

        return response([
            'accessToken' => $accessToken,
            'baseUrl' => $this->baseUrl,
            'user' => $user,
        ]);
    }

    /**
     * Register new user
     *
     * A new user can register, but an admin has to authorize
     */
    public function register(Request $request)
    {
    }

    /**
     * logout
     *
     * Logout and delete the token
     * @authenticated
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response("Token deleted", 200);
    }

    /**
     * getSettings
     *
     * Get user settings of ogged in user
     * @authenticated
     */
    public function getProfile()
    {
        $user = Auth::user();
        $user['role'] = auth()->user()->roles[0]->name;
        unset($user['uuid']);
        unset($user['active']);
        unset($user['confirmed']);
        unset($user['password_changed_at']);
        unset($user['confirmation_code']);
        unset($user['last_login_at']);
        unset($user['last_login_ip']);
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['deleted_at']);
        unset($user['provider']);
        unset($user['provider_id']);
        unset($user['to_be_logged_out']);
        unset($user['email_verified_at']);
        unset($user['type']);
        unset($user['timezone']);
        return response(['user' => $user]);
    }

    /**
     * setSettings
     *
     * Update current user settings
     * @bodyParam name string The name of the user. Example: Siripala
     * @bodyParam phone string The phone. Example: 0112123456
     * @bodyParam theme integer The theme id. Example: 1
     * @bodyParam password string The user password. Example: secret
     * @bodyParam avatar file The user avatar.
     * @authenticated
     * {
     *     "name": "Tenant edited",
     *     "phone": 888555444,
     *     "theme": 5,
     *     "password": "secret",
     *     "user_settings": [
     *         "SHOW_LEADS_ON_DASHBOARD",
     *         "SHOW_BIRTHDAYS_ON_DASHBOARD",
     *         "SEND_EMAIL_NOTIFICATION",
     *         "SHOW_TODO_SUMMARY"
     *     ]
     * }

     */
    public function updateProfile(Request $request)
    {
        $path = "";

        try {
            $user = User::find(auth()->user()->id);
            if ($request->name) {$user->name = $request->name;}
            //if ($request->phone) {$user->phone = $request->phone;}
            if ($request->theme) {$user->theme = $request->theme;}
            if ($request->password) {$user->password = bcrypt($request->password);}
            if ($request->hasFile('avatar')) {
                if ($request->file('avatar')->isValid()) {
                    //$path = $request->file('avatar')->store('avatars');
                    $path = $request->file('avatar')->storeAs('avatars', auth()->user()->id . '.jpg');
                    $user->avatar_type = "storage";
                    $user->avatar_location = $path;
                } else {
                    $path = "upload err";
                }
            }
            $user->save();

            //Update user settings
            UserSetting::set_current($request->user_settings);

            return response(['message' => 'Update Successful- ' . $path], 200);
        } catch (Exception $ex) {
            return response(['message' => 'Update Not Successful- ' . $path], 400);
            //dd($ex);
        }
    }

    /**
     * Dashboard
     *
     * Use this for pulldown-to-refresh function of the app dashbaord
     * @authenticated
     */
    public function dashboard()
    {
        $user = Auth::user();
        $role = auth()->user()->roles[0]->name;
        $user['role'] = $role;
        unset($user['uuid']);
        unset($user['active']);
        unset($user['confirmed']);
        unset($user['password_changed_at']);
        unset($user['confirmation_code']);
        unset($user['last_login_at']);
        unset($user['last_login_ip']);
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['deleted_at']);
        unset($user['provider']);
        unset($user['provider_id']);
        unset($user['to_be_logged_out']);
        unset($user['email_verified_at']);
        unset($user['type']);
        unset($user['timezone']);

        return response([
            'dashboard' => "some dashboard data here",
        ]);
    }

/**
 * serverStatus
 *
 * Check this status before calling any api method.
 * If the status is not 'ready', dont proceed with it, show a modal
 *
 * Enum ('ready','maintenance','updating')
 */
    public function serverStatus()
    {
        return response()->json(config("app.mobile_app_status"));
    }

    /**
     * Change password
     *
     * Required: old and new passwords
     */
    public function setPassword(Request $request)
    {

        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        try {
            $user = User::find(auth()->user()->id);

            if (Hash::check($oldPassword, $user->password)) {
                $user->password = bcrypt($newPassword);
                $user->save();
                return response(["message" => "Password change success"]);
            } else {
                return response("Old password was wrong", 400);
            }

        } catch (Exception $ex) {
            return response("Password change Not success", 400);
        }

    }

    /**
     * forgotPasswordEmail
     *
     * If email found in the user table, send email with link to reset password
     */
    public function forgotPasswordEmail(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->firstOrFail();

            Mail::to($user->email)->send(new PasswordForgotMail());

            return response(["message" => "Please check your email for a password reset link. Follow the instructions."]);
        } catch (Exception $ex) {
            return response("Email not found", 401);
        }
    }
}
