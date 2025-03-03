<?php

namespace App\Http\Controllers;

use App\Models\Morakhasi;
use App\Models\MorakhasiApproval;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MorakhasiApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvals=\App\Models\MorakhasiApproval::where('is_checked',0)->get();
        return view ('Morakhasiapproval.index',compact('approvals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $morakhasiApproval=MorakhasiApproval::find($id);
        $morakhasi=Morakhasi::find($morakhasiApproval->morakhasi_id);
        $user=User::find($morakhasi->user_id);
        return view ('Morakhasiapproval.show',compact('morakhasiApproval','morakhasi','user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MorakhasiApproval $morakhasiApproval)
    {
        return view ('Morakhasi.approve',compact('morakhasiApproval'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $morakhasiApproval=MorakhasiApproval::find($id);
        $morakhasi=Morakhasi::find($morakhasiApproval->morakhasi_id);

        if ($request->status == 'approved') {

            $morakhasi->update(['status' => 'approved']);
        } elseif ($request->status == 'rejected') {
            $morakhasi->update(['status' => 'rejected']);
        }


        return redirect()->route('morakhasi.index');//->with('success', 'مرخصی با موفقیت ثبت گردید.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MorakhasiApproval $morakhasiApproval)
    {
        //
    }
}
