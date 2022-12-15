<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use DataTables;

class StudentsController extends Controller
{
    public function view_student_list(Request $request)
    {
        if ($request->ajax()) {
            $data = Students::select('id', 'name', 'roll_no', 'age','created_at')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" id="'.$row->id.'" class="btn btn-primary btn-sm delete" >Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('students.view_student');
    }

    public function delete_student_list()
    {
        $data = Students::all();
        return view('students.delete_student', ["students" => $data]);
    }
    public function add()
    {
        return view('students/add_student');
    }
    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'age' => 'required|numeric|min:16|max:30',
            'roll_no' => 'required|unique:students',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $student = new Students;
        $student->name = request()->name;
        $student->age = request()->age;
        $student->roll_no = request()->roll_no;
        $student->save();
        return redirect('/students/view')->with('info', Lang::get('public.successful_added'));
    }
    public function delete(Request $request)
    {
        $student = Students::find($request->id);
        $student->delete();
        return response()->json([
            'student' => $student
        ]);
      
    }
    public function edit()
    {
        $data = Students::all();
        return view('students/update_student', ["students" => $data]);
    }
    public function getStudentByRollNo(Request $request)
    {
        $data = Students::filter($request->all())->get();
        return response()->json([
            'student' => $data
        ]);
    }
    public function update(Request $request)
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'age' => 'required|numeric|min:16|max:30',
            'roll_no' => 'required|unique:students',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $student = Students::find($request->roll_no);
        $student->name = request()->name;
        $student->age = request()->age;
        $student->update();
        return redirect('/students/view')->with('info', Lang::get('public.successful_updated'));
    }
    public function getStudentByCreatedDate(Request $request)
    {
        $data = Students::filter($request->all())->get();
        return response()->json([
            'student' => $data
        ]);
    }
}
