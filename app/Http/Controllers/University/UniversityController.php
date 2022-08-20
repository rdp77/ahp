<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\UniversityRequest;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class UniversityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $req)
    {
        if ($req->ajax()) {
            $data = University::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-icon btn-primary btn-block m-1"';
                    $actionBtn .= 'href="' . route('university.edit', $row->id) . '"><i class="far fa-edit"></i></a>';
                    $actionBtn .= '<a onclick="del(' . $row->id . ')" class="btn btn-icon btn-danger btn-block m-1"';
                    $actionBtn .= 'style="cursor:pointer;color:white"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.backend.data.university.indexUniversity');
    }

    public function store(UniversityRequest $req)
    {
        $performedOn = University::create($req->all());

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(13),
            true,
            University::find($performedOn->id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat universitas baru'
        ]);
    }

    public function edit($id)
    {
        $university = University::find($id);
        return view('pages.backend.data.university.updateUniversity', compact('university'));
    }

    public function update($id, UniversityRequest $req)
    {
        University::where('id', $id)
            ->update($req->except('_token', '_method'));

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(14),
            true,
            University::find($id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah universitas'
        ]);
    }

    public function destroy(Request $req, $id)
    {
        $university = University::find($id);

        $university->delete();

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(16),
            false
        );

        return Response::json(['status' => 'success']);
    }

    public function list(Request $req)
    {
        if ($req->ajax()) {
            $data = University::with('faculty', 'major')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('university', function ($row) {
                    return $row->name;
                })
                ->addColumn('faculty', function ($row) {
                    $facultyDatas = '';
                    foreach ($row->faculty as $faculty) {
                        $facultyDatas .= '<span class="badge badge-info mr-1">' . $faculty->name . '</span>';
                    }
                    return $facultyDatas;
                })
                ->addColumn('major', function ($row) {
                    $majorDatas = '';
                    foreach ($row->major as $major) {
                        $majorDatas .= '<span class="badge badge-info mr-1">' . $major->name . '</span>';
                    }
                    return $majorDatas;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-icon btn-primary btn-block m-1"';
                    $actionBtn .= 'href="' . route('university.all.edit', $row->id) . '"><i class="far fa-edit"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'faculty', 'major'])
                ->make(true);
        }

        return view('pages.backend.data.university.allUniversity');
    }

    public function editList($id)
    {
        $university = University::findorFail($id);
        $faculty = Faculty::all();
        $major = Major::all();

        return view('pages.backend.data.university.updateAllUniversity', compact(
            'university',
            'faculty',
            'major'
        ));
    }

    public function updateList($id, Request $req)
    {
        $university = University::findorFail($id);

        $university->faculty()->sync($req->faculty);
        $university->major()->sync($req->major);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(15),
            true,
            University::find($id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah universitas ' . $university->name
        ]);
    }
}
