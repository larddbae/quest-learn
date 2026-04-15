<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class JoinClassController extends Controller
{
    public function show()
    {
        return view('student.join-class');
    }

    public function join(Request $request)
    {
        $request->validate([
            'join_code' => 'required|string|size:6',
        ]);

        $classroom = Classroom::where('join_code', strtoupper($request->join_code))->first();

        if (!$classroom) {
            return back()->withErrors(['join_code' => 'Invalid join code. Please check with your teacher.'])->withInput();
        }

        $user = auth()->user();
        $user->classroom_id = $classroom->id;
        $user->save();

        return redirect()->route('student.dashboard')->with('success', 'Welcome to ' . $classroom->name . '! Your adventure begins now! ⚔️');
    }
}
