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

    /**
     * Show a medical record by id
     */
    public function show(int $id): JsonResponse
    {
        $medicalRecord = MedicalRecord::find($id);

        if (! $medicalRecord) {
            return response()
                ->json(['message' => 'Medical record not found'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json($medicalRecord, HttpResponse::HTTP_OK);
    }
}
