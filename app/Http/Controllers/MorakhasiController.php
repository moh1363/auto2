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
        $morakhasis=Morakhasi::all();
        return view('Morakhasi.index', compact('morakhasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Morakhasi.create');
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
            $filePaths = []; // برای نگهداری مسیر فایل‌ها

            foreach ($request->file('files') as $file) {
                $filePaths[] = $file->store($folderPath, 'public'); // ذخیره فایل‌ها در پوشه 'leave_files'
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
               'is_checked'=>0,
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
                    'is_checked'=>0,
                    'view_time'=>0
                ]);
        }
        return redirect()->route('morakhasi.index')->with('success', 'مرخصی با موفقیت ثبت گردید.');
    }}

    /**
     * Display the specified resource.
     */


    public function show(Morakhasi $morakhasi)
    {
        return view ('Morakhasi.show',compact('morakhasi'));
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
