<?php

namespace App\Http\Controllers;

use App\Enums\ReactTypeEnum;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

    public function feedback(Request $request)
    {
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