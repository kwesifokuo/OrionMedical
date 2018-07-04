<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();


Route::get('/',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin',  
	 ]);

Route::get('/auth/login',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin',  
	 ]);

Route::get('/scheduled-sms',
	['uses' => '\OrionMedical\Http\Controllers\NotifyController@sendSMS',
	 'as' => 'scheduled-sms',  
	 ]);



Route::get('/mlogout',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignOut',
	 'as' => 'mlogout',  
	 ]);


Route::get('/dashboard',
	['uses' => '\OrionMedical\Http\Controllers\HomeController@index',
	 'as' => 'dashboard',
	  ]);

Route::get('/business.summary',
	['uses' => '\OrionMedical\Http\Controllers\HomeController@getTotals',
	 'as' => 'business.summary',
	  ]);

Route::get('/charts',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@index',
	 'as' => 'charts',
	  ]);

Route::get('/bpcompute',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@computeBPRange',
	 'as' => 'bpcompute',
	  ]);

Route::get('/vital-chart',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@vitals',
	 'as' => 'vital-chart',
	  ]);

Route::get('/do-patient-generate',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@doGenerateBulkID',
	 'as' => 'do-patient-generate',
	  ]);

Route::get('/do-notify',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@getnotify',
	 'as' => 'do-notify',
	  ]);

Route::get('/chart-drugs-dispensed',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@drugDispensed',
	 'as' => 'chart-drugs-dispensed',
	  ]);

Route::get('/visits-by-days',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@VisitNoperDaytoMonth',
	 'as' => 'visits-by-days',
	  ]);


Route::get('/visits-by-type',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@VisitsbyConsultation',
	 'as' => 'visits-by-type',
	  ]);


Route::get('/visits-by-doctor',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@VisitsbyDoctor',
	 'as' => 'visits-by-doctor',
	  ]);



Route::get('/customer-type',
	['uses' => '\OrionMedical\Http\Controllers\ChartsController@customerType',
	 'as' => 'customer-type',
	  ]);

Route::get('/print-excuse-duty/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printExcuseDuty',
	'as' => 'print-excuse-duty/',]);


Route::get('/print-refusal-treatment/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printRefusal',
	'as' => 'print-refusal-treatment/',]);


Route::get('/print-treatment-plan/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printDentalTreatmentPlan',
	'as' => 'print-treatment-plan/',]);


Route::get('/print-eye-plan/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printEyeTreatmentPlan',
	'as' => 'print-eye-plan/',]);



Route::post('/uploadfiles', ['uses' =>'\OrionMedical\Http\Controllers\ImageController@postUpload',
	'as' => 'upload-files',
 ]);

Route::post('/uploadfiles-hospital', ['uses' =>'\OrionMedical\Http\Controllers\ImageController@uploadHosiptalDocs',
	'as' => 'upload-files',
 ]);


Route::post('/bulkupload', ['uses' =>'\OrionMedical\Http\Controllers\ImageController@uploadMultiple',
	'as' => 'upload-files',
 ]);


Route::get('/load-document-details', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@loadDocuments',
	'as' => 'load-document-details',]);


//Authentication
Route::get('/signup',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignup',
	 'as' => 'auth.signup', ]);


Route::get('/delete-user',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@deleteUser',
	 'as' => 'delete-user', ]);

Route::get('/manage-users',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getUsers',
	 'as' => 'manage-users', ]);

Route::post('/update-user',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@resetPassword',]);

Route::post('/signup',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@postSignup',]);

Route::get('/signin',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin', ]);




Route::get('/edit-user/{id}',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getUserEdit',
	 'as' => 'edit-user', ]);


Route::get('/reset-password-notice',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@resetnotice',
	 'as' => 'reset-password-notice', ]);

Route::post('/signin',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@postSignin',	
	 ]);


Route::get('/find-patient', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@getSearchResults', 
	'as' => 'find-patient', ]);

Route::get('/folder-history', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@findVisitHistory', 
	'as' => 'folder-history', ]);

Route::get('/folder-history', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@findVisitHistory', 
	'as' => 'folder-history', ]);

Route::get('/company-directory', 
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@getdirectory', 
	'as' => 'company-directory', ]);


Route::post('/update-opd-detail', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@updateOPD', 
	'as' => 'update-opd-detail', ]);

Route::get('/active-patients',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@activepatients',
	 'as' => 'active-patients', ]);

Route::get('/inactive-patients',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@inactivepatients',
	 'as' => 'inactive-patients', ]);


Route::get('/register-start',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@registerWithtab',
	 'as' => 'register-start', ]);


Route::get('welcome-email', 'KYCController@pushEmail');

Route::post('/create-patient',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@postNewCustomer',]);

Route::get('/edit-patient', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@editCustomer',
	'as' => 'edit-patient',]);

Route::get('/delete-patient', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@deleteCustomer', 
	'as' => 'delete-patient', ]);

Route::get('/guest-patient', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@guestCustomer',
	'as' => 'guest-patient',]);

Route::post('/update-patient', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@updateCustomer',
	'as' => 'update-patient',]);

Route::get('/patient-profile/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getPatientProfileOPD',
	'as' => 'patient-profile',]);

Route::get('/patient-profile-limited/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getPatientProfileOPD',
	'as' => 'patient-profile-limited',]);

Route::get('/patient-timeline', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@getPatientTimeline',
	'as' => 'patient-timeline',]);

Route::get('/activate-account', array(
	'uses' => '\OrionMedical\Http\Controllers\KYCController@activatePatient',
	'as' => 'activate-account',
	));

