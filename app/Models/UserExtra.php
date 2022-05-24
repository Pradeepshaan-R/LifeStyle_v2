<?php

namespace App\Models;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Auth\Models\User;

class UserExtra extends Model
{
    use HasFactory, Enums;
    public $timestamps = false;
    protected $roleService;

    protected $fillable = [
        'title',
        'phone',
        'nic',
        'designation',
        'address',
        'city',
        'theme',
        'settings',
        'user_id',
    ];

    protected $enumStatuses = [
        'Active', 'Disabled',
    ];

    protected $enumTitles = [
        'Mr', 'Ms', 'Mrs', 'Dr', 'Rev',
    ];

    protected $enumThemes = [
        1, 2,
    ];

    public static $rules = [
        'title' => 'required',
        // 'settings' => 'required',
        // 'user_id' => 'required',
    ];
    /**
     * Return settings for current user as an array
     * Replace this as per the project
     */
    public static $us = [
        "USER_SETTING1" => false,
        "USER_SETTING2" => true,
        "USER_SETTING3" => false,
    ];

    /**
     * get_current()
     *
     * UserExtra::get_current($user_id);
     */
    public static function get_current($user_id = null)
    {

        if ($user_id == null) {
            $user_id = auth()->user()->id;
        }
        $user_settings = UserExtra::firstOrNew(['user_id' => $user_id]);
        if ($user_settings->settings == null) {
            $user_settings->settings = serialize(UserExtra::$us);
            $user_settings->save();
        } else {
            UserExtra::$us = unserialize($user_settings->settings);
        }
        return UserExtra::$us;
    }

    /**
     * set_current()
     *
     * UserExtra::set_current('USER_SETTING1', true);
     */
    public static function set_current($user_settings)
    {
        if ($user_settings) {
            foreach (UserExtra::$us as $key => $val) {
                if (in_array($key, $user_settings)) {
                    UserExtra::$us[$key] = true;
                } else {
                    UserExtra::$us[$key] = false;
                }
            }
        }
        $user_setting = UserExtra::where('user_id', auth()->user()->id)->firstOrNew(['user_id' => auth()->user()->id]);
        $user_setting->settings = serialize(UserExtra::$us);
        $user_setting->save();
    }

    public function user()
    {
        return $this->hasOne('App\Domains\Auth\Models\User');
    }

    /** TODO: find the first role for a given user_id
     * https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage
     */
    public static function getRole($user_id)
    {
        // get the names of the user's roles
        $user = User::find($user_id);
        $roles = $user->getRoleNames(); // Returns a collection
        return $roles[0];
    }
}
