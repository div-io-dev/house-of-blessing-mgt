<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promote(Request $request){
        $this->validate($request, [
            'promotion_class' => 'required|exists:class_,id',
            'students' => 'required|array|min:1',
        ]);
        foreach ($request->students as $student_id){
            $student = Student::find($student_id);
            $student = promoteStudent($student, $request->promotion_class);
        }
        return back()->with(['success' => 'Students promoted successfully']);
    }
}
