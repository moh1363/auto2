<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
public function home(){
    return view('training.index');
}
    public function index()
    {
        $skills = Skill::all();
        return response()->json($skills);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $skill = Skill::create($request->all());
        return response()->json($skill, 201);
    }

    public function assignSkillsToUser(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
            'level' => 'nullable|string',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,txt|max:10240',
        ]);

        // Handle file upload
        if ($request->hasFile('files')) {
            $filePaths = [];
            foreach ($request->file('files') as $file) {
                $filePaths[] = $file->store('public/skill_files'); // Store files in the 'skill_files' directory
            }
            $files = json_encode($filePaths); // Convert array of file paths to JSON
        } else {
            $files = null;
        }

        // Assign skills to user with extra fields in the pivot table
        $user->skills()->sync(
            collect($request->skills)->mapWithKeys(function ($skillId) use ($request, $files) {
                return [
                    $skillId => [
                        'level' => $request->level,
                        'approved_time' => now(),
                        'created_by' => Auth::id(),
                        'status' => $request->status,
                        'approved_by' => null, // Set to null initially or based on business logic
                        'files' => $files,
                        'description' => $request->description,
                    ]
                ];
            })
        );

        return response()->json(['message' => 'Skills assigned successfully']);
    }

    public function showUserSkills($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $skills = $user->skills;
        return response()->json($skills);
    }
}
