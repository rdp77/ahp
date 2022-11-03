<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Template\MainController;
use App\Models\Faculty;
use App\Models\Feedback;
use App\Models\Major;
use App\Models\Criteria;
use App\Models\University;
use App\Models\User;
use App\Models\Weighting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Sarfraznawaz2005\ServerMonitor\ServerMonitor;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainController $MainController, ServerMonitor $serverMonitor)
    {
        $this->middleware('auth');
        $this->MainController = $MainController;
        $this->serverMonitor = $serverMonitor;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $like = Feedback::where('react', 'like')->count();
        $dislike = Feedback::where('react', 'dislike')->count();
        $log = Activity::limit(7)
            ->orderBy('id', 'desc')
            ->get();
        $users = User::count();
        $logCount = Activity::where('causer_id', Auth::user()->id)
            ->count();
        $faculty = Faculty::count();
        $major = Major::count();

        return view('dashboard', compact(
            'like',
            'dislike',
            'log',
            'users',
            'logCount',
            'faculty',
            'major'
        ));
    }

    public function log(Request $req)
    {
        if ($req->ajax()) {
            $data = Activity::where('causer_id', Auth::user()->id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('added_at', function ($row) {
                    return date("d-M-Y H:m", strtotime($row->created_at));
                })
                ->addColumn('url', function ($row) {
                    return $row->getExtraProperty('url');
                })
                ->addColumn('ip', function ($row) {
                    return $row->getExtraProperty('ip');
                })
                ->addColumn('user_agent', function ($row) {
                    return $row->getExtraProperty('user_agent');
                })
                ->rawColumns(['added_at', 'ip', 'user_agent'])
                ->make(true);
        }
        return view('pages.backend.log.IndexLog');
    }

    public function serverMonitor(Request $req)
    {
        $checkResults = $this->serverMonitor->getChecks();
        $lastRun = $this->serverMonitor->getLastCheckedTime();

        return view('pages.backend.server.indexServer', compact(
            'checkResults',
            'lastRun'
        ));
    }

    public function feedback(Request $req)
    {
        if ($req->ajax()) {
            $data = Feedback::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('react', function ($row) {
                    if ($row->react->value == 'like') {
                        $react = '<span class="badge badge-success">Suka';
                    } else {
                        $react = '<span class="badge badge-danger">Tidak Suka';
                    }
                    $react .= '</span>';
                    return $react;
                })
                ->addColumn('created_at', function ($row) {
                    return date("d-M-Y H:m", strtotime($row->created_at));
                })
                ->rawColumns(['react', 'created_at'])
                ->make(true);
        }
        return view('pages.backend.feedback');
    }

    public function criteria(Request $request)
    {
        if ($request->ajax()) {
            $data = Criteria::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('sort', function ($row) {
                    return '<span class="badge badge-dark">' . $row->sort . '</span>';
                })
                ->rawColumns(['name', 'sort'])
                ->make(true);
        }
        return view('pages.backend.data.indexCriteria');
    }

    public function alternative(Request $request)
    {
        if ($request->ajax()) {
            $data = Major::with('faculties')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('sort', function ($row) {
                    return '<span class="badge badge-dark">' . $row->sort . '</span>';
                })
                ->addColumn('faculty', function ($row) {
                    return $row->faculties->first()->name;
                })
                ->rawColumns(['name', 'sort', 'faculty'])
                ->make(true);
        }
        return view('pages.backend.data.indexAlternative');
    }

    public function weighting(Request $request)
    {
        if ($request->ajax()) {
            $data = Weighting::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('value', function ($row) {
                    return '<span class="badge badge-success">' . $row->value . '</span>';
                })
                ->rawColumns(['value'])
                ->make(true);
        }
        return view('pages.backend.data.indexWeighting');
    }
}
