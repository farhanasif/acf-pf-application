<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Duration;
use App\Alert;
use App\Pf_calculation;

class MasterController extends Controller
{
   
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
}
