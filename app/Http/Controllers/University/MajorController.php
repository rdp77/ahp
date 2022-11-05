<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\MajorRequest;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class MajorController extends Controller
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
            $data = Major::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-icon btn-primary btn-block m-1"';
                    $actionBtn .= 'href="' . route('major.edit', $row->id) . '"><i class="far fa-edit"></i></a>';
                    $actionBtn .= '<a onclick="del(' . $row->id . ')" class="btn btn-icon btn-danger btn-block m-1"';
                    $actionBtn .= 'style="cursor:pointer;color:white"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('order', function ($row) {
                    return '<span class="badge badge-dark">' . $row->order . '</span>';
                })
                ->rawColumns(['action', 'order'])
                ->make(true);
        }

        return view('pages.backend.data.master.major.indexMajor');
    }

    public function store(MajorRequest $req)
    {
        $performedOn = Major::create($req->all());

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(26),
            true,
            Major::find($performedOn->id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat Jurusan'
        ]);
    }

    public function edit($id)
    {
        $major = Major::find($id);
        return view('pages.backend.data.master.major.updateMajor', compact('major'));
    }

    public function update($id, MajorRequest $req)
    {
        Major::where('id', $id)
            ->update($req->except('_token', '_method'));

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(27),
            true,
            Major::find($id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah Jurusan'
        ]);
    }

    public function destroy(Request $req, $id)
    {
        $major = Major::find($id);

        $major->delete();

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(28),
            true,
            $major
        );

        return Response::json(['status' => 'success']);
    }

    public function recycle(Request $req)
    {
        if ($req->ajax()) {
            $data = Major::onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button onclick="restore(' . $row->id . ')" class="btn btn btn-primary
                btn-action mb-1 mt-1 mr-1">Kembalikan</button>';
                    $actionBtn .= '<button onclick="delRecycle(' . $row->id . ')" class="btn btn-danger
                    btn-action mb-1 mt-1">Hapus</button>';
                    return $actionBtn;
                })
                ->addColumn('order', function ($row) {
                    return '<span class="badge badge-dark">' . $row->order . '</span>';
                })
                ->rawColumns(['action', 'order'])
                ->make(true);
        }
        return view('pages.backend.data.master.major.recycleMajor');
    }

    public function restore($id, Request $req)
    {
        Major::onlyTrashed()
            ->where('id', $id)
            ->restore();

        $major = Major::find($id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(29),
            true,
            $major
        );
        return Response::json(['status' => 'success']);
    }

    public function delete($id, Request $req)
    {
        Major::onlyTrashed()
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
        $major = Major::onlyTrashed()
            ->forceDelete();

        if ($major == 0) {
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