Route::get('/deactivate-account', array(
	'uses' => '\OrionMedical\Http\Controllers\KYCController@deactivatePatient',
	'as' => 'deactivate-account',
	));


//OPD routes


Route::get('/update-investigation-comment',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@updateInvestigationComment',
	 'as' => 'update-investigation-comment', ]);


Route::get('/update-location-status',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@updateLocationStatus',
	 'as' => 'update-location-status', ]);

Route::get('/assign-doctor-patient',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@assignDoctor',
	 'as' => 'assign-doctor-patient', ]);

Route::get('/update-care-status',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@updateCareStatus',
	 'as' => 'update-care-status', ]);




Route::get('/new-opd',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@index',
	 'as' => 'new-opd', ]);

Route::get('/get-visit-details',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@searchbyVisitID',
	 'as' => 'get-visit-details', ]);

Route::get('/get-visit-details-pharmacy',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getPharmacyWalkInVisit',
	 'as' => 'get-visit-details-pharmacy', ]);

Route::get('/get-visit-details-laboratory',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getLabWalkInVisit',
	 'as' => 'get-visit-details-laboratory', ]);


Route::post('/create-opd',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@createOPD',]);


Route::post('/create-opd-walkin',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@createOPDWalkin',]);

Route::get('/walkin-service/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@doConsulationWalkin',
	'as' => 'walkin-service',]);


Route::post('/create-opd-referral',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@createReferral',]);

Route::get('/delete-opd', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@deleteOPD', 
	'as' => 'delete-opd', ]);

Route::get('/waiting-opd',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getCheckedIn',
	 'as' => 'waiting-opd', ]);

Route::get('/review-opd',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getReview',
	 'as' => 'review-opd', ]);

Route::get('/discharged-opd',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@getDischarged',
	 'as' => 'discharged-opd', ]);


Route::get('/opd.appointment',
	['uses' => '\OrionMedical\Http\Controllers\OPDController@bookAppointment',
	 'as' => 'opd.appointment', ]);

Route::get('/find-patient-opd', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@findPatientOPD', 
	'as' => 'find-patient-opd', ]);



Route::get('/find-patient-folder', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@findPatientFolder', 
	'as' => 'find-patient-folder', ]);

Route::get('/find-dentist-folder', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@findDentistFolder', 
	'as' => 'find-dentist-folder', ]);

Route::get('/find-eye-folder', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@findEyeFolder', 
	'as' => 'find-eye-folder', ]);



Route::get('/print-visit-summary/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printVisitSummary', 
	'as' => 'print-visit-summary', ]);

Route::get('/print-referal-note/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printReferalLetter', 
	'as' => 'print-referal-note', ]);

Route::get('/print-executive-cover/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printExecutiveCover', 
	'as' => 'print-executive-cover', ]);

Route::get('/find-nurse-folder', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@findNurseFolder', 
	'as' => 'find-nurse-folder', ]);

//IPD
Route::get('/new-ipd',
	['uses' => '\OrionMedical\Http\Controllers\IPDController@index',
	 'as' => 'new-ipd', ]);

Route::get('/show-admitted',
	['uses' => '\OrionMedical\Http\Controllers\IPDController@getAdmitted',
	 'as' => 'show-admitted', ]);

Route::get('/assign-ward', 
	['uses' => '\OrionMedical\Http\Controllers\IPDController@doAssignPatientToWard',
	'as' => 'assign-ward',]);

Route::get('/available-ward',
	['uses' => '\OrionMedical\Http\Controllers\IPDController@getAvailableBeds',
	 'as' => 'available-ward', ]);

Route::get('/remove-from-ward',
	['uses' => '\OrionMedical\Http\Controllers\IPDController@removePatientFromWard',
	 'as' => 'remove-from-ward', ]);


//Notes
Route::get('/notes-index',
	['uses' => '\OrionMedical\Http\Controllers\NoteController@index',
	 'as' => 'notes-index', ]);



//Billing
Route::get('/billing-index',
	['uses' => '\OrionMedical\Http\Controllers\BillController@index',
	 'as' => 'billing-index', ]);

Route::get('/get-bill-state',
	['uses' => '\OrionMedical\Http\Controllers\BillController@getPatientOutstanding',
	 'as' => 'get-bill-state', ]);


Route::get('/mobile-money-pay/{id}',
	['uses' => '\OrionMedical\Http\Controllers\BillController@momopay',
	 'as' => 'mobile-money-pay', ]);


Route::get('/payment-index',
	['uses' => '\OrionMedical\Http\Controllers\BillController@payments',
	 'as' => 'payment-index', ]);

Route::get('/insurance-claims',
	['uses' => '\OrionMedical\Http\Controllers\BillController@insurance',
	 'as' => 'insurance-claims', ]);


Route::get('/insurance-claims-portal',
	['uses' => '\OrionMedical\Http\Controllers\BillController@insuranceportal',
	 'as' => 'insurance-claims-portal', ]);


Route::get('/provider-claims',
	['uses' => '\OrionMedical\Http\Controllers\BillController@provider',
	 'as' => 'provider-claims', ]);

Route::get('/provider-payments',
	['uses' => '\OrionMedical\Http\Controllers\BillController@providerpayments',
	 'as' => 'provider-payments', ]);

Route::get('/vetted-claims',
	['uses' => '\OrionMedical\Http\Controllers\BillController@vettedclaims',
	 'as' => 'vetted-claims', ]);

