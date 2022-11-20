<?php
use App\Http\Controllers\BillController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassScoreController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PromotionController;
use App\Http\Livewire\AcademicYears\AcademicYear;
use App\Http\Livewire\AcademicYears\AcademicYears;
use App\Http\Livewire\Bills\Bill;
use App\Http\Livewire\Bills\Bills;
use App\Http\Livewire\BusStops\BusStopInfo;
use App\Http\Livewire\BusStops\BusStops;
use App\Http\Livewire\Classes\AllClass;
use App\Http\Livewire\Classes\SingleClass;
use App\Http\Livewire\Classes\StudentPreviousClass;
use App\Http\Livewire\ClassScores\ClassSubjectScores;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Fees\ClassPaymentHistory;
use App\Http\Livewire\Fees\EditFee;
use App\Http\Livewire\Fees\Fee;
use App\Http\Livewire\Fees\Feepayment;
use App\Http\Livewire\Fees\Fees;
use App\Http\Livewire\Fees\Create as CreatFees;
use App\Http\Livewire\Bills\Create as CreateBill;
use App\Http\Livewire\Bills\Pay as PayBill;
use App\Http\Livewire\Fees\Owe;
use App\Http\Livewire\Semesters\Semester;
use App\Http\Livewire\Semesters\Semesters;
use App\Http\Livewire\Students\Add as AddStudent;
use App\Http\Livewire\Students\GenerateTerminalReport;
use App\Http\Livewire\Students\Student;
use App\Http\Livewire\Students\Students;
use App\Http\Livewire\Subjects\Subject;
use App\Http\Livewire\Subjects\Subjects;
use App\Http\Livewire\Teachers\Teacher;
use App\Http\Livewire\Teachers\Teachers;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Notifications\NotifyParents;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([config('jetstream.auth_session'), ])
    ->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::group(['prefix'=>'students_'], function (){
        Route::get('/', Students::class)->name('students');
        Route::get('students/{student}', Student::class)->name('students.student');
        Route::get('student/{student}/previous-class/{studentClassRecord}', StudentPreviousClass::class)
            ->name('students.student.previous_class');
        Route::get('student/{student}/semester/{semester}/generate-terminal-report', GenerateTerminalReport::class)
            ->name('student.gen_terminal_report');
        Route::get('admission', AddStudent::class)->name('students.admit');
    });

    Route::group(['prefix'=>'classes'], function (){
        Route::get('/', AllClass::class)->name('classes');
        Route::post('/{class}/{subject}/bind-teacher-to-subject', [ClassController::class, 'bindTeacherToSubject'])
            ->name('classes.class.bind_teacher_to_subject');
        Route::post('/{class}/{subject}/unbind-teacher-from-subject', [ClassController::class, 'unbindTeacherFromSubject'])
            ->name('classes.class.unbind_teacher_from_subject');
        Route::get('class/{class}', SingleClass::class)->name('classes.class');
        Route::post('class/promote', [PromotionController::class, 'promote'])->name('classes.promote');
    });

    Route::group(['prefix'=>'class-scores'], function (){
        Route::get('class/{class}/subject/{subject}/semester/{semester}', ClassSubjectScores::class)
            ->name('class_scores.class_subject_scores');
        Route::post('class-score/{classScore}/update', [ClassScoreController::class, 'update'])
            ->name('class_scores.update');
        Route::post('class-score/lock/subject/{subject}/class/{class}/semester/{semester}', [ClassScoreController::class, 'lockSubjectScores'])
            ->name('class_scores.lock_subject_scores');
    });

    Route::group(['prefix'=>'subjects'], function (){
        Route::get('/', Subjects::class)->name('subjects');
        Route::get('subjects/{subject}', Subject::class)->name('subjects.subject');
    });

    Route::group(['prefix'=>'teachers'], function (){
        Route::get('/', Teachers::class)->name('teachers');
        Route::get('teacher/{teacher}', Teacher::class)->name('teachers.teacher');
    });

    Route::group(['prefix'=>'fees'], function (){
        Route::get('/', Fees::class)->name('fees');
        Route::get('students-owing', Owe::class)->name('fees.owe');
        Route::get('create', CreatFees::class)->name('fees.create');
        Route::get('edit/{fee}', EditFee::class)->name('fees.edit');
        Route::post('update/{fee}', [FeeController::class, 'update'])->name('fees.update');
        Route::post('store', [FeeController::class, 'store'])->name('fees.store');
        Route::get('payment', Feepayment::class)->name('fees.payment');
        Route::get('fee/{fee}', Fee::class)->name('fees.fee');
        Route::get('payment-history/fee/{fee}/class/{class}', ClassPaymentHistory::class)
            ->name('fees.class.payment_history');
    });

    Route::group(['prefix'=>'bills'], function (){
        Route::get('/', Bills::class)->name('bills');
        Route::get('/create', CreateBill::class)->name('bills.create');
        Route::post('/store', [BillController::class, 'store'])->name('bills.store');
        Route::get('/pay', PayBill::class)->name('bills.pay');
        Route::get('/bill/{bill}', Bill::class)->name('bills.bill');

        Route::get('/bill/payment/{billPayment}/invoice', [BillController::class, 'paymentInvoice'])
            ->name('bills.bill.payment.invoice');
        Route::get('/bill/{bill}/payments/invoice', [BillController::class, 'billPaymentsInvoice'])
            ->name('bills.bill.payments.invoice');
    });

    Route::group(['prefix'=>'semesters'], function (){
        Route::get('/', Semesters::class)->name('semesters');
        Route::get('/semester/{semester}', Semester::class)->name('semesters.semester');
    });

    Route::group(['prefix'=>'academic-years'], function (){
        Route::get('/', AcademicYears::class)->name('academic-years');
        Route::get('/academic-years/{academicYear}', AcademicYear::class)->name('academic-years.academic-year');
    });

        Route::group(['prefix'=>'notifications'], function (){
            Route::get('notify', NotifyParents::class)->name('notify');

        });

    Route::group(['prefix'=>'buss-stops'], function (){
        Route::get('/', BusStops::class)->name('bus_stops');
        Route::get('/{bus_stop}/info', BusStopInfo::class)->name('bus_stop.info');
    });

});


?>
