<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Duration;
use App\Alert;
use App\Pf_calculation;
use App\Office;
use App\Department;
use App\Position;
use App\Time_schedule;
use App\Category;
use App\Base;
use App\Level;
use App\Sub_location;
use App\Work_place;
use App\Interest_source;
use App\User_role;
use Auth;
use DB;


class MasterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    // Category add edit update delete
    public function add_category()
    {
        return view('master_data.category.add_category');
    }

    public function save_category(Request $request)
    {
        $this->validate($request,[
            'category_name' => 'required',

        ]);

        $categories = new Category;
        $categories->category_name = $request->category_name;
        $categories->save(); 
        return redirect()->back()->with('success','Category Added Successfully!');
    }
    
    public function all_category()
    {   
        $categories = Category::all();
        return view('master_data.category.all_category',compact('categories'));
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
         return view('master_data.category.edit_category', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $this->validate($request,[
            'category_name' => 'required',

        ]);

        $categories = Category::find($id);
        $categories->category_name = $request->category_name;
        $categories->save(); 
        return redirect()->route('all-category')->with('success','Category Updated Successfully!');

    }

    public function delete_category($id)
    {
        $base_name = Category::find($id);
        $base_name->delete();
        return redirect()->back()->with('danger','Category Deleted Successfully!');
    }

    // level add edit update delete
    public function add_level()
    {
        return view('master_data.level.add_level');
    }

    public function save_level(Request $request)
    {
        $this->validate($request,[
            'level_name' => 'required',
            'level_description' => 'required',

        ]);

        $levels= new Level;
        $levels->level_name = $request->level_name;
        $levels->level_description = $request->level_description;
        $levels->save(); 
        return redirect()->back()->with('success','Level Added Successfully!');
    }
    
    public function all_level()
    {   
        $levels = Level::all();
        return view('master_data.level.all_level',compact('levels'));
    }

    public function edit_level($id)
    {
        $level = Level::find($id);
         return view('master_data.level.edit_level', compact('level'));
    }

    public function update_level(Request $request, $id)
    {
        $this->validate($request,[
            'level_name' => 'required',
            'level_description' => 'required',

        ]);

        $levels = Level::find($id);
        $levels->level_name = $request->level_name;
        $levels->level_description = $request->level_description;
        $levels->save(); 
        return redirect()->route('all-level')->with('success','Level Updated Successfully!');

    }

    public function delete_level($id)
    {
        $level = Level::find($id);
        $level->delete();
        return redirect()->back()->with('danger','Level Deleted Successfully!');
    }


    // sub location add edit update delete
    public function add_sub_location()
    {
        return view('master_data.sub_location.add_sub_location');
    }

    public function save_sub_location(Request $request)
    {
        $this->validate($request,[
            'sub_location_name' => 'required',
            'sub_location_description' => 'required',

        ]);

        $sub_locations= new Sub_location;
        $sub_locations->sub_location_name = $request->sub_location_name;
        $sub_locations->sub_location_description = $request->sub_location_description;
        $sub_locations->save(); 
        return redirect()->back()->with('success','Sub Location Added Successfully!');
    }
    
    public function all_sub_location()
    {   
        $sub_locations = Sub_location::all();
        return view('master_data.sub_location.all_sub_location',compact('sub_locations'));
    }

    public function edit_sub_location($id)
    {
        $sub_location = Sub_location::find($id);
         return view('master_data.sub_location.edit_sub_location', compact('sub_location'));
    }

    public function update_sub_location(Request $request, $id)
    {
        $this->validate($request,[
            'sub_location_name' => 'required',
            'sub_location_description' => 'required',

        ]);

        $sub_locations = Sub_location::find($id);
        $sub_locations->sub_location_name = $request->sub_location_name;
        $sub_locations->sub_location_description = $request->sub_location_description;
        $sub_locations->save(); 
        return redirect()->route('all-sub-location')->with('success','Sub Location Updated Successfully!');

    }

    public function delete_sub_location($id)
    {
        $sub_location = Sub_location::find($id);
        $sub_location->delete();
        return redirect()->back()->with('danger','Sub Location Deleted Successfully!');
    }

    // work place add edit update delete
    public function add_work_place()
    {
        return view('master_data.work_place.add_work_place');
    }

    public function save_work_place(Request $request)
    {
        $this->validate($request,[
            'work_place_name' => 'required',
            'work_place_description' => 'required',

        ]);

        $work_places= new Work_place;
        $work_places->work_place_name = $request->work_place_name;
        $work_places->work_place_description = $request->work_place_description;
        $work_places->save(); 
        return redirect()->back()->with('success','Work Place Added Successfully!');
    }
    
    public function all_work_place()
    {   
        $work_places = Work_place::all();
        return view('master_data.work_place.all_work_place',compact('work_places'));
    }

    public function edit_work_place($id)
    {
        $work_place = Work_place::find($id);
         return view('master_data.work_place.edit_work_place', compact('work_place'));
    }

    public function update_work_place(Request $request, $id)
    {
        $this->validate($request,[
            'work_place_name' => 'required',
            'work_place_description' => 'required',

        ]);

        $work_places = Work_place::find($id);
        $work_places->work_place_name = $request->work_place_name;
        $work_places->work_place_description = $request->work_place_description;
        $work_places->save(); 
        return redirect()->route('all-work-place')->with('success','Work Place Updated Successfully!');

    }

    public function delete_work_place($id)
    {
        $work_place = Work_place::find($id);
        $work_place->delete();
        return redirect()->back()->with('danger','Work Place Deleted Successfully!');
    }

 // Department add edit update delete
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
            'position_name' => 'required',
            'position_description' => 'required',
        ]);

        $positions = new Position;
        $positions->position_name = $request->position_name;
        $positions->position_description = $request->position_description;
        $positions->save(); 
        return redirect()->back()->with('success','Position Added Successfully!');
    }
    
    public function all_position()
    {   
        $positions = Position::all();
        return view('master_data.position.all_position',compact('positions'));
    }

    public function edit_position($id)
    {
        $position = Position::find($id);
         return view('master_data.position.edit_position', compact('position'));
    }

    public function update_position(Request $request, $id)
    {
        $positions = Position::find($id);
        $positions->position_name = $request->position_name;
        $positions->position_description = $request->position_description;
        $positions->save(); 
        return redirect()->route('all-position')->with('success','Position Updated Successfully!');

    }

    public function delete_position($id)
    {
        $position_name = Position::find($id);
        $position_name->delete();
        return redirect()->back()->with('danger','Position Deleted Successfully!');
    }


    // Base_name add update delete
    public function add_base()
    {
        return view('master_data.base.add_base');
    }

    public function save_base(Request $request)
    {
        $this->validate($request,[
            'base_name' => 'required',
            'base_description' => 'required',
        ]);

        $bases = new Base;
        $bases->base_name = $request->base_name;
        $bases->base_description = $request->base_description;
        $bases->save(); 
        return redirect()->back()->with('success','Base Added Successfully!');
    }
    
    public function all_base()
    {   
        $bases = Base::all();
        return view('master_data.base.all_base',compact('bases'));
    }

    public function edit_base($id)
    {
        $base = Base::find($id);
         return view('master_data.base.edit_base', compact('base'));
    }

    public function update_base(Request $request, $id)
    {
        $bases = Base::find($id);
        $bases->base_name = $request->base_name;
        $bases->base_description = $request->base_description;
        $bases->save(); 
        return redirect()->route('all-base')->with('success','Base Updated Successfully!');

    }

    public function delete_base($id)
    {
        $base_name = Base::find($id);
        $base_name->delete();
        return redirect()->back()->with('danger','Base Deleted Successfully!');
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
         $this->validate($request,[
            'start_date'      =>'required',
            'ending_date'  =>'required',
        ]);

         $time_schedules           = new Time_schedule;
         $time_schedules->start_date     = $request->start_date;
         $time_schedules->ending_date = $request->ending_date;
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
        $time_schedule = Time_schedule::find($id);
        return view('master_data.time_schedule.edit_time_schedule',compact('time_schedule'));
    }
 
    public function update_time_schedule(Request $request, $id){
        $this->validate($request,[
            'start_date'      =>'required',
            'ending_date'  =>'required',
        ]);

         $time_schedules = Time_schedule::find($id);
         $time_schedules->start_date     = $request->start_date;
         $time_schedules->ending_date = $request->ending_date;
         $time_schedules->save();

         return redirect()->route('all-time-schedule')->with('success', 'Time Schedule updated Successfully');
    }
 
    public function delete_time_schedule($id)
    {
     $duration = Time_schedule::find($id);
     $duration->delete();
     return redirect()->back()->with('danger','Time Schedule Deleted Successfully');
    }
