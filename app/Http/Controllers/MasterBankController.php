<?php

namespace App\Http\Controllers;

use App\MasterBank;
use Illuminate\Http\Request;

class MasterBankController extends Controller
{
   public $data = [];

    public function index()
    {
        $master = MasterBank::all();
        foreach ($master as $masters) {
            $this->data[] = [
                'id' => $masters->id,
                'name' => $masters->name
            ];
        }

         $dataJSON = ['data'=>$this->data];
        return response()->json($dataJSON, 200);
    }

    public function show($id)
    {
        $master = MasterBank::findOrFail($id);

        return response()->json($master, 200);
    }

    public function store(Request $request)
    {
        $master = new MasterBank;
        $master->name = $request->name;
        $master->save();

        return response()->json($master, 201);
    }

    public function update(Request $request, $id)
    {
        $master = MasterBank::findOrFail($id);
        $master->update($request->all());

        return response()->json($master, 200);
    }

    public function destroy($id)
    {
        $master = MasterBank::findOrFail($id);
        $master->delete();

        return response()->json($master, 204);
    }
}
