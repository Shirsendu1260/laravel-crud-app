<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index(){
        // echo 'Test';
        $students = Student::orderBy('id', 'ASC')->paginate(5);

        return view('student.list', ['students' => $students]);
    }

    public function create(){
        // echo 'Create';
        return view('student.create');
    }

    public function store(Request $request){
        $data = array(
            'name' => 'required',
            'email' => 'required',
            'photo' => 'sometimes|image:jpg,jpeg,png' // Applied only when an user selects a .jpg or a .jpeg or a .png file
        );

        $validator = Validator::make($request->all(), $data);

        if($validator->passes()){
            // Save data in the database
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->address = $request->address;
            $student->save();

            // For uploading image (If the user uploads an image, it will execute otherwise not)
            if($request->photo){
                // Get file extension of the uploaded image
                $ext = $request->photo->getClientOriginalExtension();
                $currentDateTime = Carbon::now()->format('d_m_Y_H_i_s');
                $newFileName = $currentDateTime . '.' . $ext;

                // Move the image file to the specified path
                $request->photo->move(public_path() . '/uploads/students/', $newFileName);

                $student->photo = $newFileName;
                $student->save();
            }

            $request->session()->flash('success', 'Student added successfully.');

            return redirect()->route('students.index');
        }
        else{
            // Return with errors
            return redirect()->route('students.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $student = Student::findOrFail($id);

        // if(!$student){
        //     abort('404');
        // }
        // else{
        //     dd($student);
        // }

        return view('student.edit', ['student' => $student]);
    }

    public function update($id, Request $request){
        $data = array(
            'name' => 'required',
            'email' => 'required',
            'photo' => 'sometimes|image:jpg,jpeg,png' // Applied only when an user selects a .jpg or a .jpeg or a .png file
        );

        $validator = Validator::make($request->all(), $data);

        if($validator->passes()){
            // Save data in the database
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->address = $request->address;
            $student->save();

            // For uploading image (If the user uploads an image, it will execute otherwise not)
            if($request->photo){
                $oldFileName = $student->photo;

                // Get file extension of the uploaded image
                $ext = $request->photo->getClientOriginalExtension();
                $currentDateTime = Carbon::now()->format('d_m_Y_H_i_s');
                $newFileName = $currentDateTime . '.' . $ext;

                // Move the image file to the specified path
                $request->photo->move(public_path() . '/uploads/students/', $newFileName);

                $student->photo = $newFileName;
                $student->save();

                // Delete old photo record
                File::delete(public_path() . '/uploads/students/' . $oldFileName);
            }

            $request->session()->flash('success', 'Student updated successfully.');

            return redirect()->route('students.index');
        }
        else{
            // Return with errors
            return redirect()->route('students.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy($id, Request $request){
        $student = Student::findOrFail($id);

        // Delete old photo record
        File::delete(public_path() . '/uploads/students/' . $student->photo);

        $student->delete();

        $request->session()->flash('success', 'Student deleted successfully.');

        return redirect()->route('students.index');
    }
}
