<?php

use App\Models\Bill;
use App\Models\Semester;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

if (!function_exists('formatFrontEndDate')){
    function formatFrontEndDate($date, $to='Y-m-d'){
        return Carbon::parse($date)->toDate()->format($to);
    }
}

if (!function_exists('uploadFileTo')){
    function uploadFileTo(UploadedFile $file, $path = 'uploaded-files')
    {
        return $file->storePublicly($path, ['disk' => 'public']);
    }
}

if (!function_exists('generateUniqueNumber')){
    function generateUniqueNumber($model, $column = null)
    {
        do {
            $code = random_int(10000000, 99999999);
        } while ($model::where($column, "=", $code)->first());
        return $code;
    }
}

if (!function_exists('promoteStudent')){
    function promoteStudent($student, $to_id)
    {
        // create student class record
        $scr = $student->classRecords()->create([
            'class__id' => $student->class->id,
            'semesters' => $student->classSemesterRecords->pluck('semester_id'),
            'academic_position' => 1,
            'overall_raw_score' => studentOverallRawScore($student),
        ]);
        $student->update([
            'class__id' => $to_id
        ]);
        return $student;
    }
}

if (!function_exists('studentOverallRawScore')){
    function studentOverallRawScore($student, $class = null){
        if (!$class) $class = $student->class;
        $class_scores = $student->classScores()
            ->where('class__id', $class->id)
            ->get();
        $total = 0;
        foreach ($class_scores as $class_score){
            $total += ($class_score->class_score + $class_score->exam_score);
        }
        return $total;
    }
}

if (!function_exists('createStudentClassSemesterRecord')){
    function createStudentClassSemesterRecord($semester){
        $students = Student::all();
        foreach ($students as $student){
            $existing_classSemesterRecords = $student->classSemesterRecords()
                ->where('class__id', $student->class->id)
                ->where('semester_id', $semester->id)
                ->first();
            if (!$existing_classSemesterRecords){
                $student->classSemesterRecords()->create([
                    'class__id' => $student->class->id,
                    'semester_id' => $semester->id
                ]);
            }
        }
        return true;
    }
}

if (!function_exists('getTeacherOfClassAndSubject')){
    function getTeacherOfClassAndSubject($class, $subject)
    {
        $pivot = DB::table('class__teacher')
            ->where('class__id', $class->id)
            ->where('subject_id', $subject->id)
            ->first();
        if ($pivot){
            return $teacher = $class->teachers->where('id', $pivot->teacher_id)->first();
        }
        return null;
    }
}

if (!function_exists('getSubjectsOfClassAndTeacher')){
    function getSubjectsOfClassAndTeacher($class, $teacher)
    {
        $subjects = [];
        $pivot_subject_ids = DB::table('class__teacher')
            ->where('class__id', $class->id)
            ->where('teacher_id', $teacher->id)
            ->get()->pluck(['subject_id'])->toArray();
        foreach ($pivot_subject_ids as $pivot_subject_id){
            $subjects[] = DB::table('subjects')->where('id', $pivot_subject_id)->first();
        }
        return $subjects;
    }
}

if (!function_exists('payStudentFee')){
    function payStudentFee($student, $amount_paying, $payer)
    {
        $bills = Bill::where('billable_id', $student->id)
            ->where('billable_type', get_class($student))
            ->where('type', '=','fee')
            ->orderBy('created_at', 'ASC')
            ->get();
        foreach ($bills as $bill){
            $amount_left = $bill->amount - $bill->amount_paid;
            if ($amount_left < 1){
                continue;
            }
            if ($amount_paying > $amount_left){
                $bill->update([
                    'amount_paid' => $bill->amount_paid + $amount_left,
                ]);
                $bill->billPayments()->create([
                    'amount_paid' => $amount_left,
                    'payer_name' => $payer['name'],
                    'payer_mobile_number' => $payer['mobile_number'],
                ]);
                $amount_paying = $amount_paying - $amount_left;
            }
            else{
                $bill->update([
                    'amount_paid' => $bill->amount_paid + $amount_paying,
                ]);
                $bill->billPayments()->create([
                    'amount_paid' => $amount_paying,
                    'payer_name' => $payer['name'],
                    'payer_mobile_number' => $payer['mobile_number'],
                ]);
                break;
            }

        }
        return $student;
    }
}