Route::get('/vet-claim/{id}',
	['uses' => '\OrionMedical\Http\Controllers\BillController@vetClaim',
	 'as' => 'vet-claim', ]);

Route::post('/do-vetting',
	['uses' => '\OrionMedical\Http\Controllers\BillController@doVetting',]);




Route::get('/billing-dashboard',
	['uses' => '\OrionMedical\Http\Controllers\BillController@dashboard',
	 'as' => 'billing-dashboard', ]);

Route::get('/billing-invoice/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@getPatientBill',
	'as' => 'billing-invoice',]);

Route::get('/billing-print/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@printBill',
	'as' => 'billing-print',]);

Route::get('/claim-form/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@printClaimBill',
	'as' => 'claim-form',]);

Route::get('/claim-form-bulk', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@printClaimBillBulk',
	'as' => 'claim-form-bulk',]);

Route::get('/claim-form-summary', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@printClaimBillSummary',
	'as' => 'claim-form-summary',]);


Route::get('/payment-form-summary', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@printPaymentSummary',
	'as' => 'payment-form-summary',]);



Route::get('/billing-email/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@emailBill',
	'as' => 'billing-email',]);

Route::get('/get-invoice-info', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@fetchbilldetails',
	'as' => 'get-invoice-info',]);

Route::get('/invoice-list', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@getBillitems',
	'as' => 'invoice-list',]);

Route::get('/receipt/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@receipt',
	'as' => 'receipt',]);

Route::post('/do-payment',
	['uses' => '\OrionMedical\Http\Controllers\BillController@doPayment',]);

Route::get('/find-bill', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@getSearchResults', 
	'as' => 'find-bill', ]);

Route::get('/find-payment', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@getSearchPayments', 
	'as' => 'find-payment', ]);

Route::get('/approve-claim', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@approveclaim', 
	'as' => 'approve-claim', ]);

Route::get('/query-claim', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@queryclaim', 
	'as' => 'query-claim', ]);

Route::get('/reject-claim', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@rejectclaim', 
	'as' => 'reject-claim', ]);



Route::get('/find-claim', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@getSearchResultsClaim', 
	'as' => 'find-claim', ]);

Route::get('/exclude-from-bill', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@excludeBillItem', 
	'as' => 'exclude-from-bill', ]);

Route::get('/patient-enquiry', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@patientEnquiry', 
	'as' => 'patient-enquiry', ]);


Route::get('/download-pending-invoices', 
	['uses' => '\OrionMedical\Http\Controllers\BillController@downloadpendinginvoices', 
	'as' => 'download-pending-invoices', ]);




//Nurse

Route::get('/nurse-review/{id}',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@nursereview',
	 'as' => 'nurse-review', ]);


Route::get('/nurse-station',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@index',
	 'as' => 'nurse-station', ]);

Route::get('/ipd-medication',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newMedication',
	 'as' => 'ipd-medication', ]);

Route::get('/ipd-fluid-chart',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newIntakeOutput',
	 'as' => 'ipd-fluid-chart', ]);

Route::get('/nurse-admission-progress',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newNurseProgess',
	 'as' => 'nurse-admission-progress', ]);

Route::get('/ipd-discharge-summary',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newDischargeSummary',
	 'as' => 'ipd-discharge-summary', ]);

Route::get('/ipd-vital-signs',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newVitalSign',
	 'as' => 'ipd-vital-signs', ]);

Route::get('/get-history-record',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newHistory',
	 'as' => 'get-history-record', ]);

Route::get('/temperature-chart',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newTemperature',
	 'as' => 'temperature-chart', ]);

Route::get('/antenatal-admission',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newAntenatalAdmission',
	 'as' => 'antenatal-admission', ]);

Route::get('/antenatal-attendance',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newAntenatalAttendance',
	 'as' => 'antenatal-attendance', ]);

Route::get('/puerperium',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newPuerperium',
	 'as' => 'puerperium', ]);

Route::get('/record-of-labour',
	['uses' => '\OrionMedical\Http\Controllers\NurseController@newRecordofLabour',
	 'as' => 'record-of-labour', ]);




//Laboratory
Route::get('/laboratory',
	['uses' => '\OrionMedical\Http\Controllers\LabController@index',
	 'as' => 'laboratory', ]);

Route::get('/available-labs',
	['uses' => '\OrionMedical\Http\Controllers\LabController@getlabstypes',
	 'as' => 'available-labs', ]);


Route::get('/fbs-results/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@fbc',
	 'as' => 'fbs-results', ]);

Route::get('/bf-for-mps/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@bfformps',
	 'as' => 'bf-for-mps', ]);

Route::get('/malaria-result/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@malaria',
	 'as' => 'malaria-result', ]);

Route::get('/blood-group-result/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@bloodgroup',
	 'as' => 'blood-group-result', ]);

Route::get('/esr-result/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@bloodgroup',
	 'as' => 'esr-result', ]);






Route::post('/add-new-lab-report',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newlabreport',
	 'as' => 'add-new-lab-report', ]);

Route::post('/add-new-request', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@savelabrequest',
	'as' => 'add-new-request',]);

Route::get('/perform-analysis/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@doAnalysis',
	'as' => 'perform-analysis',]);

Route::get('/upload-scan/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\PacsController@gallery',
	'as' => 'upload-scan',]);

Route::get('/image-request-slip/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\PacsController@imagerequestslip',
	'as' => 'image-request-slip',]);

Route::get('/find-lab-type', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@findtest', 
	'as' => 'find-lab-type', ]);

