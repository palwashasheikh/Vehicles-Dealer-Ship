<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Mail\InvitationMail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Mail;

class InvitationController extends Controller
{
    public function inviteForm()
    {
        // Get all roles
        $roles = Role::all();

        // Return the invitation form view with roles
        return view('invite', compact('roles'));
    }
    
    public function invite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->first(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $skill = ""; 
        if(!empty($request->skills))
        {
            $skills = json_decode($request->skills);
            if($skills)
            {
                $values = array_map(function($obj) {
                    return $obj->value;
                }, $skills);
                $skill = implode(',',$values);
            }
            
        }
        
        $token = Str::random(32);
        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'role' => $request->role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'status' => $request->status,
            'call_masking' => $request->call_masking,
            'color' => $request->color,
            'tech_option' => $request->tech_option,
            'note' => $request->note,
            'location' => $request->location,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'skills' => $skill,
        ]);
        Mail::to($request->email)->send(new InvitationMail($invitation));

        return redirect()->back()->with('success', 'Invitation sent successfully.');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        return view('auth.register', ['email' => $invitation->email,'first_name' => $invitation->first_name,'last_name' => $invitation->last_name, 'role' => $invitation->role]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $invitation = Invitation::where('token', $request->token)->firstOrFail();
        $data["email"] = $invitation->email;

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'token' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            // Redirect back with input and errors
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $invitation->email,
            'phone' => $invitation->phone,
            'password' => Hash::make($request->password),
            'user_type' => $invitation->role,
            'status' => $invitation->status,
            'call_masking' => $invitation->call_masking,
            'color' => $invitation->color,
            'tech_option' => $invitation->tech_option,
            'note' => $invitation->note,
            'location' => $invitation->location,
            'address' => $invitation->address,
            'city' => $invitation->city,
            'state' => $invitation->state,
            'zip_code' => $invitation->zip_code,
            'skills' => $invitation->skill,
        ]);
        $user->assignRole($invitation->role);
        DB::commit();
        Invitation::where('email', $data["email"])->delete();

        return redirect()->route('login')->with('success', 'Registration successful.');
    }
}

