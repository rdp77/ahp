<?php

namespace App\Http\Controllers;

use App\Enums\RatioTypeEnum;
use App\Enums\ReactTypeEnum;
use App\Models\Feedback;
use App\Models\Major;
use App\Models\Criteria;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
//        $university = University::with('faculties', 'faculties.majors')->get();
        $university = University::get();
        return view('home', compact('university'));
    }

    public function feedback(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'reason' => 'required',
        ]);

        if ($validated->fails()) {
            return Response::json([
                'status' => 'error',
                'data' => $validated->errors(),
            ]);
        }

        $react = $request->react == 1 ? ReactTypeEnum::LIKE : ReactTypeEnum::DISLIKE;

        $performedOn = Feedback::create([
            'react' => $react->value,
            'comment' => $request->reason
        ]);

        $this->createLog(
            $request->header('user-agent'),
            $request->ip(),
            $this->getStatus(33),
            true,
            $performedOn
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Terimakasih, Masukan Anda akan kami tampung!'
        ]);
    }
}
