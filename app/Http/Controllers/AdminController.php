<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function addview()
    {
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                return view('admin.add_doctor');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        }
        
    }

    public function upload(Request $request)
    {
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                $doctor=new doctor;

                $image=$request->file;
                $imagename=time().'.'.$image->getClientoriginalExtension();

                $request->file->move('doctorimage', $imagename);
                $doctor->image=$imagename;

                $doctor->name=$request->name;
                $doctor->phone=$request->number;
                $doctor->room=$request->room;
                $doctor->speciality=$request->speciality;

                $doctor->save();
                return redirect()->back()->with('message', 'Doctor Added Successfully!');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function showappointment(){

        if(Auth::id()){
            if(Auth::user()->usertype==1){
                $data=appointment::all();

                return view('admin.showappointment', compact('data'));
            }
            else{
                return redirect()->back();
            }
        }   
        else{
            return redirect('login');

        }
    }

    public function approved($id){
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                $data=appointment::find($id);
                $data->status='approved';
                $data->save();

                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function cancelled($id){
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                $data=appointment::find($id);
                $data->status='cancelled';
                $data->save();

                return redirect()->back();
            }
            else{
                return redirect()->back();
             }
        }
        else{
            return redirect('login');

        }
    }

    public function showdoctor(){
        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $data=doctor::all();
                return view('admin.showdoctor', compact('data'));
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }

    }

    public function delete_doctor($id){
        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $data=doctor::find($id);
                $data->delete();

                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function updatedoctor($id){

        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $data=doctor::find($id);

                return view('admin.update_doctor', compact('data'));
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }

        
    }

    public function editdoctor(Request $request, $id){

        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $doctor=doctor::find($id);

                $doctor->name=$request->name;
                $doctor->phone=$request->phone;
                $doctor->speciality=$request->speciality;
                $doctor->room=$request->room;

                $image=$request->file;

                if($image){
                    $imagename=time().'.'.$image->getClientoriginalExtension();

                    $request->file->move('doctorimage', $imagename);

                    $doctor->image=$imagename;
                }

                $doctor->save();
                return redirect()->back()->with('message', 'Doctor detailed updated successfully!');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function emailview($id){

        $data=appointment::find($id);

        return view('admin.email_view', compact('data'));
    }

    public function sendemail(Request $request, $id)
    {
        $data=appointment::find($id);
        $details=[
            'greeting'=> $request->greeting,
            'body'=>$request->body,
            'actiontext'=>$request->actiontext,
            'actionurl'=>$request->actionurl,
            'endpart'=>$request->endpart
        ];

        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back()->with('message','Email Send is successful');
    }

    public function add_staff()
    {
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                return view('admin.add_staff');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        }
        
    }

    public function upload_staff(Request $request)
    {
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                $staff=new staff;

                $image=$request->file;
                $imagename=time().'.'.$image->getClientoriginalExtension();

                $request->file->move('staffimage', $imagename);
                $staff->image=$imagename;

                $staff->name=$request->name;
                $staff->phone=$request->number;
                $staff->nid=$request->nid;
                $staff->designation=$request->designation;
                $staff->address=$request->address;

                $staff->save();
                return redirect()->back()->with('message', 'Staff Added Successfully!');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function show_staff(){
        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $data=staff::all();
                return view('admin.show_staff', compact('data'));
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }

    }

    public function delete_staff($id){
        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $data=staff::find($id);
                $data->delete();

                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function updatestaff($id){

        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $data=staff::find($id);

                return view('admin.update_staff', compact('data'));
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }

    public function editstaff(Request $request, $id){

        if(Auth::id()){
            if(Auth::user()->usertype==1){

                $staff=staff::find($id);

                $staff->name=$request->name;
                $staff->phone=$request->phone;
                $staff->designation=$request->designation;
                //$staff->nid=$request->nid;
                $staff->address=$request->address;

                $image=$request->file;

                if($image){
                    $imagename=time().'.'.$image->getClientoriginalExtension();

                    $request->file->move('staffimage', $imagename);

                    $staff->image=$imagename;
                }

                $staff->save();
                return redirect()->back()->with('message', 'Staff detailed updated successfully!');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        
        }
    }
}