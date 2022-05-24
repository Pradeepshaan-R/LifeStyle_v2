<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\UserExtra;
use DB;
use Hash;
use Log;
use Illuminate\Http\Request;

class UserExtraController extends Controller
{

    protected $userService;
    protected $roleService;
    protected $permissionService;
    protected $roles;

    /**
     * UserController constructor.
     *
     * @param  UserService  $userService
     * @param  RoleService  $roleService
     * @param  PermissionService  $permissionService
     */
    public function __construct(UserService $userService, RoleService $roleService, PermissionService $permissionService)
    {
        //$this->authorizeResource(UserExtra::class);
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        $this->roles = Role::orderBy('id', 'desc')->where('id', '>', 2)->get(); //get a list of roles for drop-downs, but dont show Admin and landlord roles
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $status = $request->status;
        $role = $request->role;

        //dont show super admin and landlord
        $user_list = User::select('users.id', 'users.name', 'users.email', 'users.active', 'ue.phone')->where('users.id','>',2)
            ->leftJoin('user_extras as ue', 'ue.user_id', 'users.id');

        if ($name) {
            $user_list = $user_list->where("name", "LIKE", '%' . $name . '%');
        }
        if ($status && $status != -1) {
            $active = '0';
            if ($status == 'Active') {$active = '1';}
            $user_list = $user_list->where("active", $active);
        }

        if ($role) {
            $user_list = $user_list->join('model_has_roles as mr', 'mr.model_id', 'users.id')
                ->join('roles as r', 'r.id', 'mr.role_id')
                ->where('r.name', $role);
        }

        $user_list = $user_list->paginate(config('app.pagination'));
        return view('backend.user_extra.list', ['user_list' => $user_list, 'name' => $name, 'oldStatus' => $status, 'roles' => $this->roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        return view('backend.user_extra.create', ['roles' => $this->roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, UserExtra::$rules);

        DB::beginTransaction();
        try {
            //save primary user data
            $data = array('type' => User::TYPE_ADMIN, 'name' => $request->name, 'email' => $request->email,
                'password' => $request->password, 'active' => '1');
            $user = $this->userService->store($data);

            //save user-extra data
            $user_extra = new UserExtra();
            $user_extra->title = $request->title;
            $user_extra->phone = $request->phone;
            $user_extra->nic = $request->nic;
            $user_extra->designation = $request->designation;
            $user_extra->address = $request->address;
            $user_extra->city = $request->city;
            $user_extra->user_id = $user->id;
            $user_extra->save();

            //assign STAFF role
            User::find($user->id)->assignRole($request->role);

            DB::commit();
            $this->message = 'Adding Successful';

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }

        return redirect('admin/user_extra')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function show(UserExtra $userExtra)
    {
        try {
            $user = User::where('id', $userExtra->user_id)->firstOrFail();
            $user->role = UserExtra::getRole($userExtra->user_id);
            return view('backend.user_extra.view', ['userExtra' => $userExtra, 'roles' => $this->roles, 'user' => $user]);
        } catch (Exception $ex) {
            return redirect('admin/user_extra')->withFlashSuccess("Bad user id.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExtra $userExtra)
    {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserExtra $userExtra)
    {
        //dd($request);

        $validatedData = $this->validate($request, UserExtra::$rules);
        DB::beginTransaction();
        try {
            // user primary update
            $user = User::where('id', $userExtra->user_id)->firstOrFail();
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            if ($request->name) {
                $user->name = $request->name;
            }
            $user->save();

            //update role
            User::find($user->id)->assignRole($request->role);

            //User::updateOrCreate(['id' => $userExtra->user_id], ['name' => $request->name, 'password' => $password]);

            // user extra data update

            if ($request->title) {
                $userExtra->title = $request->title;
            }
            if ($request->designation) {
                $userExtra->designation = $request->designation;
            }
            if ($request->phone) {
                $userExtra->phone = $request->phone;
            }
            if ($request->nic) {
                $userExtra->nic = $request->nic;
            }
            if ($request->address) {
                $userExtra->address = $request->address;
            }
            if ($request->city) {
                $userExtra->city = $request->city;
            }

            $userExtra->save();

            UserExtra::updateOrCreate(['user_id' => $userExtra->user_id], ['title' => $request->title, 'designation' => $request->designation, 'phone' => $request->phone, 'nic' => $request->nic, 'address' => $request->address, 'city' => $request->city]);

            DB::commit();
            $this->message = 'Update Successful';

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/user_extra')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExtra $userExtra)
    {
        // dd($id);
        try {
            UserExtra::where('user_id', $userExtra->user_id)->delete();
            User::where('id', $userExtra->user_id)->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/user_extra')->withFlashInfo($this->message);

    }

    /**
     * settings_get
     *
     * Show user settings screen
     */
    public function user_settings_get()
    {
        return view('backend.customuser.settings');
    }

    /**
     * settings_set
     *
     * Store user settings
     */
    public function user_settings_set()
    {
        $user_settings = [];
        UserExtra::set_current($user_settings);
        return redirect('admin/user_settings')->withFlashSuccess('User settings updated.');
    }
}
