<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transfer;
// use App\MasterBank;
use App\Bank;
use App\User;

class TransferController extends Controller
{
    public $data = [];

    public function index()
    {
        $transfer = Transfer::with('User', 'Event', 'Bank')->get();
        foreach($transfer as $trans) {
            $bank = Bank::where('master_bank_id', $trans->bank_id)->get();
            $this->data[] = [
                'id' => $trans->id,
                'nominal' => 'Rp. '.$trans->nominal,
                'desc' => $trans->desc,
                'status' => $trans->status,
                'user_id' => $trans->User->name,
                'bank_id' => $trans->bank_id,
                'event_id' => $trans->Event->title
            ];
        }

        $dataJSON = ['data'=>$this->data];
        return response()->json($dataJSON, 200);
    }

    public function show($id)
    {
        $transfer = Transfer::findOrFail($id);

        return response()->json($transfer, 200);
    }

    public function store(Request $request)
    {
        $transfer = new Transfer;
        $transfer->user_id = $request->user_id;
        $transfer->nominal = $request->nominal.'.'.mt_rand(500,999);
        $transfer->desc = $request->desc;
        $transfer->status = $request->status;
        $transfer->event_id = $request->event_id;
        $transfer->bank_id = $request->bank_id;
        $transfer->save();

        return response()->json($transfer, 201);
    }

    public function update(Request $request, $id)
    {
        $transfer = Transfer::findOrFail($id);
        $transfer->update($request->all());

        return response()->json($transfer, 200);
    }

    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);
        $transfer->delete();

        return response()->json($transfer, 204);
    }
}
