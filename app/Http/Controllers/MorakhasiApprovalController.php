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
        $approvals=\App\Models\MorakhasiApproval::where('approved_time',null)->get();
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
        $morakhasiApproval->update([
            'view_time'=>now()
        ]);

        $morakhasi=Morakhasi::find($morakhasiApproval->morakhasi_id);
        $user=User::find($morakhasi->user_id);
        $files = json_decode($morakhasi->files, true) ?? [];

        return view ('Morakhasiapproval.show',compact('morakhasiApproval','morakhasi','user','files'));

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
        $user=User::find($morakhasi->user_id);
        if ($request->status == 'approved') {
            $morakhasiApproval->approved_time=now();
            $morakhasiApproval->comments=$request->comments;
            $morakhasiApproval->update();
            $morakhasi->update(
                [
                    'status' => 'approved',
                ]);
            $user->mande_morakhasi=$user->mande_morakhasi-$morakhasi->days_number;
            $user->update();
            MorakhasiApproval::create([
                'morakhasi_id'=>$morakhasi->id,
                'approver_id'=>2,
                'view_time'=>0
            ]);
        } elseif ($request->status == 'rejected') {
            $morakhasiApproval->approved_time=now();
            $morakhasiApproval->comments=$request->comments;
            $morakhasiApproval->update();
            $morakhasi->update([
                'status' => 'rejected',
                'approved_time'=>now()

            ]);
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