if (!function_exists('feeDebt')){
    function feeDebt($fee){
        $total_students = 0;
        $students_owing_count = 0;
        $total_debt = 0;
        foreach ($fee->classes as $class){
            foreach ($class->students as $student){
                $total_students += 1;
                $bill = $student->bills()->where('fee_id', $fee->id)->first();
                if ($bill && $bill->amount_left > 0){
                    $students_owing_count += 1;
                    $total_debt += $bill->amount_left;
                }
            }
        }
        return [
            'total_debt' => $total_debt,
            'total_students' => $total_students,
            'students_owing_count' => $students_owing_count,
        ];
    }
}

if (!function_exists('feeInfoOfClass')){
    function feeInfoOfClass($fee, $class){
        $total_amount = 0;
        $amount_paid = 0;
        $debt = 0;
        $students_owing_count = 0;
        foreach ($class->students as $student){
            $bill = $student->bills()->where('fee_id', $fee->id)->first();
            if ($bill){
                $total_amount += $bill->amount;
                $amount_paid += $bill->amount_paid;
                $debt += $bill->amount_left;
                $students_owing_count += $bill->amount_left > 0 ? 1 : 0;
            }
        }
        return [
            'total_amount' => $total_amount,
            'amount_paid' => $amount_paid,
            'debt' => $debt,
            'students_owing_count' => $students_owing_count,
        ];
    }
}

if (!function_exists('studentFeeInfo')){
    function studentFeeInfo($fee, $student){
        $bill = $student->bills()->where('fee_id', $fee->id)->first();
//        dd($student->bills());
        $info['id'] = $bill ? $bill->id : null;
        $info['amount_paid'] = $bill ? $bill->amount_paid : 0;
        $info['amount_left'] = $bill ? $bill->amount_left : 0;
        return $info;
    }
}

if (!function_exists('createSemesterClassScores')){
    function createSemesterClassScores($semester){
        foreach (Student::all() as $student){
            $class = $student->class;
            foreach ($class->subjects as $subject){
                $existing = $student->classScores->where('class_id', $class->id)
                    ->where('subject_id', $subject->id)
                    ->where('semester_id', $semester->id)
                    ->first();
                if (!$existing){
                    $student->classScores()->create([
                        'class__id' => $student->class->id,
                        'subject_id' => $subject->id,
                        'semester_id' => $subject->id,
                    ]);
                }
            }
        }
        return true;
    }
}

if (!function_exists('createStudentClassScores')){
    function createStudentClassScores($student, $class){
        foreach ($class->subjects as $subject){
            $existing = $student->classScores->where('class_id', $class->id)
                ->where('subject_id', $subject->id)
                ->where('semester_id', currentSemester()->id)
                ->first();
            if (!$existing){
                $student->classScores()->create([
                    'class__id' => $student->class->id,
                    'subject_id' => $subject->id,
                    'semester_id' => currentSemester()->id,
                ]);
            }
        }
        return true;
    }
}

if (!function_exists('createSubjectClassScores')){
    function createSubjectClassScores($subject_id, $class){
        foreach ($class->students as $student){
            $existing = $student->classScores->where('class_id', $class->id)
                ->where('subject_id', $subject_id)
                ->where('semester_id', currentSemester()->id)
                ->first();
            if (!$existing){
                $student->classScores()->create([
                    'class__id' => $student->class->id,
                    'subject_id' => $subject_id,
                    'semester_id' => currentSemester()->id,
                ]);
            }
        }
        return true;
    }
}

if (!function_exists('clearSubjectClassScores')){
    function clearSubjectClassScores($subject_id, $class){
        foreach ($class->students as $student){
            $student->classScores->where('subject_id', $subject_id)->delete();
        }
        return true;
    }
}

if (!function_exists('currentSemester')){
    function currentSemester(){
        return Semester::where('is_ended', false)->first();
    }
}

if (!function_exists('endPreviousSemesters')){
    function endPreviousSemesters(){
        $current_semesters = Semester::where('is_ended', false)->get();
        foreach ($current_semesters as $current_semester){
            $current_semester->update(['is_ended' => true]);
        }
        return true;
    }
}

if (!function_exists('getInterpretation')){
    function getInterpretation($total_score){
        if (  ( 70 <= $total_score) && ($total_score <= 100) ){
            return 'Extinction';
        }
    }
}