Route::get('/save-test-results', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@saveTestResults', 
	'as' => 'save-test-results', ]);

Route::get('/load-test-results', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@loadTestResults', 
	'as' => 'load-test-results', ]);

Route::get('/find-test-result', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@findtestresult', 
	'as' => 'find-test-result', ]);

Route::get('/test-collection-slip/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@collectionslip', 
	'as' => 'test-collection-slip', ]);

Route::get('/view-lab-request/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@viewrequest',
	 'as' => 'view-lab-request', ]);


Route::post('/test-save',
	['uses' => '\OrionMedical\Http\Controllers\LabController@testsave',
	 'as' => 'test-save', ]);


Route::get('/laboratory-request/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newLabRequest',
	 'as' => 'laboratory-request', ]);

Route::get('/laboratory-results/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@printResults',
	 'as' => 'laboratory-results', ]);

Route::get('/laboratory-biochemistry/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@printResultsBio',
	 'as' => 'laboratory-biochemistry', ]);



Route::get('/laboratory-body-fluid-analysis/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newBodyFluidRequest',
	 'as' => 'laboratory-body-fluid-analysis', ]);

Route::get('/laboratory-drug-alcohol/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newDrugAlcoholRequest',
	 'as' => 'laboratory-drug-alcohol', ]);

Route::get('/laboratory-hormonal-assay/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newHormonalRequest',
	 'as' => 'laboratory-hormonal-assay', ]);

Route::get('/laboratory-surgical-questionnaire/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newSurgicalRequest',
	 'as' => 'laboratory-surgical-questionnaire', ]);

Route::get('/laboratory-microbiology/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newMicrobiologyRequest',
	 'as' => 'laboratory-microbiology', ]);

Route::get('/laboratory-haematology/{id}',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newHaematologyRequest',
	 'as' => 'laboratory-haematology', ]);

Route::post('/add-body-result', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@savebodyfluidresults',
	'as' => 'add-body-result',]);


//Pacs

Route::get('/find-imaging-request',
	['uses' => '\OrionMedical\Http\Controllers\PacsController@findImageRequest',
	 'as' => 'find-imaging-request', ]);


Route::get('/imaging',
	['uses' => '\OrionMedical\Http\Controllers\PacsController@index',
	 'as' => 'imaging', ]);

Route::get('/pacs-gallery',
	['uses' => '\OrionMedical\Http\Controllers\PacsController@gallery',
	 'as' => 'pacs-gallery', ]);

Route::get('/get-image-request', 
	['uses' => '\OrionMedical\Http\Controllers\PacsController@getImagingRequest',
	'as' => 'get-image-request',]);


Route::get('/add-image-request', 
	['uses' => '\OrionMedical\Http\Controllers\PacsController@addImagesRequest',
	'as' => 'add-image-request',]);

Route::get('/delete-image-request', 
	['uses' => '\OrionMedical\Http\Controllers\PacsController@deleteImage',
	'as' => 'delete-image-request',]);


//Room
Route::get('/available-rooms',
	['uses' => '\OrionMedical\Http\Controllers\RoomController@index',
	 'as' => 'available-rooms', ]);

Route::post('/add-new-ward',
	['uses' => '\OrionMedical\Http\Controllers\RoomController@store',]);

Route::get('/edit-ward', 
	['uses' => '\OrionMedical\Http\Controllers\RoomController@edit',
	'as' => 'edit-ward',]);

Route::post('/update-ward', 
	['uses' => '\OrionMedical\Http\Controllers\RoomController@update',
	'as' => 'update-ward',]);


//Doctor
Route::get('/opd-consultation',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@opd',
	 'as' => 'opd-consultation', ]);

Route::get('/opd-consultation-doctor',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@opd',
	 'as' => 'opd-consultation-doctor', ]);

Route::get('/ipd-consultation',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@ipd',
	 'as' => 'ipd-consultation', ]);

Route::get('/patient-images',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getPatientImages',
	 'as' => 'patient-images', ]);


Route::get('/opd-details', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@viewOPD',
	'as' => 'opd-details',]);


Route::get('/load-account', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@loadAccount',
	'as' => 'load-account',]);

Route::get('/opd-ticket/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\OPDController@printticket',
	'as' => 'opd-ticket',]);

Route::get('/appointment-slip/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\EventController@print',
	'as' => 'appointment-slip/',]);



Route::get('/ipd-details', 
	['uses' => '\OrionMedical\Http\Controllers\IPDController@viewIPD',
	'as' => 'ipd-details',]);


Route::post('/process-consultation',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@postConsultation',]);


Route::get('/review-consultation',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getPendingReview',
	 'as' => 'review-consultation', ]);

Route::get('/discharged-consultation',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getDischarged',
	 'as' => 'discharged-consultation', ]);


Route::get('/load-dignosis-description', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@loadAllDiagnosis',
	'as' => 'load-dignosis-description',]);


Route::get('/edit-review', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@editReview',
	'as' => 'edit-review',]);


Route::get('/edit-service', 
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@editService',
	'as' => 'edit-service',]);

Route::get('/discharge-patient', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@dischargePatient', 
	'as' => 'discharge-patient', ]);

Route::get('/patient-photo', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getPhoto',
	'as' => 'patient-photo',]);

Route::get('/patient-medication', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getMedication',
	'as' => 'patient-medication',]);

Route::get('/update-drug-quantity', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@updateMedicationRequestQuantity',
	'as' => 'update-drug-quantity',]);

Route::get('/return-drug-quantity', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@returnMedicationRequestQuantity',
	'as' => 'return-drug-quantity',]);

