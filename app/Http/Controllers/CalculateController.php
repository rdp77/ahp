<?php

namespace App\Http\Controllers;

use App\Enums\CriteriaTypeEnum;
use App\Http\Controllers\Template\MainController;
use App\Models\Feedback;
use App\Models\Major;
use App\Models\Criteria;
use App\Models\Pivot\FacultyMajor;
use App\Models\University;
use App\Models\Weighting;
use Bardiz12\AHPDss\AHP;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;
use Spatie\Activitylog\Models\Activity;

class CalculateController extends Controller
{
    private $criteriaMaj;
    private $criteriaUniv;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainController $MainController)
    {
        $this->MainController = $MainController;
        $this->criteriaUniv = Criteria::where('type', CriteriaTypeEnum::UNIVERSITY)->get();
        $this->criteriaMaj = Criteria::where('type', CriteriaTypeEnum::MAJOR)->get();
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

        if ($alternative === 'check') {
            $alternativesUniv = University::with('majors')->get();
        } else {
            if (count($request->alternative) === 2) {
                return redirect()->back()->with('error', 'Minimal memilih 3 Universitas atau 1 Universitas');
            }
            $alternativesUniv = University::whereIn('id', $alternative)->with('majors')->get();
        }
        $alternativesMaj = $alternativesUniv->pluck('majors')->flatten()->unique('id')->values();
        $matrixUniv = $this->generateMatrix(Criteria::where('type', CriteriaTypeEnum::UNIVERSITY)->get());
        $matrixMaj = $this->generateMatrix(Criteria::where('type', CriteriaTypeEnum::MAJOR)->get(),
            'barismaj', 'table-input-maj-', 'cekInputMatrixMaj(this)');
        $matrixPairWiseUniv = $this->generateMatrixPairWise(Criteria::where('type', CriteriaTypeEnum::UNIVERSITY)->get(), $alternativesUniv);
        $matrixPairWiseMaj = $this->generateMatrixPairWise(Criteria::where('type', CriteriaTypeEnum::MAJOR)->get(), $alternativesMaj, 'pairwisemaj', '-input-maj-', 'cekPairWiseMatrixMaj');


        return view('pages.frontend.calculate.index', [
            'alternativeuniv' => $alternativesUniv,
            'alternativeunivids' => $alternativesUniv->pluck('id'),
            'alternativemaj' => $alternativesMaj,
            'alternativemajids' => $alternativesMaj->pluck('id'),
            'criteria' => $criteria,
            'criteriaUniv' => $this->criteriaUniv,
            'criteriaMaj' => $this->criteriaMaj,
            'weighting' => $weighting,
            'matrixUniv' => $matrixUniv,
            'matrixMaj' => $matrixMaj,
            'matrixPairWiseUniv' => $matrixPairWiseUniv,
            'matrixPairWiseMaj' => $matrixPairWiseMaj,
        ]);
    }

    public function generateMatrix(Collection $criterias, string $baris = 'baris', string $tableInput = 'table-input-', string $function = 'cekInputMatrix(this)')
    {
        $size = count($criterias);
        $tr = '<th scope="col" class="text-center">#</th>';
        $tbody = '';
        $flag = false;
        $types = [];
        foreach ($criterias as $i => $criteria) {
            $types[] = $criteria->type;
            $criterias[] = $criteria->name;
            $tr .= '<th scope="col" class="text-center">' . $criteria->name . '</th>';
            $td = '';
            for ($j = 0; $j < $size; $j++) {
                $td .= '<td><input type="text" name="' . $baris . '[' . $i . '][' . $j . ']" class="form-control table-input" id="' . $tableInput . $i . '-' . $j . '" data-i="' . $i . '" data-j="' . $j . '" value="' . ($i == $j ? '1' : '') . '" ' . ($i == $j ? 'readonly ' : 'onKeyUp="return ' . $function . ';"') . 'required /></td>';
            }
            $tbody .= '<tr>
                            <th scope="row" class="black white-text text-center">' . $criteria->name . '</th>
                            ' . $td . '
                        </tr>';
        }
        return compact('tbody', 'tr');
    }

    public function generateMatrixPairWise(Collection $criterias, Collection $candidates, string $name = 'pairwise', string $table = '-input-', string $function = 'cekPairWiseMatrix')
    {
        $htmlData = '';
        foreach ($criterias as $c => $criteria) {
            $tr = '<th scope="col" class="text-center">#</th>';
            foreach ($candidates as $candidate) {
                $tr .= '<th scope="col" class="text-center">' . $candidate->name . '</th>';
            }
            $tbody = '';
            foreach ($candidates as $i => $candidate) {
                $td = '';
                foreach ($candidates as $j => $candidate2) {
                    $td .= '<td><input type="text" name="' . $name . '[' . $c . '][' . $i . '][' . $j . ']" class="form-control table-input" id="table-' . $c . $table . $i . '-' . $j . '" data-i="' . $i . '" data-j="' . $j . '" value="' . ($i == $j ? '1' : '') . '" ' . ($i == $j ? 'readonly ' : 'onKeyUp="return ' . $function . '(this,' . $c . ');"') . 'required/></td>';
                }
                $tbody .= '<tr>
                            <th scope="row" class="black white-text text-center">' . $candidate->name . '</th>
                            ' . $td . '
                        </tr>';
            }
            $html = ($c + 1) . '. PairWise Matrix for Criteria : <strong>' . $criteria->name . '</strong>
                        <table class="table table-striped">
                            <thead class="black white-text">
                                <tr>
                                    ' . $tr . '
                                </tr>
                            </thead>
                            <tbody>
                                ' . $tbody . '
                            </tbody>
                        </table>';
            $htmlData .= $html;
        }
        return $htmlData;
    }

    public function calculate(Request $request)
    {
        try {
            $university = false;
            if (count($request->alternativesuniv) > 1) {
                $university = true;
                $universityAHP = $this->calculateAHP(
                    $request->criteriauniv, $request->alternativesuniv, $request->typesuniv, $request->baris, $request->pairwise
                );
                $universityRecommendation = $universityAHP[0];
                $recommendation = University::where('name', $universityRecommendation['name'])->first();
            } else {
                $recommendation = University::where('id', json_decode($request->alternativeuniv)[0])->first();
            }

            $majorAHP = $this->calculateAHP(
                $request->criteriamaj, $request->alternativesmaj, $request->typesmaj, $request->barismaj, $request->pairwisemaj
            );

            $recommendation = FacultyMajor::where('university_id', $recommendation->id)->get()->pluck('major_id')->unique();
            $recommendation = Major::whereIn('id', $recommendation)->where('name', $majorAHP[0]['name'])->first();

            activity()
                ->causedBy(Auth::id())
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->header('user-agent'),
                    'university' => $universityAHP ?? null,
                    'major' => $majorAHP,
                    'recommendation' => [
                        'university' => $university ? University::where('name', $universityRecommendation['name'])->first() :
                            University::where('id', json_decode($request->alternativeuniv)[0])->first(),
                        'major' => $recommendation
                    ]
                ])
                ->log('calculate');

            return view('pages.frontend.calculate.history', [
                'university' => $universityAHP ?? null,
                'major' => $majorAHP,
                'recommendation' => [
                    'university' => $university ? University::where('name', $universityRecommendation['name'])->first() :
                        University::where('id', json_decode($request->alternative)[0])->first(),
                    'major' => $recommendation
                ]
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
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

    public function calculateHistory()
    {
        $activity = Activity::where('causer_id', Auth::user()->id)->where('description', 'calculate')->get();
        return view('pages.frontend.calculate.history', [
            'activity' => $activity
        ]);
    }

    public function calculateHistoryShow(Request $request, Response $response, $id)
    {
        $activity = Activity::where('causer_id', Auth::user()->id)->where('description', 'calculate')->where('id', $id)->first();
        return view('pages.frontend.calculate.history', [
            'university' => $activity->properties['university'] ?? null,
            'major' => $activity->properties['major'],
            'recommendation' => [
                'university' => $activity->properties['recommendation']['university'],
                'major' => $activity->properties['recommendation']['major']
            ],
        ]);
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
