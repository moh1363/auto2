<?php

namespace App\Http\Controllers;

use App\Models\Morakhasi;
use App\Models\MorakhasiApproval;
use App\Models\PostTitle;
use App\Models\User;
use Illuminate\Http\Request;

class MorakhasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $morakhasis=Morakhasi::where('user_id',auth()->user()->id)->get();
        return view('Morakhasi.index', compact('morakhasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mande_morakhasi=auth()->user()->mande_morakhasi;
        return view('Morakhasi.create',compact('mande_morakhasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'days_number' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|string',
        ]);
        $folderPath = 'morakhasi/' . $request->user_id ;
        if ($request->hasFile('files')) {
            $filePaths = [];

            foreach ($request->file('files') as $file) {
                $filePaths[] = $file->store($folderPath, 'public');
            }
        $morakhasi=Morakhasi::create([
            'user_id' => auth()->id(),
            'start_date' => $request->start_date,
            'days_number' => $request->days_number,
            'personnel_id' => $request->personnel_id,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'comments' => $request->comments,
            'status' => 'pending',
            'files' => json_encode($filePaths),
        ]);


            if(auth()->user()->id !=1){
           MorakhasiApproval::create([
               'morakhasi_id'=>$morakhasi->id,
               'approver_id'=>1,
               'view_time'=>0
           ]);
        }}else{
            $morakhasi=Morakhasi::create([
                'user_id' => auth()->id(),
                'start_date' => $request->start_date,
                'days_number' => $request->days_number,
                'personnel_id' => $request->personnel_id,
                'end_date' => $request->end_date,
                'type' => $request->type,
                'comments' => $request->comments,
                'status' => 'pending',
            ]);


            if(auth()->user()->id !=1){
                MorakhasiApproval::create([
                    'morakhasi_id'=>$morakhasi->id,
                    'approver_id'=>1,
                    'view_time'=>0
                ]);
        }}
        return redirect()->route('morakhasi.index')->with('success', 'مرخصی با موفقیت ثبت گردید.');
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
    {
        $morakhasi=Morakhasi::find($id);

        $files = json_decode($morakhasi->files, true) ?? [];

        $approval=MorakhasiApproval::where('morakhasi_id',$id)->where('approver_id',1)->first();
        $user=User::find($morakhasi->user_id);

        return view ('Morakhasi.show',compact('morakhasi','user','approval','files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Morakhasi $morakhasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Morakhasi $morakhasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Morakhasi $morakhasi)
    {
        //
    }
}