Route::get('/patient-medication-pending', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getdrugPending',
	'as' => 'patient-medication-pending',]);

Route::get('/patient-complaint', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getComplaint',
	'as' => 'patient-complaint',]);

Route::get('/patient-investigation', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getInvestigation',
	'as' => 'patient-investigation',]);

Route::get('/patient-diagnosis', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getDiagnosis',
	'as' => 'patient-diagnosis',]);

Route::get('/patient-procedure', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getProcedure',
	'as' => 'patient-procedure',]);


Route::get('/patient-procedure-plan', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getFurtherPlan',
	'as' => 'patient-procedure-plan',]);


Route::get('/patient-history', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getHistory',
	'as' => 'patient-history',]);

Route::get('/patient-vitals', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getVitals',
	'as' => 'patient-vitals',]);

Route::get('/patient-vitals-all', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getVitalsAll',
	'as' => 'patient-vitals-all',]);

Route::get('/patient-assessment', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getAssessment',
	'as' => 'patient-assessment',]);

Route::get('/patient-plan', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getPlan',
	'as' => 'patient-plan',]);


Route::get('/patient-fluids', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getFluids',
	'as' => 'patient-fluids',]);



Route::get('/add-assessment', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addAssessment',
	'as' => 'add-assessment',]);

Route::get('/add-plan', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addPlan',
	'as' => 'add-plan',]);



Route::get('/add-complaint', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addComplaint',
	'as' => 'add-complaint',]);

Route::get('/add-note', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addNote',
	'as' => 'add-note',]);

Route::get('/add-note-eye', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addNoteForEye',
	'as' => 'add-note-eye',]);

Route::get('/add-note-dental', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addNoteForDental',
	'as' => 'add-note-dental',]);


Route::get('/add-fluid', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addFluids',
	'as' => 'add-fluid',]);

Route::get('/add-complaint-nurse', 
	['uses' => '\OrionMedical\Http\Controllers\NurseController@addComplaint',
	'as' => 'add-complaint-nurse',]);

Route::get('/add-medication', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addMedication',
	'as' => 'add-medication',]);

Route::get('/add-treatment_schedule', 
	['uses' => '\OrionMedical\Http\Controllers\NurseController@addTreatmentSheet',
	'as' => 'add-treatment_schedule',]);

Route::get('/return-medication', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addMedication',
	'as' => 'return-medication',]);


Route::get('/add-medication-no-stock', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addMedicationNoStock',
	'as' => 'add-medication-no-stock',]);

Route::get('/add-investigation', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addInvestigation',
	'as' => 'add-investigation',]);

Route::get('/add-investigation-walkin', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addInvestigationWalkin',
	'as' => 'add-investigation-walkin',]);

Route::post('/add-new-investigation', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addInvestigation',
	'as' => 'add-new-investigation',]);


Route::get('/add-history', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addHistory',
	'as' => 'add-history',]);

Route::get('/add-diagnosis', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addDiagnosis',
	'as' => 'add-diagnosis',]);


Route::get('/add-diagnosis-icd', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addDiagnosisICD',
	'as' => 'add-diagnosis-icd',]);

Route::get('/add-procedure', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addProcedure',
	'as' => 'add-procedure',]);

Route::get('/add-procedure-nurse', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addProcedureNurse',
	'as' => 'add-procedure-nurse',]);

Route::get('/add-future-procedure', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addFutureProcedure',
	'as' => 'add-future-procedure',]);

Route::get('/delete-medication', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeMedication',
	'as' => 'delete-medication',]);

Route::get('/delete-treatment-sheet', 
	['uses' => '\OrionMedical\Http\Controllers\NurseController@excludeTreatment',
	'as' => 'delete-treatment-sheet',]);

Route::get('/patient-nurse-treatment', 
	['uses' => '\OrionMedical\Http\Controllers\NurseController@getTreatment',
	'as' => 'patient-nurse-treatment',]);


Route::get('/delete-medication-pharmacy', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@excludeMedicationPharmacy',
	'as' => 'delete-medication-pharmacy',]);

Route::get('/delete-vital', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeVital',
	'as' => 'delete-vital',]);

Route::get('/delete-fluids', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeFluids',
	'as' => 'delete-fluids',]);

Route::get('/delete-history', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeHistory',
	'as' => 'delete-history',]);

Route::get('/delete-complaint', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeComplain',
	'as' => 'delete-complaint',]);

Route::get('/delete-investigation', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeInvestigation',
	'as' => 'delete-investigation',]);

Route::get('/delete-procedure', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeProcedure',
	'as' => 'delete-procedure',]);

Route::get('/delete-future-procedure', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeProcedurePlan',
	'as' => 'delete-future-procedure',]);

Route::get('/delete-diagnosis', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeDiagnosis',
	'as' => 'delete-diagnosis',]);

Route::get('/delete-lab-result', 
	['uses' => '\OrionMedical\Http\Controllers\LabController@excludeLabResult',
	'as' => 'delete-lab-result',]);

Route::get('/add-vitals', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addVitals',
	'as' => 'add-vitals',]);

Route::get('/delete-plan', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludePlan',
	'as' => 'delete-plan',]);

Route::get('/delete-assessment', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeAssessment',
	'as' => 'delete-assessment',]);

//Events

Route::get('/event-list',
	['uses' => '\OrionMedical\Http\Controllers\EventController@index',
	 'as' => 'event-list', ]);

