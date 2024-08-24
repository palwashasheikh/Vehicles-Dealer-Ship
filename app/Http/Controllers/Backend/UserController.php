<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($authUser);
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('backend.users.modal');
    }
    public function Dealershipcreate()
    {
        $dealer = [
            'id' => 1,
            'name' => 'Demo Dealership',
            'address' => '123 Demo Street',
            'city' => 'Demo City',
            'state' => 'Demo State',
            'zip_code' => '12345',
            'phone' => '123-456-7890',
            'email' => 'demo@dealership.com'
        ];
        return view('backend.dealers.form', ['dealer' => $dealer]);
    }
    public function DealersStore()
    {
        $dealer = [
            'id' => 1,
            'name' => 'Demo Dealership',
            'address' => '123 Demo Street',
            'city' => 'Demo City',
            'state' => 'Demo State',
            'zip_code' => '12345',
            'phone' => '123-456-7890',
            'email' => 'demo@dealership.com'
        ];
        return view('backend.dealers.form', ['dealer' => $dealer]);
    }

    public function Dealeredit($id)
    {
        $dealer = Dealer::findOrFail($id);
        return view('backend.dealers.form', compact('dealer'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
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

        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => 'user',
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
            $user->assignRole('user');

            DB::commit();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'User created successfully.',
            ], JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Debugging line
       
    
        $user = User::findOrFail($id); // This will throw an exception if no record is found
    
        return view('backend.users.modal', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => 'nullable|min:8|confirmed',
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
        
        try {
            $user = User::findOrFail($id);
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type' => 'user',
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
            if ($request->has('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            $this->assignPermissions($id, $request->permissions);
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'User updated successfully.',
            ], JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'success' => JsonResponse::HTTP_OK,
                'message' => 'User deleted successfully'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function dataTable(Request $request)
    {
        
        $users = User::where('user_type', 'user')->select('id','first_name','access_level')->orderBy('id', 'desc')->get();
        return Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $editUrl = route('users.edit', ['user' => $row->id]); // Pass the user id here
            $btn = '<button type="button" class="btn btn-sm btn-primary" data-act="ajax-modal" data-method="get"
                        data-action-url="' . $editUrl . '" data-title="Edit User">
                        <i class="ri-edit-2-fill"></i> Edit
                    </button>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public static function formatPermissions($permissions)
    {
        $permissionGroups = [];
        foreach ($permissions as $permission) {
            $permissionGroups[$permission->group][] = $permission;
        }
        return $permissionGroups;
    }
    public function assignPermissions($userId, $permission)
    {
        // Find the user by ID
        $user = User::findOrFail($userId);
        $permissions = Permission::whereIn('id',$permission)->pluck('name')->toArray();
        // Define the permissions you want to assign

        // Assign the permissions to the user
        foreach ($permissions as $permission) {
            $user->givePermissionTo($permission);
        }
    }
    
}
