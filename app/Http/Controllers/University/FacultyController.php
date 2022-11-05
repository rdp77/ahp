<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\FacultyRequest;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
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
     * @return Renderable
     */

    public function index(Request $req)
    {
        if ($req->ajax()) {
            $data = Faculty::all();
            return Datatables::of($data)
                ->addIndexColumn()
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

        return view('pages.backend.data.master.faculty.indexFaculty');
    }

    public function store(FacultyRequest $req)
    {
        $performedOn = Faculty::create($req->all());

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(20),
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
        return view('pages.backend.data.master.faculty.updateFaculty', compact('faculty',));
    }

    public function update($id, FacultyRequest $req)
    {
        Faculty::where('id', $id)
            ->update($req->except('_token', '_method'));

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(21),
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
            $this->getStatus(22),
            false
        );

        return Response::json(['status' => 'success']);
    }

    public function recycle(Request $req)
    {
        if ($req->ajax()) {
            $data = Faculty::onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button onclick="restore(' . $row->id . ')" class="btn btn btn-primary
                btn-action mb-1 mt-1 mr-1">Kembalikan</button>';
                    $actionBtn .= '<button onclick="delRecycle(' . $row->id . ')" class="btn btn-danger
                    btn-action mb-1 mt-1">Hapus</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.backend.data.master.faculty.recycleFaculty');
    }

    public function restore($id, Request $req)
    {
        Faculty::onlyTrashed()
            ->where('id', $id)
            ->restore();

        $faculty = Faculty::find($id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(29),
            true,
            $faculty
        );
        return Response::json(['status' => 'success']);
    }

    public function delete($id, Request $req)
    {
        Faculty::onlyTrashed()
            ->where('id', $id)
            ->forceDelete();

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(30),
            false
        );

        return Response::json(['status' => 'success']);
    }

    public function deleteAll(Request $req)
    {
        $faculty = Faculty::onlyTrashed()
            ->forceDelete();

        if ($faculty == 0) {
            return Response::json([
                'status' => 'error',
                'data' => "Tidak ada data di recycle bin"
            ]);
        }

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(31),
            false
        );

        return Response::json(['status' => 'success']);
    }
}
