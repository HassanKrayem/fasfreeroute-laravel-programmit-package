<?php

namespace Programmit\Traits\General;

use Illuminate\Support\Facades\Hash;

trait SystemUser
{
    public function createSystemUser($request, $data)
    {
        $validatedData = $request->validate([
            'username' => 'sometimes|required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $userData = [
            'password' => Hash::make($request['password']),
            'email' => $request['email'],
            'user_profile_id' => $data['user_profile_id'],
            'user_account_status_id' => $data['user_account_status_id'],
            'money_balance' => $data['money_balance'],
            'account_status_message' => $data['account_status_message'],
            'verified_email' => $data['verified_email'],
        ];

        
        if ($request->input('username') != null && !empty($request->input('username'))) {
            $userData['username'] = $request['username'];
        }        
        
        $user = \App\User::create($userData);

         // sending user a confirmation email 
        return $user;
    }
}