Route::get('/event-calendar',
	['uses' => '\OrionMedical\Http\Controllers\EventController@calendar',
	 'as' => 'event-calendar', ]);

Route::get('/nurse-calendar',
	['uses' => '\OrionMedical\Http\Controllers\EventController@Nursecalendar',
	 'as' => 'nurse-calendar', ]);

Route::get('/book-appointment',
	['uses' => '\OrionMedical\Http\Controllers\EventController@myappointment',
	 'as' => 'book-appointment', ]);

Route::get('/update-appointment-status',
	['uses' => '\OrionMedical\Http\Controllers\EventController@updateAppointment',
	 'as' => 'update-appointment-status', ]);

Route::post('/create-event',
	['uses' => '\OrionMedical\Http\Controllers\EventController@store',]);

Route::post('/create-event-nurse',
	['uses' => '\OrionMedical\Http\Controllers\EventController@NurseNote',]);



Route::get('/appointments',
	['uses' => '\OrionMedical\Http\Controllers\EventController@appointmentcalendar',
	 'as' => 'appointments', ]);

Route::get('/appointments-for-nurses',
	['uses' => '\OrionMedical\Http\Controllers\EventController@appointmentNurse',
	 'as' => 'appointments-for-nurses', ]);

Route::get('/doctor-appointments/{id}',
	['uses' => '\OrionMedical\Http\Controllers\EventController@doctorappointment',
	 'as' => 'doctor-appointments', ]);

Route::get('/doctor-calendar/{id}',
	['uses' => '\OrionMedical\Http\Controllers\EventController@doctor',
	 'as' => 'doctor-calendar', ]);

Route::get('/service-calendar/{id}',
	['uses' => '\OrionMedical\Http\Controllers\EventController@service',
	 'as' => 'service-calendar', ]);

Route::get('/delete-appointment', 
	['uses' => '\OrionMedical\Http\Controllers\EventController@deleteappointmentfromevent',
	'as' => 'delete-appointment',]);

Route::get('/find-appointment', 
	['uses' => '\OrionMedical\Http\Controllers\EventController@findAppointment', 
	'as' => 'find-appointment', ]);

//Pharmacy

Route::get('/list-of-drugs-avaliable',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@index',
	 'as' => 'list-of-drugs-avaliable', ]);

Route::get('/drugs-pending-approval',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@pendingApproval',
	 'as' => 'drugs-pending-approval', ]);

Route::post('/approve-drug-bulk',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@dobulkApproval',
	 'as' => 'approve-drug-bulk', ]);


Route::get('/consumables-list',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@consumables',
	 'as' => 'consumables-list', ]);


Route::get('/stores',
	['uses' => '\OrionMedical\Http\Controllers\StoreController@index',
	 'as' => 'stores', ]);



Route::get('/fetch-invoices', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@fetchInvoice',
	'as' => 'fetch-invoices',]);


Route::get('/fetch-invoices-consumable', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@fetchInvoiceConsumable',
	'as' => 'fetch-invoices-consumable',]);



Route::get('/fetch-invoices-for-upload', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@fetchInvoiceforupload',
	'as' => 'fetch-invoices-for-upload',]);

Route::get('/add-drug-invoice', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@addInvoices',
	'as' => 'add-drug-invoice',]);


Route::get('/add-consumable-invoice', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@addInvoicesConsumable',
	'as' => 'add-consumable-invoice',]);


Route::get('/expired-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@expired',
	 'as' => 'expired-drugs', ]);

Route::get('/flagged-expired-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@flaggedExpired',
	 'as' => 'flagged-expired-drugs', ]);

Route::get('/flagged-low-stock',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@flaggedLowStock',
	 'as' => 'flagged-low-stock', ]);

Route::get('/download-flagged-low-stock',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@exportFlagged',
	 'as' => 'download-flagged-low-stock', ]);

Route::get('/download-expired-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@exportExpired',
	 'as' => 'download-expired-drugs', ]);

Route::get('/damaged-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@damaged',
	 'as' => 'damaged-drugs', ]);


Route::get('/expired-reported-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@reportedExpire',
	 'as' => 'expired-reported-drugs', ]);


Route::get('/transfered-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@reportedTransfer',
	 'as' => 'transfered-drugs', ]);


Route::get('/search-invoice',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getSearchInvoice',
	 'as' => 'search-invoice', ]);



Route::get('/returned-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@reportedRetun',
	 'as' => 'returned-drugs', ]);

Route::get('/drug-suppliers',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@supplier',
	 'as' => 'drug-suppliers', ]);


Route::get('/stock-level-transactions',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@stockaudit',
	 'as' => 'stock-level-transactions', ]);


Route::get('/supplier-payments',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@supplierpayments',
	 'as' => 'supplier-payments', ]);

Route::get('/supplier-purchases',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@supplierpurchases',
	 'as' => 'supplier-purchases', ]);

Route::get('/supplier-bills',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@supplierbills',
	 'as' => 'supplier-bills', ]);

Route::get('/print-store-voucher/{id}',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@printVoucher',
	 'as' => 'print-store-voucher', ]);


Route::get('/edit-supplier-bills',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getInvoiceDetails',
	 'as' => 'edit-supplier-bills', ]);

Route::get('/edit-supplier-bills-consumables',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getInvoiceDetailsConsumable',
	 'as' => 'edit-supplier-bills-consumables', ]);



Route::get('/approve-invoice',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@approveInvoice',
	 'as' => 'approve-invoice', ]);

Route::get('/approve-requisition',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@approveRequisition',
	 'as' => 'approve-requisition', ]);


