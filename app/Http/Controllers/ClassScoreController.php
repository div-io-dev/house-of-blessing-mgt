<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassScore\UpdateRequest;
use App\Models\Class_;
use App\Models\ClassScore;
use App\Models\Semester;
use App\Models\Subject;

class ClassScoreController extends Controller
{
    public function update(ClassScore $classScore, UpdateRequest $request){
        $validatedRequest = $request->validated();
        $classScore->update([
            'class_score' => $validatedRequest['class_score'],
            'exam_score' => $validatedRequest['exam_score'],
        ]);
        return back()->with([
            'success' => "{$classScore->student->full_name}'s data has been updated successfully"
        ]);
    }

    public function lockSubjectScores(Subject $subject, Class_ $class, Semester $semester){
        $class_scores = ClassScore::where('class__id', $class->id)
            ->where('subject_id', $subject->id)
            ->where('semester_id', $semester->id)
            ->get();
        foreach ($class_scores as $class_score){
            $class_score->update([
                'is_locked' => true
            ]);
        }
        return back()->with([
            'success' => "class scores has been locked and cannot be edited again"
        ]);
    }
}
