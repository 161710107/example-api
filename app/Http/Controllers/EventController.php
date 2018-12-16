<?php

namespace App\Http\Controllers;

use App\Event;
use App\Transfer;
use App\Categori;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public $data = [];

    public function index()
    {
        $event = Event::with('Categori', 'Transfer', 'User')->get();
        foreach ($event as $eventini) {
           
            $this->data[] = [
                'id' => $eventini->id,
                'title' => $eventini->title,
                'desc' => $eventini->desc,
                'image' => $eventini->image,
                'category_id' => $eventini->Categori,
                'harga_limit' => $eventini->harga_limit,
                'status' => $eventini->status,
                'user_id' => $eventini->User
            ];  
        }

        $dataJSON = ['data'=>$this->data];
        return response()->json($dataJSON, 200);
    }

    public function show($id)
    {
        $event = Transfer::where('event_id', $id)->get();

        return response()->json($event, 200);
    }

    public function store(Request $request)
    {
        $event = Event::create($request->except('image'));
        if ($request->hasFile('image')) {
            $uploaded_gambar = $request->file('image');
            $extension = $uploaded_gambar->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'backEnd/images/barang';
            $uploaded_gambar->move($destinationPath, $filename);
            $event->image = $filename;
        }
        $event->save();

        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->except('image'));
        if ($request->hasFile('image')) {
            $uploaded_gambar = $request->file('image');
            $extension = $uploaded_gambar->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'backEnd/images/barang';
            $uploaded_gambar->move($destinationPath, $filename);
            $event->image = $filename;
        }
        $event->save();

        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json($event, 204);
    }
}