<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

#JNE_API
use App\Http\Controllers\Api\Jne_api\GetProvinceController;
use App\Http\Controllers\Api\Jne_api\GetCityController;
use App\Http\Controllers\Api\Jne_api\GetDistrictController;
use App\Http\Controllers\Api\Jne_api\GetSubDistrictController;

#Jenis Toko
use App\Http\Controllers\Api\Jne_api\GetJenisTokoController;

#Type Outlet
use App\Http\Controllers\Api\Type_outlet\GetTypeOutletController;

#Outlet
use App\Http\Controllers\Api\Outlet\GetOutletController;
use App\Http\Controllers\Api\Outlet\PostOutletController;

#ContactPerson
use App\Http\Controllers\Api\Contact_person\GetContactPersonController;
use App\Http\Controllers\Api\Contact_person\PostContactPersonController;

#ImagesOutlet
use App\Http\Controllers\Api\Images_outlet\GetImagesOutletController;
use App\Http\Controllers\Api\Images_outlet\PostImagesOutletController;

#Distributor
use App\Http\Controllers\Api\Distributor\GetDistributorController;
use App\Http\Controllers\Api\Distributor\PostDetailDistributorController;
use App\Http\Controllers\Api\Distributor\GetDetailDistributorController;

#General
use App\Http\Controllers\Api\General\GetGeneralController;
use App\Http\Controllers\Api\General\PostGeneralController;

#Attachement
use App\Http\Controllers\Api\Attachment\PostAttachmentController;
use App\Http\Controllers\Api\Attachment\GetAttachmentController;

#Dashboard
use App\Http\Controllers\Api\Dashboard\GetDashboardController;

#Legal
use App\Http\Controllers\Api\Legal\PostLegalController;

#Bank
use App\Http\Controllers\Api\Bank\GetBankController;

#Account
use App\Http\Controllers\Api\Account\PostAccountController;

#Brand
use App\Http\Controllers\Api\Brand\GetBrandController;

#Detail
use App\Http\Controllers\Api\Detail_General\GetDetailGeneralController;
use App\Http\Controllers\Api\Distributor\EditDistributorController;

#Berkas
use App\Http\Controllers\Api\Berkas_General\GetBerkasGeneralController;
use App\Http\Controllers\Api\Berkas_General\GetBerkasLegalController;
use App\Http\Controllers\Api\Berkas_General\GetBerkasContactController;
use App\Http\Controllers\Api\Berkas_General\GetBerkasOutletController;
use App\Http\Controllers\Api\Berkas_General\GetBerkasDistributorController;
use App\Http\Controllers\Api\Berkas_General\GetBerkasAccountController;
use App\Http\Controllers\Api\Berkas_General\UpdateBerkasLegalController;
use App\Http\Controllers\Api\Berkas_General\UpdateBerkasContactController;
use App\Http\Controllers\Api\Berkas_General\UpdateBerkasDistributorController;
use App\Http\Controllers\Api\Berkas_General\UpdateBerkaSAccountController;
use App\Http\Controllers\Api\Berkas_General\UpdateBerkasOutletController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('postImageOutlet', [PostImageController::class, 'store']);

Route::post('scan_qrcode', [PostImageController::class, 'scan']);




#Jenis Toko
Route::get('getjenistoko', [GetJenisTokoController::class, 'index']);


