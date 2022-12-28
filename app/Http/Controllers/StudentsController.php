<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use DataTables;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //view student page
    public function viewStudents()
    {
        return view('students.view');
    }

    //view student by registered date
    public function viewStudentsByDate()
    {
        $studentsQuery = Students::query();
        $date = (!empty($_REQUEST["date"])) ? ($_REQUEST["date"]) : ('');
        if ($date) {
            //format date
            $date = date('Y-m-d', strtotime($date));
            //query for student filter with date
            $studentsQuery->whereRaw("date(students.created_at) = '" . $date . "'");
        } 
        $students = $studentsQuery->select('id', 'name', 'roll_no', 'age', 'created_at')->get();
        return datatables()->of($students)
            //edit column(change format of data)
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('Y-m-d');
            })
            ->make(true);
    }

    //add student page
    public function addStudentView()
    {
        return view('students/add');
    }

    //add student
    public function addStudent()
    {
        $validator = validator(request()->all(), [
            //require,max length and special character validation of name field
            'name' => 'required|max:50|not_regex:/[!@#$%^&*()_+\-=\[\]{};,<>\/?]+/',
            'age' => 'required|numeric|min:16|max:30',
            // require,unique and format validation of roll-no field
            'roll_no' => array('required', 'unique:students', 'regex:/^([1-5]+)([IS]+)([-]+)([0-9]{1,4})$/')
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

    //delete student page
    public function deleteStudentView(Request $request)
    {
        if ($request->ajax()) {
            $data = Students::select('id', 'name', 'roll_no', 'age', 'created_at')->get();
            return Datatables::of($data)->addIndexColumn()
                //add column for delete button
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" id="' . $row->id . '" class="btn btn-danger btn-sm delete" ><i class="bi bi-trash3"></i></button>';
                    return $btn;
                })
                //edit column(format date)
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('Y-m-d');
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('students.delete');
    }

    //delete student
    public function deleteStudent(Request $request)
    {
        $student = Students::find($request->id);
        $student->delete();
        return response()->json([
            'student' => $student
        ]);
    }

    //update student page
    public function updateStudentView()
    {
        $data = Students::all();
        return view('students/update', ["students" => $data]);
    }

    //update student
    public function updateStudent(Request $request)
    {
        $validator = validator(request()->all(), [
             //require,max length and special character validation of name field
            'name' => 'required|max:50|not_regex:/[!@#$%^&*()_+\-=\[\]{};,<>\/?]+/',
            'age' => 'required|numeric|min:16|max:30',
             // require,unique and format validation of roll-no field
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

    //get student by roll no
    public function getStudentByRollNo(Request $request)
    {
        $data = Students::filter($request->all())->get();
        return response()->json([
            'student' => $data
        ]);
    }
}
