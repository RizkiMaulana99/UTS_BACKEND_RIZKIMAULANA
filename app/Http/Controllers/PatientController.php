<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::all();
        $total = count($patient);

        if ($total) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilakan semua data patient',
                'total' => $total,
                'data' => $patient
            ], 200);
        }else {
            return response()->json([
                'succes' => false,
                'message' => 'Data tersebut kosong'
            ], 200);

        }

            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:patients,nama',
            'phone' => 'required|numeric',
            'alamat' => 'required',
            'status' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_keluar' => 'nullable'
        ]);

        $patients = Patient::create($validate);

        return response()->json([
            'success' => true,
            'message' => 'Patient berhasil ditambahkan',
            'data' => $patients
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan' 
            ], 404); 
        }else {
            return response()->json([
                'success' => true,
                'message' => 'Detail data berhasil ditampilkan',
                'data' => $patient
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patients = Patient::find($id);

        if ($patients) {
            $patients->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Patient berhasil di update',
                'data' => $patients
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Data not found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patients = Patient::find($id);

        if ($patients) {
            $patients->delete();

            return response()->json([
                'success' => true,
                'message' => 'Patient berhasil di hapus'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data not found'
        ], 404);
    }

    public function recovered()
    {
        $patients = Patient::where('status', 'recovered')->get();
        $total = count($patients);

        if ($total) {
            return response()->json([
                'success' => true,
                'message' => 'Pasien berstatus recovered, berhasil ditampilkan',
                'total' => $total,
                'data' => $patients
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data is empty'
        ], 200);
    }

public function dead()
    {
        $patients = Patient::where('status', 'dead')->get();
        $total = count($patients);

        if ($total) {
            return response()->json([
                'success' => true,
                'message' => 'Pasien berstatus dead, berhasil ditampilkan',
                'total' => $total,
                'data' => $patients
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data is empty'
        ], 200);
    }

public function positive()
    {
        $patients = Patient::where('status', 'positive')->get();
        $total = count($patients);

        if ($total) {
            return response()->json([
                'success' => true,
                'message' => 'Pasien berstatus positive, berhasil ditampilkan',
                'total' => $total,
                'data' => $patients
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data is empty'
        ], 200);
    }

    public function search($name)
    {
        $patients = Patient::where('name', 'like', '%' . $name . '%')->get();
        $total = count($patients);

        if ($total) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil ditampilkan',
                'total' => $total,
                'data' => $patients
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data not found'
        ], 404);
    }
}
