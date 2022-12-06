<?php

namespace App\Http\Controllers;

use App\Enums\CriteriaTypeEnum;
use App\Http\Controllers\Template\MainController;
use App\Models\Faculty;
use App\Models\Feedback;
use App\Models\Major;
use App\Models\Criteria;
use App\Models\Pivot\FacultyMajor;
use App\Models\University;
use App\Models\User;
use App\Models\Weighting;
use App\Perhitungan;
use Bardiz12\AHPDss\AHP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Sarfraznawaz2005\ServerMonitor\ServerMonitor;
use Spatie\Activitylog\Models\Activity;

class CalculateController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainController $MainController, ServerMonitor $serverMonitor)
    {
        $this->MainController = $MainController;
        $this->serverMonitor = $serverMonitor;
    }

    public function index()
    {
        return view('pages.frontend.calculate.index');
    }

    public function storeCalculate(Request $request)
    {
        $alternative = $request->alternative ?? 'check';
        $criteria = Criteria::all();
        $weighting = Weighting::all();
        $majors = Major::all();
        $universities = University::all();
        $criteriaUniversity = (new Criteria)->comparisonScale(CriteriaTypeEnum::UNIVERSITY);
        $criteriaMajor = (new Criteria)->comparisonScale(CriteriaTypeEnum::MAJOR);
        $criteriaUniv = Criteria::where('type', CriteriaTypeEnum::UNIVERSITY)->get();
        $criteriaMaj = Criteria::where('type', CriteriaTypeEnum::MAJOR)->get();
        if ($alternative === 'check') {
            $alternative = University::with('majors')->get();
            $alternativeUniversity = (new University)->comparisonScale(University::all()->pluck('id')->toArray());
            $alternativeMajor = (new Major)->comparisonScale($alternative->pluck('id')->toArray());
        } else {
            $alternative = University::whereIn('id', $alternative)->with('majors')->get();
            $alternativeUniversity = (new University)->comparisonScale($alternative->pluck('id')->toArray());
            $alternativeMajor = (new Major)->comparisonScale($alternative->pluck('id')->toArray());
        }
        $alternativeids = json_encode($alternative->pluck('id')->toArray());
        $alternativeMaj = FacultyMajor::whereIn('university_id', $alternative->pluck('id')->toArray())->get()->pluck('major_id')->unique();
        $alternativeMaj = Major::whereIn('id', $alternativeMaj)->get();

//        return response()->json(json_decode($criteriaMajor));

        return view('pages.frontend.calculate.index', compact(
            'criteria', 'alternative', 'criteriaUniversity', 'criteriaMajor', 'weighting',
            'alternativeUniversity', 'alternativeMajor', 'majors', 'universities', 'alternativeids',
            'criteriaUniv', 'criteriaMaj', 'alternativeMaj'
        ));
    }

    public function calculate(Request $request)
    {
        $university = false;
        if (count(json_decode($request->alternative)) > 1) {
            $university = true;
            $universityAHP = $this->calculateAHP(
                $request->criterias, $request->alternatives, $request->types, $request->baris, $request->pairwise
            );
            // get first array element of universityAHP
            $universityRecommendation = $universityAHP[0];
            $recommendation = University::where('name', $universityRecommendation['name'])->first();
        } else {
            $recommendation = University::where('id', json_decode($request->alternative)[0])->first();
        }

        $majorAHP = $this->calculateAHP(
            $request->criteriasmaj, $request->alternativesmaj, $request->typesmaj, $request->barismaj, $request->pairwisemaj
        );
        // check if $majorAHP response json is correct or not
        if (json_decode($majorAHP)->status === 'error') {
            return $majorAHP . 'majors';
        }

//        $universityRecommendation = [
//            'name' => 'Universitas 17 Agustus 1945 Surabaya',
//        ];

        // Get University recommendation by major

        $recommendation = FacultyMajor::where('university_id', $recommendation->id)->get()->pluck('major_id')->unique();
        $recommendation = Major::whereIn('id', $recommendation)->where('name', $majorAHP[0]['name'])->first();

        return response()->json([
//            'university' => $universityAHP ?? null,
            'major' => $majorAHP,
            'recommendation' => [
                'university' => $university ? University::where('name', $universityRecommendation['name'])->first() :
                    University::where('id', json_decode($request->alternative)[0])->first(),
                'major' => $recommendation
            ]
        ]);
//            dd($request->all());
//            $input = $request->all();
//            unset($input['alternative']);
//            unset($input['alternativesmaj']);
//            unset($input['criteriasmaj']);
//            $ahp = new AHP();
////            foreach ($request->criterias as $value) {
////                $ahp->addQualitativeCriteria($value);
////            }
////            $ahp->setCandidates($request->alternatives);
//            foreach ($input['types'] as $key => $value) {
//                if ($value == 0) {
//                    $ahp->addQualitativeCriteria($input['criterias'][$key]);
//                } else {
//                    $ahp->addQuantitativeCriteria($input['criterias'][$key]);
//                }
//            }
//            $ahp->setCandidates($input['alternatives']);
//
//            //relative interest matrix
//            foreach ($input['baris'] as $i => &$ar) {
//                foreach ($ar as $j => &$ar2) {
//                    if ($ar2 == 'AUTO') {
//                        $ar2 = null;
//                    }
//                }
//            }
//            $ahp->setRelativeInterestMatrix($input['baris']);
//            foreach ($request->baris as $i => &$ar) {
//                foreach ($ar as $j => &$ar2) {
//                    if ($ar2 == 'AUTO') {
//                        $ar2 = null;
//                    }
//                }
//            }
//            $baris = [];
        // check value in array $request->baris, if 'AUTO' change to null
//            foreach ($request->baris as $key => $value) {
//                $baris[$key] = array_map(function ($item) {
//                    return $item === 'AUTO' ? null : $item;
//                }, $value);
//            }
//            return response()->json([
//                'baris' => count($baris),
//                'kriteria' => count($request->criterias),
//            ]);
//            $request->baris = array_map(static function ($ar) {
//                return array_map(static function ($ar2) {
//                    return $ar2 == 'AUTO' ? null : $ar2;
//                }, $ar);
//            }, $request->baris);
//            $ahp->setRelativeInterestMatrix($baris);

        //PairWise

//            $pairWise = [];
//            foreach ($input['pairwise'] as $key => &$ar) {
//                foreach ($ar as $i => &$ar2) {
//                    if ($input['types'][$key] == 0) {
//                        foreach ($ar2 as $j => &$ar3) {
//                            if ($ar3 == 'AUTO') {
//                                $ar3 = null;
//                            }
//                        }
//                    } else {
//                        if ($ar2 == 'AUTO') {
//                            $ar2 = null;
//                        }
//                    }
//                }
//                $pairWise[$input['criterias'][$key]] = $ar;
//            }
//            $ahp->setBatchCriteriaPairWise($pairWise);
//            $pairWise = [];
//            foreach ($input['pairwise'] as $key => &$ar) {
//                foreach ($ar as $i => &$ar2) {
//                    if ($input['types'][$key] == 0) {
//                        foreach ($ar2 as $j => &$ar3) {
//                            if ($ar3 == 'AUTO') {
//                                $ar3 = null;
//                            }
//                        }
//                    } else {
//                        if ($ar2 == 'AUTO') {
//                            $ar2 = null;
//                        }
//                    }
//                }
//                $pairWise[$input['criterias'][$key]] = $ar;
//            }
        // create new pairwise matrix
        // replace all 'AUTO' to null in array $request->pairwise and insert to $pairWise
//            foreach ($request->pairwise as $key => $value) {
//                $pairWise[$request->criterias[$key]] = array_map(function ($item) {
//                    return $item === 'AUTO' ? null : $item;
//                }, $value);
//            }
//            foreach ($request->pairwise as $key => $ar) {
//                $ar = array_map(static function ($ar2) use ($request, $key) {
//                    array_map(static function ($ar3) {
//                        return $ar3 === 'AUTO' ? null : $ar3;
//                    }, $ar2) ;
//                }, $ar);
//                $pairWise[$request->criterias[$key]] = $ar;
//            }
//            foreach ($request->pairwise as $key => $ar) {
//                $ar = array_map(static function ($ar2) use ($request, $key) {
//                    // change 'AUTO' to null
//                    return $request->types[$key] == 0 ? array_map(static function ($ar3) {
//                        return $ar3 === 'AUTO' ? null : $ar3;
//                    }, $ar2) : ($ar2 === 'AUTO' ? null : $ar2);
//                }, $ar);
//                $pairWise[$request->criterias[$key]] = $ar;
//            }
//            $ahp->finalize();
//            logger($ahp->getResult());
////            dd('ok');
////            return response()->json(json_decode($ahp->getResults()));
//            return response()->json([
//                'result' => $ahp->getResult(),
//                'pairwise' => $pairWise,
//                'baris' => $input['baris'],
//                'alternatives' => $input['alternatives'],
//                'criterias' => $input['criterias'],
//                'types' => $input['types'],
//            ]);
//            $perhitungan = Perhitungan::create([
//                'name'=>$request->input('name'),
//                'description'=>$request->input('description'),
//                'data'=>json_encode($request->all())
//            ]);
//            echo "<a href=".route('perhitungan.show',[$perhitungan->id]).">CLICK HERE TO SEE THE RESULT</a>";
//        } catch (\ErrorException $e) {
//            Log::error($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
//            return response()->json(['error' => $e->getMessage()]);
//        }

//        $alternative = json_decode($request->alternative);
//        // collection by name prefix (kriteria, alternatif)
//        $criteriaUniv = collect($request->all())->filter(function ($value, $key) {
//            return str_starts_with($key, 'kriteria-univ-');
//        });
//        $criteriaMajor = collect($request->all())->filter(function ($value, $key) {
//            return str_starts_with($key, 'kriteria-maj-');
//        });
//        $alternativeUniv = collect($request->all())->filter(function ($value, $key) {
//            return str_starts_with($key, 'alternatif-univ-');
//        });
//        $alternativeMajor = collect($request->all())->filter(function ($value, $key) {
//            return str_starts_with($key, 'alternatif-maj-');
//        });
//
//        $data = [
//            'university' => [
//                'criteria' => $criteriaUniv,
//                'alternative' => $alternativeUniv,
//            ],
//            'major' => [
//                'criteria' => $criteriaMajor,
//                'alternative' => $alternativeMajor,
//            ],
//            'alternative' => $alternative,
//        ];
//
//        return $data;
    }

    public function calculateAHP($criterias, $alternatives, $types, $lines, $pairwise)
    {
        try {
            $ahp = new AHP();

            foreach ($types as $key => $value) {
                if ($value == 0) {
                    $ahp->addQualitativeCriteria($criterias[$key]);
                } else {
                    $ahp->addQuantitativeCriteria($criterias[$key]);
                }
            }
            $ahp->setCandidates($alternatives);

            //relative interest matrix
            foreach ($lines as $i => &$ar) {
                foreach ($ar as $j => &$ar2) {
                    if ($ar2 == 'AUTO') {
                        $ar2 = null;
                    }
                }
            }
            $ahp->setRelativeInterestMatrix($lines);

            //PairWise
            $pairWise = [];
            foreach ($pairwise as $key => &$ar) {
                foreach ($ar as $i => &$ar2) {
                    if ($types[$key] == 0) {
                        foreach ($ar2 as $j => &$ar3) {
                            if ($ar3 == 'AUTO') {
                                $ar3 = null;
                            }
                        }
                    } else {
                        if ($ar2 == 'AUTO') {
                            $ar2 = null;
                        }
                    }
                }
                $pairWise[$criterias[$key]] = $ar;
            }
            $ahp->setBatchCriteriaPairWise($pairWise);
            $ahp->finalize();
            return $ahp->getResult();
        } catch (\ErrorException $e) {
            Log::error($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

//    public function index()
//    {
//        $like = Feedback::where('react', 'like')->count();
//        $dislike = Feedback::where('react', 'dislike')->count();
//        $log = Activity::limit(7)
//            ->orderBy('id', 'desc')
//            ->get();
//        $users = User::count();
//        $logCount = Activity::where('causer_id', Auth::user()->id)
//            ->count();
//        $faculty = Faculty::count();
//        $major = Major::count();
//
//        return view('dashboard', compact(
//            'like',
//            'dislike',
//            'log',
//            'users',
//            'logCount',
//            'faculty',
//            'major'
//        ));
//    }

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
                ->addColumn('order', function ($row) {
                    return '<span class="badge badge-dark">' . $row->order . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('dashboard.criteria.edit', $row->id) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['name', 'order', 'action'])
                ->make(true);
        }
        return view('pages.backend.data.criteria.indexCriteria');
    }

    public function criteriaEdit($id)
    {
        $criteria = Criteria::find($id);
        return view('pages.backend.data.criteria.updateCriteria', compact('criteria'));
    }

    public function criteriaUpdate($id, Request $request)
    {
        $criteria = Criteria::find($id);
        $criteria->order = $request->order;
        $criteria->save();

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah urutan kriteria ' . $criteria->name
        ]);
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
                ->addColumn('order', function ($row) {
                    return '<span class="badge badge-dark">' . $row->order . '</span>';
                })
                ->addColumn('faculty', function ($row) {
                    return $row->faculties->first()->name;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('dashboard.alternative.edit', $row->id) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['name', 'order', 'faculty', 'action'])
                ->make(true);
        }
        return view('pages.backend.data.alternative.indexAlternative');
    }

    public function alternativeEdit($id)
    {
        $alternative = Major::find($id);
        return view('pages.backend.data.alternative.updateAlternative', compact('alternative'));
    }

    public function alternativeUpdate($id, Request $request)
    {
        $alternative = Major::find($id);
        $alternative->order = $request->order;
        $alternative->save();

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah urutan alternatif ' . $alternative->name
        ]);
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
