<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees =Employee::query()
            ->with('company:id,name,user_id')
            ->orderByDesc('id');

        if(auth()->user()->is_admin == 0){
            $employees->whereHas('company',function($q){
                $q->where('user_id',auth()->user()->id);
            });
        }
        return view('employees.index',[
            'employees' => $employees->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create',[
            'companies' => Company::select('id','name','user_id')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company
        ]);

        if($request->has('avatar')){
            $path = $request->file('avatar')->store('avatars/'.auth()->user()->id,'public');
            $employee->update([
                'avatar_path' => $path
            ]);
        }

        return redirect()->route('employees.index')->with('success','Successfully Employee Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        if (!Gate::allows('employees', $employee)) {
            abort(403);
        }
        return view('employees.edit',[
            'employee' => $employee,
            'companies' => Company::select('id','name','user_id')
                    ->orderByDesc('id')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        if (!Gate::allows('employees', $employee)) {
            abort(403);
        }
        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company
        ]);

        return redirect()->back()->with('success','Successfully Employee Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if (!Gate::allows('employees', $employee)) {
            abort(403);
        }
        $employee->delete();

        return redirect()->back()->with('success','Successfully Employee Deleted');
    }

    public function updateAvatar($id, UpdateAvatarRequest $request)
    {
        $employee = Employee::findOrfail($id);
        if (!Gate::allows('employees', $employee)) {
            abort(403);
        }
        if($request->has('avcatar')){
            if($employee->avatar_path){
                Storage::disk('public')->delete($employee->avatar_path);
            }
            $path = $request->file('avatar')->store('avatars/'.$employee->user_id);
            $employee->update([
                'avatar_path' => $path
            ]);
        }
        return redirect()->back()->with('success','Successfully Employee Avatar Updated');
    }

    public function companyEmployess($id)
    {
        $employees = Employee::query()
            ->where('company_id', $id)
            ->with('company:id,name,user_id')
            ->orderByDesc('id')
            ->paginate(15);
        return view('employees.index',[
            'employees' => $employees
        ]);
    }
}
