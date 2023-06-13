<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();

        if ($student->count() == 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Data Masih Kosong!'
            ], 404);
        } else {
            return response()->json([
                'student' => $student,
                'status' => 200
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:200',
                'nim' => 'required|max:200',
                'email' => 'required|email:dns',
                'jurusan' => 'required|max:100'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        } else {
            $student =  Student::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil menambah data baru'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'something went wrong'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $findStudent = Student::find($id);
        if ($findStudent) {
            return response()->json([
                'status' => 200,
                'data' => $findStudent
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada Mahasiswa ini'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $findStudent = Student::find($id);
        if ($findStudent) {
            return response()->json([
                'status' => 200,
                'data' => $findStudent
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada Mahasiswa ini'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:200',
                'nim' => 'required|max:200',
                'email' => 'required|email:dns',
                'jurusan' => 'required|max:100'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        } else {
            $student = Student::find($id);
            if ($student) {
                $student->update([
                    'name' => $request->name,
                    'nim' => $request->nim,
                    'email' => $request->email,
                    'jurusan' => $request->jurusan,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengubah data mahasiswa'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'something went wrong'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menghapus data'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'something went wrong'
            ]);
        }
    }
}
