<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('name', 'ASC')->get();

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
        $dataUser = new User;

        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ];

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak berhasil disimpan',
                'data' => $validator->errors()
            ]);
        }

        $dataUser->name = $request->name;
        $dataUser->username = $request->username;
        $dataUser->password = Hash::make($request->password);

        $dataUser->save();

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
        $data = User::find($id);

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
        $dataUser = User::find($id);

        if (empty($dataUser)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ada',
            ]);
        }

        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ];

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak berhasil diubah',
                'data' => $validator->errors()
            ]);
        }

        $dataUser->name = $request->name;
        $dataUser->username = $request->username;
        $dataUser->password = Hash::make($request->password);

        $dataUser->save();

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
        $dataUser = User::find($id);

        if (empty($dataUser)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ada',
            ]);
        }

        $dataUser->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