Route::get('/upload-invoice',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@dobulkUpload',
	 'as' => 'upload-invoice', ]);

Route::get('/delete-invoice',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@deleteInvoice',
	 'as' => 'delete-invoice', ]);

Route::get('/delete-invoice-item',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@deleteInvoiceItem',
	 'as' => 'delete-invoice-item', ]);


Route::get('/report-dispensed-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@reportDispensed',
	 'as' => 'report-dispensed-drugs', ]);

Route::get('/report-mpharma-drugs',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@reportmPharma',
	 'as' => 'report-mpharma-drugs', ]);


Route::get('/pharmacy-settings',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@setting',
	 'as' => 'pharmacy-settings', ]);



Route::get('/prescriptions-pending',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getPrescriptions',
	 'as' => 'prescriptions-pending', ]);

Route::get('/prescriptions-dispensed',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getPrescriptionsDispensed',
	 'as' => 'prescriptions-dispensed', ]);

Route::get('/print-prescription/{id}',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@printPrescription',
	 'as' => '/print-prescription/{id}', ]);

Route::post('/dispense-medication', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@dispenseMedication',
	'as' => 'dispense-medication',]);

Route::post('/return-medication', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@returnMedication',
	'as' => 'return-medication',]);


Route::get('/dispense-medication-master/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getPendingMedication',
	'as' => 'dispense-medication-master',]);

Route::get('/medication-to-dispense', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getMedicationtoDispense',
	'as' => 'medication-to-dispense',]);


Route::get('/medication-dispensed-to-patient', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getDispensedMedication',
	'as' => 'medication-dispensed-to-patient',]);

Route::get('/medication-returned-to-patient', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getReturnedMedication',
	'as' => 'medication-returned-to-patient',]);


Route::get('/pharmacy.dashboard',
	['uses' => '\OrionMedical\Http\Controllers\DrugController@dashboard',
	 'as' => 'pharmacy.dashboard', ]);

Route::post('/update-prescription-status', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@doPrescriptionUpdate',
	'as' => 'update-prescription-status',]);


Route::post('/update-service', 
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@updateService',
	'as' => 'update-service',]);


Route::post('/save-drug', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@addNewMedication',
	'as' => 'save-drug',]);


Route::post('/save-consumable', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@addNewConsumable',
	'as' => 'save-consumable',]);

Route::post('/assign-consumable', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@assignConsumables',
	'as' => 'assign-consumable',]);

Route::post('/update-drug-details', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@updateMedication',
	'as' => 'update-drug-details',]);


Route::post('/update-drug-stock-level', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@updateMedicationStockLevel',
	'as' => 'update-drug-stock-level',]);


Route::post('/update-consumable-details', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@updateConsumable',
	'as' => 'update-consumable-details',]);

Route::post('/add-damaged-details', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@addDamagedDrug',
	'as' => 'add-damaged-details',]);

Route::post('/add-expired-details', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@addExpiredDrug',
	'as' => 'add-expired-details',]);


Route::get('/get-prescription', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getPendingPrescription',
	'as' => 'get-prescription',]);

Route::get('/find-drugs', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@findDrug', 
	'as' => 'find-drugs', ]);

Route::get('/find-consumable', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@findConsumable', 
	'as' => 'find-consumable', ]);

Route::get('/drug-settings', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@categories', 
	'as' => 'drug-settings', ]);

Route::get('/drug-reports', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@reports', 
	'as' => 'drug-reports', ]);

Route::get('/delete-drug', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@deletedrugfromstore',
	'as' => 'delete-drug',]);

Route::get('/delete-consumable', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@deleteconsumablefromstore',
	'as' => 'delete-consumable',]);

Route::get('/get-drug-detail', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getStockDetails',
	'as' => 'get-drug-detail',]);

Route::get('/get-consumable-detail', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getConusmableDetails',
	'as' => 'get-consumable-detail',]);

Route::get('/get-drug-info', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getDrugInfo',
	'as' => 'get-drug-info',]);


Route::get('/get-consumable-info', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getConsumableInfo',
	'as' => 'get-consumable-info',]);


Route::get('/get-drug-availability', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@getDrugCount',
	'as' => 'get-drug-availability',]);

Route::get('/find-prescription', 
	['uses' => '\OrionMedical\Http\Controllers\DrugController@findPrescription', 
	'as' => 'find-prescription', ]);


//Company Info

Route::post('/add-service',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@addNewService',
	 'as' => 'add-service', ]);

Route::get('/delete-service-charge', 
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@deleteService',
	'as' => 'delete-service-charge',]);

Route::get('/delete-insurer', 
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@deleteInsurance',
	'as' => 'delete-insurer',]);

Route::post('/add-insurance-company',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@addInsuranceCompany',
	 'as' => 'add-insurance-company', ]);

Route::get('/delete-company', 
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@deleteCompany',
	'as' => 'delete-company',]);

Route::post('/add-company',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@addCompany',
	 'as' => 'add-company', ]);


Route::get('/company.index',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@index',
	 'as' => 'company.index', ]);

Route::get('/settings',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@settings',
	 'as' => 'settings', ]);

Route::get('/service-charges',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@servicecharges',
	 'as' => 'service-charges', ]);

Route::get('/insurance-company',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@healthinsurance',
	 'as' => 'insurance-company', ]);

Route::get('/registered-companies',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@companies',
	 'as' => 'registered-companies', ]);

Route::get('/departments',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@department',
	 'as' => 'departments', ]);