// Employee status information
    public function add_employee_status()
    {
        return view('master_data.employee_status.add_employee_status');
    }

    public function save_employee_status(Request $request)
    {
        $this->validate($request,[
            'status_name'      =>'required',
            'description'  =>'required',
        ]);
        $data = array();
        $data['status_name'] = $request->status_name;
        $data['description'] = $request->description;
        $employee_status = DB::table('employee_status')->insert($data);
        return back()->with('success', 'Employee status added successfully.');
    }

    public function all_employee_status()
    {
        $all_employee_status = DB::table('employee_status')->get();
        return view('master_data.employee_status.all_employee_status',compact('all_employee_status'));
    }

    public function edit_employee_status($id)
    {   $employee_status = DB::table('employee_status')->where('id',$id)->first();
        return view('master_data.employee_status.edit_employee_status',compact('employee_status'));
    }

    public function update_employee_status(Request $request,$id)
    {
      
        $this->validate($request,[
            'status_name'      =>'required',
            'description'  =>'required',
        ]);
        $data = array();
        $data['status_name'] = $request->status_name;
        $data['description'] = $request->description;

        DB::table('employee_status')->where('id',$id)->update($data);

        return back()->with('success', 'Employee status updated successfully.');
    }

    public function delete_employee_status($id)
    {
        DB::table('employee_status')->where('id', $id)->delete();
        return redirect()->route('all-employee-status')->with('danger','Employee status deleted successfully.');
    }

    // interest source add update delete 
    public function add_interest_source()
    {
        return view('master_data.interest_source.add_interest_source');
    }
    public function save_interest_source(Request $request)
    {
         $this->validate($request,[
            'name'      =>'required',
            'description'      =>'required',
        ]);

         $interest_source         = new Interest_source;
         $interest_source->name   = $request->name;
         $interest_source->description   = $request->description;
         $interest_source->save();
 
         return redirect()->back()->with('success', 'Interest source added successfully');
    }
 
    public function all_interest_source()
    {
         $interest_sources = Interest_source::all();
         return view('master_data.interest_source.all_interest_source',compact('interest_sources'));
    }
 
    public function edit_interest_source($id)
    {
        $interest_source = Interest_source::find($id);
        return view('master_data.interest_source.edit_interest_source',compact('interest_source'));
    }
 
    public function update_interest_source(Request $request, $id){
        $this->validate($request,[
            'name'      =>'required',
            'description'      =>'required',
        ]);

         $interest_source = Interest_source::find($id);
         $interest_source->name   = $request->name;
         $interest_source->description   = $request->description;
         $interest_source->save();

         return redirect()->route('all-interest-source')->with('success', 'Interest source updated successfully');
    }
 
    public function delete_interest_source($id)
    {
     $interest_source = Interest_source::find($id);
     $interest_source->delete();
     return redirect()->back()->with('danger','Interest source deleted successfully');
    }

    
    // interest source add update delete 
    public function add_user_role()
    {
        return view('master_data.user_role.add_user_role');
    }
    public function save_user_role(Request $request)
    {
         $this->validate($request,[
            'role_name'         =>'required',
            'role_description'  =>'required',
            'value'             =>'required',
        ]);

         $user_roles         = new User_role;
         $user_roles->role_name   = $request->role_name;
         $user_roles->role_description   = $request->role_description;
         $user_roles->value   = $request->value;
         $user_roles->save();
 
         return redirect()->back()->with('success', 'User role added successfully');
    }
 
    public function all_user_role()
    {
         $user_roles = User_role::all();
         return view('master_data.user_role.all_user_role',compact('user_roles'));
    }
 
    public function edit_user_role($id)
    {
        $user_role = User_role::find($id);
        return view('master_data.user_role.edit_user_role',compact('user_role'));
    }
 
    public function update_user_role(Request $request, $id){
        $this->validate($request,[
            'role_name'         =>'required',
            'role_description'  =>'required',
            'value'             =>'required',
        ]);

         $user_roles = User_role::find($id);
         $user_roles->role_name   = $request->role_name;
         $user_roles->role_description   = $request->role_description;
         $user_roles->value   = $request->value;
         $user_roles->save();
         return redirect()->route('all-user-role')->with('success', 'User role updated successfully');
    }
 
    public function delete_user_role($id)
    {
     $user_role = User_role::find($id);
     $user_role->delete();
     return redirect()->back()->with('danger','User role deleted successfully');
    }
}
