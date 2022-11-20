<?php

namespace App\Http\Controllers;

use App\Models\Class_;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function bindTeacherToSubject(Request $request, Class_ $class, Subject $subject){
        $this->validate($request, [
            'teacher' => ['required', 'exists:teachers,id'],
            'old_teacher' => ['nullable', 'exists:teachers,id'],
        ]);
        if ($request->has('old_teacher')){
            $pv = DB::table('class__teacher')
                ->where(['class__id' => $class->id, 'subject_id' => $subject->id, 'teacher_id' => $request->old_teacher])
                ->first();
            DB::table('class__teacher')->delete($pv->id);
        }
        $class->teachers()->attach($request->teacher, ['subject_id' => $subject->id], false);
        return back()->with([
            'success' => "Teacher bind to this subject successfully"
        ]);
    }

    public function unbindTeacherFromSubject(Request $request, Class_ $class, Subject $subject){
        $this->validate($request, [
            'teacher' => ['required', 'exists:teachers,id']
        ]);
        $class->teachers()->wherePivot('subject_id', '=', $subject->id)->detach($request->teacher);
        return back()->with([
            'success' => "Teacher unbind to this subject successfully"
        ]);
    }
}
