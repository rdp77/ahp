<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\UniversityRequest;
use App\Models\Faculty;
use App\Models\Major;
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
        $faculty = Faculty::with('majors')->get();

        return view('pages.backend.data.university.indexUniversity', compact('faculty'));
    }

}
