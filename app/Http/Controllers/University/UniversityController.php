<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\UniversityRequest;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use Exception;
use Illuminate\Contracts\Support\Renderable;
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
     * @return Renderable
     * @throws Exception
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
                ->addColumn('order', function ($row) {
                    return '<span class="badge badge-dark">' . $row->order . '</span>';
                })
                ->rawColumns(['action', 'order'])
                ->make(true);
        }

        return view('pages.backend.data.master.university.indexUniversity');
    }

    public function store(UniversityRequest $req)
    {
        $performedOn = University::create($req->all());

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(26),
            true,
            University::find($performedOn->id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat Universitas'
        ]);
    }

    public function edit($id)
    {
        $university = University::find($id);
        return view('pages.backend.data.master.university.updateUniversity', compact('university'));
    }

    public function update($id, UniversityRequest $req)
    {
        University::where('id', $id)
            ->update($req->except('_token', '_method'));

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(27),
            true,
            University::find($id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah University'
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
            $this->getStatus(28),
            true,
            $university
        );

        return Response::json(['status' => 'success']);
    }

    public function recycle(Request $req)
    {
        if ($req->ajax()) {
            $data = University::onlyTrashed()->get();
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
        return view('pages.backend.data.master.university.recycleUniversity');
    }

    public function restore($id, Request $req)
    {
        University::onlyTrashed()
            ->where('id', $id)
            ->restore();

        $university = University::find($id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(29),
            true,
            $university
        );
        return Response::json(['status' => 'success']);
    }

    public function delete($id, Request $req)
    {
        University::onlyTrashed()
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
        $university = University::onlyTrashed()
            ->forceDelete();

        if ($university == 0) {
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