Route::get('/complaints',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@complaint',
	 'as' => 'complaints', ]);

Route::get('/search-service',
	['uses' => '\OrionMedical\Http\Controllers\CompanyController@getservicesearch',
	 'as' => 'search-service', ]);


//Dietian
Route::get('/dietian-review',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@dietian',
	 'as' => 'dietian-review', ]);

Route::get('/compute-harris-benedict-male',
	['uses' => '\OrionMedical\Http\Controllers\DietianController@computeHarrisBenedictMale',
	 'as' => 'compute-harris-benedict-male', ]);

Route::get('/compute-harris-benedict-female',
	['uses' => '\OrionMedical\Http\Controllers\DietianController@computeHarrisBenedictFemale',
	 'as' => 'compute-harris-benedict-female', ]);


Route::get('/laboratory-review',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@laboratory',
	 'as' => 'laboratory-review', ]);

Route::get('/consultation/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@doConsulation',
	'as' => 'consultation',]);

Route::get('/psycho-review/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@psychoConsulation',
	'as' => 'psycho-review',]);

Route::get('/dietetic-review/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@dietianConsultation',
	'as' => 'dietetic-review',]);

Route::get('/consultation-ipd/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@doConsulationIPD',
	'as' => 'consultation',]);

Route::get('/dental', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@dental',
	'as' => 'dental',]);

Route::get('/dental-review/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@doDentalReview',
	'as' => 'dental-review/',]);

Route::get('/print-after-dental-surgery/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printAfterDentalSurgery',
	'as' => 'print-after-dental-surgery/',]);

Route::get('/print-after-denture/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printAfterDenture',
	'as' => 'print-after-denture/',]);

Route::get('/print-dental-consent/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@printDentalConsent',
	'as' => 'print-dental-consent/',]);


Route::get('/dental-reviewed', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@dentalReviewed',
	'as' => 'dental-reviewed',]);

Route::get('/add-antenatal-records', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addAntenatalRecords',
	'as' => 'add-antenatal-records',]);


Route::get('/get-antenatal-records', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getAntenatalRecords',
	'as' => 'get-antenatal-records',]);

Route::get('/delete-antenatal-records', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@excludeAntenatalRecord',
	'as' => 'delete-antenatal-records',]);

Route::get('/antenatal-review/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@doantenatalReview',
	'as' => 'antenatal-review/',]);

Route::get('/ophthalmology', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@ophthalmology',
	'as' => 'ophthalmology',]);

Route::get('/ophthalmology-review/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@doOphthalmologyReview',
	'as' => 'ophthalmology-review/',]);

Route::get('/ophthalmology-reviewed', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@ophthalmologyReviewed',
	'as' => 'ophthalmology-reviewed',]);

Route::get('/add-eye-finding', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addEyeFinding',
	'as' => 'add-eye-finding',]);

Route::get('/add-ocular-finding', 
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@addOcularFinding',
	'as' => 'add-ocular-finding',]);


Route::get('/patient-age-occupation',
	['uses' => '\OrionMedical\Http\Controllers\DoctorController@getAgeOccupation',
	 'as' => 'patient-age-occupation', ]);

//Reports routes
Route::get('/medical-reports',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@medicalreports',
	 'as' => 'medical-reports', ]);



Route::get('/bill-listing',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@billlisting',
	 'as' => 'bill-listing', ]);


Route::get('/locum-sheet',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@locumsheet',
     'as' => 'locum-sheet', ]);


Route::get('/collection-summary',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@collectionsummary',
     'as' => 'collection-summary', ]);


Route::get('/patient-list',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@patientlist',
	 'as' => 'patient-list', ]);


Route::get('/patient-visit-stats',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@patientvisits',
     'as' => 'patient-visit-stats', ]);


Route::get('/patient-doctor-ratio',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@patientdoctorratio',
     'as' => 'patient-doctor-ratio', ]);

Route::get('/vital-temperature',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@vitaltemperature',
     'as' => 'vital-temperature', ]);

Route::get('/vital-blood-pressure',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@vitalbloodpressure',
     'as' => 'vital-blood-pressure', ]);

Route::get('/vital-bmi',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@vitalbmi',
     'as' => 'vital-bmi', ]);

Route::get('/morbidity-assessment',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@morbidityassessment',
     'as' => 'morbidity-assessment', ]);



Route::get('/medical-summary-consultation',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@summaryConsultation',
	 'as' => 'medical-summary-consultation', ]);


Route::get('/medical-summary-department',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@summarydepartment',
     'as' => 'medical-summary-department', ]);


Route::get('/medical-summary-department-all',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@summarydepartmentall',
     'as' => 'medical-summary-department-all', ]);


Route::get('/medical-summary-department-count',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@summarydepartmentcount',
     'as' => 'medical-summary-department-count', ]);


Route::get('/medical-summary-doctors',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@summarydoctors',
     'as' => 'medical-summary-doctors', ]);


Route::get('/medical-summary-pharmarcy',
    ['uses' => '\OrionMedical\Http\Controllers\ReportController@summarypharmacy',
     'as' => 'medical-summary-pharmarcy', ]);





Route::get('/add-template',
	['uses' => '\OrionMedical\Http\Controllers\LabController@newrequest',
	 'as' => 'add-template', ]);

Route::get('/saved-documents',
	['uses' => '\OrionMedical\Http\Controllers\ImageController@getSavedDocuments',
	 'as' => 'saved-documents', ]);


 //  Event::listen('illuminate.query', function($query)
 // {
 //     var_dump($query);
 // });




