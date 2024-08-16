<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Komik;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class KomikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Komik::orderBy('nama', 'ASC')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataKomik = new Komik;

        $rules = [
            'nama' => 'required',
            'chapter' => 'required'
        ];

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak berhasil disimpan',
                'data' => $validator->errors()
            ]);
        }

        $dataKomik->nama = $request->nama;
        $dataKomik->chapter = $request->chapter;
        $dataKomik->last_update = $request->last_update;
        $dataKomik->id_genre = $request->id_genre;

        $dataKomik->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Komik::find($id);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataKomik = Komik::find($id);

        if (empty($dataKomik)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ada',
            ]);
        }

        $rules = [
            'nama' => 'required',
            'chapter' => 'required'
        ];

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak berhasil diubah',
                'data' => $validator->errors()
            ]);
        }

        $dataKomik->nama = $request->nama;
        $dataKomik->chapter = $request->chapter;
        $dataKomik->last_update = $request->last_update;
        $dataKomik->id_genre = $request->id_genre;

        $dataKomik->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataKomik = Komik::find($id);

        if (empty($dataKomik)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ada',
            ]);
        }

        $dataKomik->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
