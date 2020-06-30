<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\InfoUser;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $us = [
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol_id' => $data['rol_id'],
        ];
        if ($curr = User::create($us)){
            $id = $curr->id;
            $in_us = [
                'user_id' => $id,
                'birthday' => $data['birthday'],
                'genre' => $data['genre'],
                'phone' => $data['phone'],
            ];
            if($curr_in = InfoUser::create($in_us)){
                $WL = [
                    'user_id'=> $id
                ];
                if(WishList::create($WL)){
                    $SC = [
                        'user_id'=> $id,
                        'status'=> true
                    ];
                    if(ShoppingCart::create($SC)){
                        return 200;
                    }
                }
                
            }

        }else{
            return 'Alguo salió mal';
        }
    }
}
