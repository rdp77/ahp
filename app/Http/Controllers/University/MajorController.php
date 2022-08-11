<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\MainController;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
            $data = User::where('id', '!=', Auth::user()->id)->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-icon btn-primary btn-block m-1"';
                    $actionBtn .= 'href="' . route('sparepart.edit', $row->id) . '"><i class="far fa-edit"></i></a>';
                    $actionBtn .= '<a onclick="del(' . $row->id . ')" class="btn btn-icon btn-danger btn-block m-1"';
                    $actionBtn .= 'style="cursor:pointer;color:white"><i class="fas fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.backend.data.university.major.indexMajor');
    }

    public function create()
    {
        $university = University::all();
        $faculty = Faculty::all();
        return view('pages.backend.data.university.major.createMajor', compact('university', 'faculty'));
    }

    public function store(Request $req)
    {
        Major::create($req->all());

        $this->MainController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            Auth::user()->name . ' membuat jurusan baru'
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat jurusan baru'
        ]);
    }

    public function edit($id)
    {
        $university = University::all();
        $faculty = Faculty::all();
        $major = Major::find($id);
        return view('pages.backend.data.university.major.updateMajor', compact('university', 'faculty', 'major'));
    }

    public function update($id, Request $req)
    {
        Major::where('id', $id)
            ->update($req->except('_token', '_method'));

        $this->MainController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            Auth::user()->name . ' mengubah jurusan ' . User::find($id)->name
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah jurusan'
        ]);
    }

    public function destroy(Request $req, $id)
    {
        $major = Major::find($id);

        $major->delete();

        $this->MainController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            Auth::user()->name . ' menghapus data jurusan ke recycle bin'
        );

        return Response::json(['status' => 'success']);
    }

    public function recycle(Request $req)
    {
        if ($req->ajax()) {
            $data = User::onlyTrashed()->get();
            return Datatables::of($data)
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
        return view('pages.backend.data.university.major.recycleMajor');
    }

    public function restore($id, Request $req)
    {
        Major::onlyTrashed()
            ->where('id', $id)
            ->restore();

        $major = Major::find($id);

        $this->MainController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            Auth::user()->name . ' mengembalikan data jurusan'
        );

        return Response::json(['status' => 'success']);
    }

    public function delete($id, Request $req)
    {
        Major::onlyTrashed()
            ->where('id', $id)
            ->forceDelete();

        $this->MainController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            Auth::user()->name . ' menghapus data jurusan secara permanen'
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
        } else {
            $major;
        }

        $this->MainController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            Auth::user()->name . ' menghapus semua data jurusan secara permanen'
        );

        return Response::json(['status' => 'success']);
    }
}