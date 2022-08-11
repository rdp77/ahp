<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\FacultyRequest;
use App\Models\Faculty;
use App\Models\University;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class FacultyController extends Controller
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
        $university = University::all();
        if ($req->ajax()) {
            $data = Faculty::with('university')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('university', function ($row) {
                    return $row->university->name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-icon btn-primary btn-block m-1"';
                    $actionBtn .= 'href="' . route('faculty.edit', $row->id) . '"><i class="far fa-edit"></i></a>';
                    $actionBtn .= '<a onclick="del(' . $row->id . ')" class="btn btn-icon btn-danger btn-block m-1"';
                    $actionBtn .= 'style="cursor:pointer;color:white"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.backend.data.university.faculty.indexFaculty', compact('university'));
    }

    public function store(FacultyRequest $req)
    {
        $performedOn = Faculty::create($req->all());

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(3),
            true,
            Faculty::find($performedOn->id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat fakultas baru'
        ]);
    }

    public function edit($id)
    {
        $faculty = Faculty::find($id);
        $university = University::all();
        return view('pages.backend.data.university.faculty.updateFaculty', compact('faculty', 'university'));
    }

    public function update($id, Request $req)
    {
        $count = count($req->input('university_id'));
        if ($count > 1) {
            foreach ($req->input('university_id') as $university) {
                $performedOn = Faculty::create(
                    $req->except('university_id') + ['university_id' => $university]
                );
                // Create Log
                $this->createLog(
                    $req->header('user-agent'),
                    $req->ip(),
                    $this->getStatus(3),
                    true,
                    Faculty::find($performedOn->id)
                );
            }
        } else {
            Faculty::where('id', $id)
                ->update(
                    [$req->except('_token', '_method') + ['university_id' => $req->university_id[0]]]
                );
            // Create Log
            $this->createLog(
                $req->header('user-agent'),
                $req->ip(),
                $this->getStatus(3),
                true,
                Faculty::find($performedOn->id)
            );
        }

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(3),
            true,
            Faculty::find($id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah fakultas'
        ]);
    }

    public function destroy(Request $req, $id)
    {
        $faculty = Faculty::find($id);

        $faculty->delete();

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(5),
            false
        );

        return Response::json(['status' => 'success']);
    }
}