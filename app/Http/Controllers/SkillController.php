<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        return view('training.skills.index');
    }

    public function fetch()
    {
        return response()->json(Skill::all());
    }

    public function store(Request $request)
    {
        $skill = Skill::create($request->all());
        return response()->json($skill);
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($request->all());
        return response()->json($skill);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json(['success' => true]);
    }
}
