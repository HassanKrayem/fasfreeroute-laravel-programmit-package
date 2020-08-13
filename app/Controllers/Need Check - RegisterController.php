<?php

namespace Programmit\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * @override
     * [showRegistrationForm description]
     * @return [view] [registration view ]
     */
    public function showRegistrationForm()
    {
        
        $userProfiles = \App\UserProfile::all();
        $genders = \App\UserGender::all();
        $data = [
            'userProfiles' => $userProfiles,
            'genders' => $genders,
        ];

        return view('auth.register', $data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $request)
    {
         $user = User::create([
            'username' => $request['username'],
            'user_profile_id' => $request['user_profile_id'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

         // dd($user, $user->id);
         
        if($this->createSystemUser($user, $request))
            return $user;

        return false; // we shouldn't get this far
    }


    protected function createSystemUser($user, $request)
    {
        $userPersonalInformation = null;

        // Skipping Root Profile
        if($request['user_profile_id'] != 1)
        {
            $userPersonalInformation = new \App\UserPersonalInformation;
            $userPersonalInformation->first_name = $request['first_name'];
            $userPersonalInformation->last_name = $request['last_name'];
            $userPersonalInformation->user_id = $user->id;
            $userPersonalInformation->user_gender_id = $request['user_gender_id'];
            $userPersonalInformation->save();
        }        

        $methodName = null;
        switch ($request['user_profile_id']) {
            case 1:
                $methodName = 'createNewRootUser'; break;
            case 2:
                $methodName = 'createNewTransportationSupportUser'; break;
            case 3:
                $methodName = 'createNewDriverUser'; break;
            case 4:
                $methodName = 'createNewPassengerUser'; break;
            case 5:
                $methodName = 'createNewClientUser'; break;
            case 6:
                $methodName = 'createNewTransportationOfficerUser'; break;
            case 7:
                $methodName = 'createNewPassengerSuperiorUser'; break;
            default:
                $methodName = 'error'; break;
        }

        if($methodName == 'error')
            return false;

        $userProfile = self::$methodName([
            'user' => $user,
            'request' => $request,
            'userPersonalInformation' => $userPersonalInformation
        ]);

        return $userProfile;
    }


     protected function createNewRootUser($bundle)
     {
        $profile = new \App\RootProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->title = $bundle['request']['first_name'];
        $profile->save();

        return $profile;
     }

     protected function createNewTransportationSupportUser($bundle)
     {
        $profile = new \App\TransportationSupporProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->user_personaL_information_id = $bundle['userPersonalInformation']->id;
        $profile->transportation_support_type_id = $bundle['request']['transportation_support_type_id'];
        $profile->support_language_id = $bundle['request']['support_language_id'];

        $profile->save();

        return $profile;
     }

     protected function createNewDriverUser($bundle)
     {
        $profile = new \App\DriverProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->user_personaL_information_id = $bundle['userPersonalInformation']->id;

        // photo file must be obtained from $bundle['request'] and stored then pass
        // the url of the stored file to $profile.
        
        $profile->driver_licence_photo_url = 'stored_profile_url'; // fixed and filled for demo
        $profile->save();

        return $profile;
     }


     protected function createNewPassengerUser($bundle)
     {
        $profile = new \App\PassengerProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->user_personaL_information_id = $bundle['userPersonalInformation']->id;
        $profile->client_id = $bundle['request']['client_id'];

        $profile->save();

        return $profile;
     }


     protected function createNewClientUser($bundle)
     {
        $profile = new \App\ClientProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->user_personaL_information_id = $bundle['userPersonalInformation']->id;
        $profile->label = $bundle['request']['label'];
        $profile->email = $bundle['request']['email'];
        $profile->business_type_id = $bundle['request']['business_type_id'];
        $profile->region = $bundle['request']['region'];
        $profile->address = $bundle['request']['address'];
        $profile->phone = $bundle['request']['phone'];

        $profile->save();
        return $profile;
     }


     protected function createNewTransportationOfficerUser($bundle)
     {
        $profile = new \App\TransportationOfficerProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->user_personaL_information_id = $bundle['userPersonalInformation']->id;

        $profile->save();
        return $profile;
     }


     protected function createNewPassengerSuperiorUser($bundle)
     {
        $profile = new \App\SuperiorProfile;
        $profile->user_id = $bundle['user']->id;
        $profile->client_id = $bundle['user']->id;
        $profile->user_personaL_information_id = $bundle['userPersonalInformation']->id;

        $profile->save();
        return $profile;
     }
}
