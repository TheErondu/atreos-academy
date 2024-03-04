<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Employee;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = User::all();
        return view('dashboard.admin.employees.index',compact('employees'));
    }


    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $status = array(
            'inactive','active',
        );
        return view('dashboard.admin.employees.create',compact('status','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'roles'           => 'required'
        ]);

        $employee = new User();
        $employee->name     = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = Hash::make($request->input('password'));
        $employee->role = $request->input('roles');
        $employee->assignRole($request->input('roles'));
        $employee->save();
        $request->session()->flash('message', 'Successfully added User');

        return redirect()->route('employees.index');
    }


    public function show($id)
    {
        $employee  = User::find($id);

        return view('dashboard.admin.employees.show',compact('employee'));
    }


    public function edit( $id)
    {
        $employee  = Employee::find($id);
        $roles = Role::all();
        $status = array(
            'inactive','active',
        );
        return view('dashboard.admin.employees.edit',compact('employee','status','roles'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'             => 'required',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id),],
        ]);

        $employee = User::find($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $employee->assignRole($request->input('roles'));
        $employee->name     = $request->input('name');
        $employee->email = $request->input('email');
        $employee->role = $request->input('roles');
        $employee->save();

        $request->session()->flash('message', 'Successfully Updated User info');

        return redirect()->route('employees.index');
    }

    public function resetpass(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reset_password'             => 'required',
        ]);

        $employee = User::find($id);
        $email = $employee->email;
        $newpassword = $request->input('reset_password');
        Mail::to($email)->send( new \App\Mail\ResetPass($newpassword));
        $employee->password = Hash::make($request->input('reset_password'));
        $employee->save();
        $request->session()->flash('message', 'Password Reset!');

        return redirect()->route('employees.index');
    }

    public function showImportForm()
    {
        return view('dashboard.admin.employees.import.form');
    }

    public function importUsers()
    {
        try {
            $importedUsers = Excel::toCollection(new UsersImport(), request()->file('file'))->first();
            //dd($importedUsers);
            Session::put('importedUsers', $importedUsers);

            return view('dashboard.admin.employees.import.preview', compact('importedUsers'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Error'=> 'Error importing users: ' . $e->getMessage()]);
        }
    }

    public function saveUsers()
    {
        try {
            $importedUsers = Session::get('importedUsers');

            if (!$importedUsers) {
                return redirect()->back()->with('error', 'No users to save. Please import users first.');
            }

            foreach ($importedUsers as $userData) {
               $user = User::create([
                    'name'     => $userData['name'],
                    'email'    => $userData['email'],
                    'password' => bcrypt($userData['password']),
                    'role'     => $userData['role'],
                ]);
                $user->assignRole($userData['role']);
            }

            Session::forget('importedUsers');

            return redirect()->route('employees.index')->with('success', 'Users imported and saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Error'=> 'Error importing users: ' . $e->getMessage()]);
        }
    }


    public function destroy(Employee $employee)
    {
        //
    }
}
