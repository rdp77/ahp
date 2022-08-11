<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\UniversityRequest;
use App\Models\Faculty;
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
        // University::with('faculty')->get()->dd();
        // Faculty::with('major')->get()->dd();
        // University::with('faculty')->get()->first()->faculty->first()->major->dd();
        University::with('major')->get()->dd();
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
            $this->getStatus(3),
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
            $this->getStatus(3),
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
            $this->getStatus(5),
            false
        );

        return Response::json(['status' => 'success']);
    }
}