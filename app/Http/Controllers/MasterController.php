<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Duration;
use App\Alert;
use App\Pf_calculation;
use App\Office;
use App\Department;

class MasterController extends Controller
{

    public function add_department()
    {
        return view('master_data.department.add_department');
    }

    public function save_department(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'department_code' => 'required',
        ]);

        $department = new Department;
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->created_by = Auth::user()->id;
        $department->updated_by = Auth::user()->id;
        $department->save(); 
        return redirect()->back()->with('success','Department Added Successfully!');
    }
    
    public function all_department()
    {   
        $departments = Department::all();
        return view('master_data.department.all_department',compact('departments'));
    }

    public function edit_department($id)
    {
        $department = Department::find($id);
         return view('master_data.department.edit_department', compact('department'));
    }

    public function update_department(Request $request, $id)
    {
        $department = Department::find($id);
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->save(); 
        return redirect()->route('all-department')->with('success','Department Updated Successfully!');

    }

    public function delete_department($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->back();
    }
    // Position add update delete
    public function add_position()
    {
        return view('master_data.position.add_position');
    }

    public function save_position(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'position' => 'required',
        ]);

        $department = new Position;
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->created_by = Auth::user()->id;
        $department->updated_by = Auth::user()->id;
        $department->save(); 
        return redirect()->back()->with('success','position Added Successfully!');
    }
    
    public function all_position()
    {   
        $positions = Department::all();
        return view('master_data.position.all_position',compact('positions'));
    }

    public function edit_position($id)
    {
        $position = Position::find($id);
         return view('master_data.position.edit_department', compact('position'));
    }

    public function update_position(Request $request, $id)
    {
        $department = Position::find($id);
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->save(); 
        return redirect()->route('all-position')->with('success','Position Updated Successfully!');

    }

    public function delete_position($id)
    {
        $department = Position::find($id);
        $department->delete();
        return redirect()->back();
    }


   // duration add update delete 
   public function add_duration()
   {
       return view('master_data.duration.add_duration');
   }
   public function save_duration(Request $request)
   {
        $this->validate($request,[
            'name'      =>'required',
            'duration'  =>'required'
        ]);

        $durations           = new Duration;
        $durations->name     = $request->name;
        $durations->duration = $request->duration;
        $durations->save();

        return redirect()->back()->with('success', 'Duration Added Successfully');
   }

   public function all_duration()
   {
        $durations = Duration::all();
        return view('master_data.duration.all_duration',compact('durations'));
   }

   public function edit_duration($id)
   {
       $duration = Duration::find($id);
       return view('master_data.duration.edit_duration',compact('duration'));
   }

   public function update_duration(Request $request, $id){
    $this->validate($request,[
        'name'      =>'required',
        'duration'  =>'required'
    ]);

    $durations = Duration::find($id);
    $durations->name     = $request->name;
    $durations->duration = $request->duration;
    $durations->save();
    // $users->update($request->all());

    return redirect()->route('all-duration')->with('success', 'Duration updated Successfully');
   }

   public function delete_duration($id)
   {
    $duration = Duration::find($id);
    $duration->delete();
    return redirect()->back()->with('danger','Duration Deleted Successfully');
   }

   // office insert edit update delete..........
   public function add_office()
   {
       return view('master_data.office.add_office');
   }
   public function save_office(Request $request)
   {
        $this->validate($request,[
            'name'      =>'required',
            'duration'  =>'required',
            'office_code'  =>'required',
        ]);

        $durations           = new Office;
        $durations->name     = $request->name;
        $durations->duration = $request->duration;
        $durations->office_code = $request->office_code;
        $durations->save();

        return redirect()->back()->with('success', 'Office Added Successfully');
   }

   public function all_office()
   {
        $offices = Office::all();
        return view('master_data.office.all_office',compact('offices'));
   }

   public function edit_office($id)
   {
       $office = Office::find($id);
       return view('master_data.office.edit_office',compact('office'));
   }

   public function update_office(Request $request, $id){
    $this->validate($request,[
        'name'      =>'required',
        'duration'  =>'required',
        'office_code'  =>'required',
    ]);

        $offices                 = Office::find($id);
        $offices->name        = $request->name;
        $offices->duration    = $request->duration;
        $offices->office_code = $request->office_code;
        $offices->save();
        return redirect()->route('all-office')->with('success', 'Office updated Successfully');
   }

   public function delete_office($id)
   {
    $office = Office::find($id);
    $office->delete();
    return redirect()->back()->with('danger','Office Deleted Successfully');
   }

   // alert insert update delete..........
   public function add_alert()
   {
       return view('master_data.alert.add_alert');
   }
   public function save_alert(Request $request)
   {
        $this->validate($request,[
            'name'      =>'required',
            'alert_details'  =>'required'
        ]);

        $durations           = new Alert;
        $durations->name     = $request->name;
        $durations->alert_details = $request->alert_details;
        $durations->save();

        return redirect()->back()->with('success', 'Alert Added Successfully');
   }

   public function all_alert()
   {
        $alerts = Alert::all();
        return view('master_data.alert.all_alert',compact('alerts'));
   }

   public function edit_alert($id)
   {
       $alert = Alert::find($id);
       return view('master_data.alert.edit_alert',compact('alert'));
   }

   public function update_alert(Request $request, $id){
    $this->validate($request,[
        'name'      =>'required',
        'alert_details'  =>'required'
    ]);

    $alerts = Alert::find($id);
    $alerts->name     = $request->name;
    $alerts->alert_details = $request->alert_details;
    $alerts->save();
    // $users->update($request->all());

    return redirect()->route('all-duration')->with('success', 'Alert updated Successfully');
   }

   public function delete_alert($id)
   {
    $duration = Alert::find($id);
    $duration->delete();
    return redirect()->back()->with('danger','Alert Deleted Successfully');
   }

   // pf_calculations insert update delete..........

   public function add_pf_calculation()
   {
       return view('master_data.pf_calculation.add_pf_calculations');
   }
   public function save_pf_calculation(Request $request)
   {
        $this->validate($request,[
            'name'      =>'required',
            'own_pf'  =>'required',
            'organization_pf'  =>'required'
        ]);

        $durations                  = new Pf_calculation;
        $durations->name            = $request->name;
        $durations->own_pf          = $request->own_pf;
        $durations->organization_pf = $request->organization_pf;
        $durations->total_pf        = $request->own_pf+$request->organization_pf;
        $durations->save();

        return redirect()->back()->with('success', 'Pf_calculation Added Successfully');
   }

   public function all_pf_calculation()
   {
        $pf_calculation = Pf_calculation::all();
        return view('master_data.pf_calculation.all_pf_calculations',compact('pf_calculation'));
   }

   public function edit_pf_calculation($id)
   {
       $pf_calculation = Pf_calculation::find($id);
       return view('master_data.pf_calculation.edit_pf_calculations',compact('pf_calculation'));
   }

   public function update_pf_calculation(Request $request, $id){
    $this->validate($request,[
        'name'      =>'required',
        'own_pf'  =>'required',
        'organization_pf'  =>'required'
    ]);

    $pf_calculations                  = pf_calculation::find($id);
    $pf_calculations->name            = $request->name;
    $pf_calculations->own_pf          = $request->own_pf;
    $pf_calculations->organization_pf = $request->organization_pf;
    $pf_calculations->total_pf        = $request->own_pf+$request->organization_pf;
    $pf_calculations->save();

    return redirect()->route('all-pf-calculation')->with('success', 'Pf_calculation updated Successfully');
   }

   public function delete_pf_calculation($id)
   {
    $pf_calculation = Pf_calculation::find($id);
    $pf_calculation->delete();
    return redirect()->route('all-pf-calculation')->with('danger','Pf_calculation Deleted Successfully');
   }

    // time schedule add update delete 
    public function add_time_schedule()
    {
        return view('master_data.time_schedule.add_time_schedule');
    }
    public function save_time_schedule(Request $request)
    {
        
         $time_schedules           = new Duration;
         $time_schedules->start_date     = $request->name;
         $time_schedules->ending_date = $request->duration;
         $time_schedules->save();
 
         return redirect()->back()->with('success', 'Time Schedule Added Successfully');
    }
 
    public function all_time_schedule()
    {
         $time_schedules = Time_schedule::all();
         return view('master_data.time_schedule.all_time_schedule',compact('time_schedules'));
    }
 
    public function edit_time_schedule($id)
    {
        $time_schedules = Time_schedule::find($id);
        return view('master_data.time_schedule.edit_time_schedule',compact('time_schedules'));
    }
 
    public function update_time_schedule(Request $request, $id){
     $this->validate($request,[
         'name'      =>'required',
         'duration'  =>'required'
     ]);
 
     $durations = Time_schedule::find($id);
     $durations->name     = $request->name;
     $durations->duration = $request->duration;
     $durations->save();
     return redirect()->route('all-duration')->with('success', 'Time Schedule updated Successfully');
    }
 
    public function delete_time_schedule($id)
    {
     $duration = Time_schedule::find($id);
     $duration->delete();
     return redirect()->back()->with('danger','Time Schedule Deleted Successfully');
    }
}
