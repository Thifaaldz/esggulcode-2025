<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AssignmentsController,
    AssignmentsSubmissionsController,
    AssignmentSubmissionController,
    AttendanceController,
    BranchController,
    CompanyController,
    DepartmentController,
    DivisionController,
    EmployeeController,
    EventCourseController,
    LeaveController,
    MidtransCallbackController,
    ModuleController,
    PayrollCategoryController,
    PayrollDetailController,
    PositionController,
    SalaryPeriodController,
    StudentController
};


Route::middleware('apikey')->get('/cek-api', function () {
    return response()->json(['message' => 'API Key valid. Akses diterima.']);
});


Route::middleware('apikey')->group(function () {
    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('divisions', DivisionController::class);
    Route::apiResource('positions', PositionController::class);
    Route::apiResource('branches', BranchController::class);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('leaves', LeaveController::class);
    Route::apiResource('salary-periods', SalaryPeriodController::class);
    Route::apiResource('payroll-categories', PayrollCategoryController::class);
    Route::apiResource('payroll-details', PayrollDetailController::class);
    Route::apiResource('event-courses', EventCourseController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('assignments', AssignmentsController::class);
    Route::apiResource('assignment-submissions', AssignmentsSubmissionsController::class);
});



Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle']);