Route::post('/upload-csvs', [App\Http\Controllers\UploadCsvController::class, 'index'])->name('upload.csv');
Route::post('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance');
Route::post('/postLaporan', [App\Http\Controllers\LaporanSalesController::class, 'store'])->name('laporan');
// routes/web.php
Route::get('/attendance-id/{id}', [App\Http\Controllers\AttendanceController::class, 'getAttendanceDetails']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);

    #General Endpoint
    Route::get('getGeneral', [GetGeneralController::class, 'index']);
    Route::post('postGeneral', [PostGeneralController::class, 'index']);

    #Dashboard
    Route::get('getDashboard', [GetDashboardController::class, 'index']);

    #Type Outlet
    Route::get('getTypeOutlet', [GetTypeOutletController::class, 'index']);

    #Outlet
    Route::get('getoutlet', [GetOutletController::class, 'index']);
    Route::post('postOutlet', [PostOutletController::class, 'index']);

    #ContactPerson
    Route::get('getcontactperson', [GetContactPersonController::class, 'index']);
    Route::post('postContactPerson', [PostContactPersonController::class, 'index']);

    #ImagesOutlet
    Route::get('getimagesoutlet', [GetImagesOutletController::class, 'index']);
    Route::post('postImagesOutlet', [PostImagesOutletController::class, 'index']);

    #Distributor
    Route::get('getDistributor', [GetDistributorController::class, 'index']);
    Route::get('getListDistributor', [GetDetailDistributorController::class, 'index']);
    Route::post('editDistributor', [EditDistributorController::class, 'index']);
    Route::delete('deleteListDistributor', [GetDetailDistributorController::class, 'destroy']);
    Route::post('postDetailDistributor', [PostDetailDistributorController::class, 'index']);

    #Legal
    Route::post('postLegal', [PostLegalController::class, 'index']);

    #Bank
    Route::get('getBank', [GetBankController::class, 'index']);

    #Brand
    Route::get('getBrand', [GetBrandController::class, 'index']);

    #Account
    Route::post('postAccount', [PostAccountController::class, 'index']);

    #Attachement
    Route::post('postAttchement', [PostAttachmentController::class, 'index']);
    Route::get('getAttchement', [GetAttachmentController::class, 'index']);

    #Detail
    Route::get('getDetail', [GetDetailGeneralController::class, 'index']);

    #Berkas
    Route::get('getBerkas', [GetBerkasGeneralController::class, 'index']);
    Route::get('getBerkasLegal', [GetBerkasLegalController::class, 'index']);
    Route::post('UpdateBerkasLegal', [UpdateBerkasLegalController::class, 'index']);
    Route::delete('deleteListLegal', [GetBerkasLegalController::class, 'destroy']);
    Route::get('getBerkasContact', [GetBerkasContactController::class, 'index']);
    Route::delete('deleteListContact', [GetBerkasContactController::class, 'destroy']);
    Route::post('UpdateBerkasContact', [UpdateBerkasContactController::class, 'index']);
    Route::get('getBerkasOutlet', [GetBerkasOutletController::class, 'index']);
    Route::post('generateQrCode', [GetBerkasOutletController::class, 'generate_qrcode']);
    Route::post('UpdateBerkasOutlet', [UpdateBerkasOutletController::class, 'index']);
    Route::delete('deleteListOutlet', [GetBerkasOutletController::class, 'destroy']);
    Route::delete('deleteListImage', [UpdateBerkasOutletController::class, 'destroy']);
    Route::get('getBerkasDistributor', [GetBerkasDistributorController::class, 'index']);
    Route::post('UpdateBerkasDistributor', [UpdateBerkasDistributorController::class, 'index']);
    Route::get('getIdOutlet', [GetBerkasDistributorController::class, 'getOutlet']);
    Route::delete('deleteListDistributor', [GetBerkasDistributorController::class, 'destroy']);
    Route::get('getBerkasAccount', [GetBerkasAccountController::class, 'index']);
    Route::delete('deleteListAccount', [GetBerkasAccountController::class, 'destroy']);
    Route::post('UpdateBerkasAccount', [UpdateBerkaSAccountController::class, 'index']);

    #JNE Endpoint
    Route::get('getProvince', [GetProvinceController::class, 'index']);
    Route::get('getCity', [GetCityController::class, 'index']);
    Route::get('getDistrict', [GetDistrictController::class, 'index']);
    Route::get('getSubDistrict', [GetSubDistrictController::class, 'index']);

    #Testing Single Photo
    Route::post('postOutletSingle', [PostOutletController::class, 'singlePhoto']);
});
