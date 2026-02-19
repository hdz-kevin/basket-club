<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MedicalRecordController extends Controller
{
    /**
     * List medical records
     */
    public function index(): JsonResponse
    {
        $medicalRecords = MedicalRecord::all();

        return response()->json($medicalRecords, HttpResponse::HTTP_OK);
    }
}
