    <?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;

    use App\Http\Controllers\Front\FrontLoginController;
    use App\Http\Controllers\DashboardController;

    use App\Http\Controllers\Front\FrontLandingController;
    use App\Http\Controllers\Front\FrontNewsController;
    use App\Http\Controllers\Front\FrontNewsCategoryController;
    use App\Http\Controllers\Front\FrontProductController;


    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\PermissionController;
    use App\Http\Controllers\AccessController;
    use App\Http\Controllers\WebsetupController;

    use App\Http\Controllers\Auth\ForgotPasswordController;

    // General
    use App\Http\Controllers\GeneralController;

    // Legal
    use App\Http\Controllers\LegalController;

    // Contact Person
    use App\Http\Controllers\ContactPersonController;

    // Account
    use App\Http\Controllers\AccountController;

    // Attachment
    use App\Http\Controllers\AttachmentController;

    // Outlet
    use App\Http\Controllers\OutletController;

    // Type Outlet
    use App\Http\Controllers\TypeOutletController;

    // Bank
    use App\Http\Controllers\BankController;

    // Distributor
    use App\Http\Controllers\DistributorController;

    // Detail Distributor
    use App\Http\Controllers\DetailDistributorController;

    // Brand
    use App\Http\Controllers\BrandController;

    // Maps
    use App\Http\Controllers\MapsController;

    //Area
    use App\Http\Controllers\AreaController;

    //Jadwal Check IN/OUT
    use App\Http\Controllers\CheckController;

    //kunjungan
    use App\Http\Controllers\KunjunganController;

    //jadwal
    use App\Http\Controllers\JadwalController;

    //Report
    use App\Http\Controllers\ReportSalesController;





    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::get('/crudbuilder', [CrudBuilderController::class, 'index']);

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


    Auth::routes();

    Route::get('file', [FileController::class, 'create']);
    Route::post('file', [FileController::class, 'store']);

    //Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'index']);


    Route::group(['middleware' => ['auth']], function () {
        Route::resource('admin/dashboard', DashboardController::class);
        Route::resource('admin/websetup', WebsetupController::class);
        Route::resource('member/board', MemberBoardController::class);
        Route::resource('fpdf', FpdfController::class);
        Route::resource('sync-product', SyncProductController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('access', AccessController::class);

        // Type Outlet
        Route::resource('admin/type_outlet', TypeOutletController::class);

        // Bank
        Route::resource('admin/bank', BankController::class);

        // Brand
        Route::resource('admin/brand', BrandController::class);

        // Distributor
        Route::resource('admin/distributor', DistributorController::class);

        // Detail Distributor
        Route::resource('admin/dtail_distributor', DetailDistributorController::class);

        //Maps
        Route::resource('admin/maps', MapsController::class);

        //Area
        Route::resource('admin/area', AreaController::class);

        //Checkin & Chekcout
        Route::get('checkin', [App\Http\Controllers\CheckController::class, 'checkin'])->name('check.checkin');
        Route::get('checkout', [App\Http\Controllers\CheckController::class, 'checkout'])->name('check.checkout');


        // General Informations
        Route::resource('admin/generals', GeneralController::class);
        Route::get('admin/generals/destroy/{id}', 'App\Http\Controllers\GeneralController@destroy');

        // Legal
        Route::get('admin/legal/destroy/{id}', [App\Http\Controllers\LegalController::class, 'destroy']);

        // Contact Person
        Route::get('admin/contact_person/destroy/{id}', [App\Http\Controllers\ContactPersonController::class, 'destroy']);

        // Account
        Route::get('admin/account/destroy/{id}', [App\Http\Controllers\AccountController::class, 'destroy']);

        // Attachment
        Route::get('admin/attachment/destroy/{id}', [App\Http\Controllers\AttachmentController::class, 'destroy']);

        //Kunjungan Sales
        Route::resource('kunjungan', KunjunganController::class);
        Route::get('laporan/{general_id}/{jadwal_id}', [App\Http\Controllers\KunjunganController::class, 'laporan'])->name('kunjungan.laporan');
        Route::post('/post-laporan', [App\Http\Controllers\LaporanSalesController::class, 'store'])->name('laporan.post');
        Route::put('/update-laporan', [App\Http\Controllers\LaporanSalesController::class, 'update'])->name('laporan.update');
        Route::delete('/delete-gambar/{gambar}', [App\Http\Controllers\LaporanSalesController::class, 'deleteGambar'])->name('delete-gambar');

        Route::post('/leads/store', [App\Http\Controllers\Lead\LeadController::class, 'store'])->name('leads.store');

        //Penjadwalan Kunjungan
        Route::resource('jadwal', JadwalController::class);
        Route::get('create-detailJadwal/{id}', [App\Http\Controllers\DetailJadwal\DetailJadwalController::class, 'index'])->name('jadwal.addJadwal');
        Route::get('edit-detailJadwal/{id}', [App\Http\Controllers\DetailJadwal\EditDetailJadwalController::class, 'index'])->name('edit.jadwal.addJadwal');

        Route::post('/update-detail-jadwal', [App\Http\Controllers\DetailJadwal\EditDetailJadwalController::class, 'store'])->name('update.detail.jadwal');

        //Report Sales
        Route::get('report-sales', [App\Http\Controllers\ReportSalesController::class, 'index'])->name('reportsales.index');
        // Route::get('Export-Report-Visit', [App\Http\Controllers\ReportSalesController::class, 'exportrekapvisit'])->name('reportsales.rekapvisit');
        Route::get('PreviewRekapVisit', [App\Http\Controllers\ReportSalesController::class, 'previewrekapvisit'])->name('reportsales.rekapPreview');




        Route::get('getByidDetailJadwal', [App\Http\Controllers\DetailJadwal\DetailJadwalController::class, 'getDataById'])->name('byid.detailjadwal');
        Route::get('createJadwal', [App\Http\Controllers\JadwalController::class, 'create'])->name('jadwal.createJadwal');
        Route::get('exportJadwal', [App\Http\Controllers\JadwalController::class, 'exportJadwal'])->name('jadwal.exportJadwal');
        Route::get('previewJadwal', [App\Http\Controllers\JadwalController::class, 'previewJadwal'])->name('jadwal.previewJadwal');
        Route::get('jadwal/{id}/edit', [App\Http\Controllers\JadwalController::class, 'edit'])->name('edit.jadwal');
        Route::put('jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'update'])->name('update.jadwal');
        Route::post('save-jadwal', [App\Http\Controllers\JadwalController::class, 'store'])->name('save.jadwal');
        Route::post('save-detail-jadwal', [App\Http\Controllers\DetailJadwal\StoreDetailJadwalController::class, 'store'])->name('save.detail.jadwal');

        Route::delete('jadwal-detail/{id}', [App\Http\Controllers\DetailJadwal\DetailJadwalController::class, 'destroy'])->name('delete.detail.jadwal');
        Route::get('reports', [App\Http\Controllers\JadwalController::class, 'getGeneralInformationsByMonth']);


    });

    Route::post('admin/roles/store', [App\Http\Controllers\RoleController::class, 'store']);
    Route::get('admin/roles/show/{id}', [App\Http\Controllers\RoleController::class, 'show']);
    Route::post('admin/roles/update/{id}', [App\Http\Controllers\RoleController::class, 'update']);
    Route::get('admin/roles/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy']);

    Route::post('admin/access/store', [App\Http\Controllers\AccessController::class, 'store']);
    Route::get('admin/access/show/{id}', [App\Http\Controllers\AccessController::class, 'show']);
    Route::get('admin/access/showRole/{id}', [App\Http\Controllers\AccessController::class, 'showRole']);
    Route::get('admin/access/showPermission/{id}', [App\Http\Controllers\AccessController::class, 'showPermission']);
    Route::get('admin/access/destroy/{id}', [App\Http\Controllers\AccessController::class, 'destroy']);

    Route::post('admin/permissions/store', [App\Http\Controllers\PermissionController::class, 'store']);
    Route::get('admin/permissions/show/{id}', [App\Http\Controllers\PermissionController::class, 'show']);
    Route::post('admin/permissions/update/{id}', [App\Http\Controllers\PermissionController::class, 'update']);
    Route::get('admin/permissions/destroy/{id}', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::post('admin/type_outlet/store', [App\Http\Controllers\TypeOutletController::class, 'store']);
    Route::get('admin/type_outlet/show/{id}', [App\Http\Controllers\TypeOutletController::class, 'show']);
    Route::post('admin/type_outlet/update/{id}', [App\Http\Controllers\TypeOutletController::class, 'update']);
    Route::get('admin/type_outlet/destroy/{id}', [App\Http\Controllers\TypeOutletController::class, 'destroy']);

    Route::post('admin/bank/store', [App\Http\Controllers\BankController::class, 'store']);
    Route::get('admin/bank/show/{id}', [App\Http\Controllers\BankController::class, 'show']);
    Route::post('admin/bank/update/{id}', [App\Http\Controllers\BankController::class, 'update']);
    Route::get('admin/bank/destroy/{id}', [App\Http\Controllers\BankController::class, 'destroy']);

    Route::post('admin/brand/store', [App\Http\Controllers\BrandController::class, 'store']);
    Route::get('admin/brand/show/{id}', [App\Http\Controllers\BrandController::class, 'show']);
    Route::post('admin/brand/update/{id}', [App\Http\Controllers\BrandController::class, 'update']);
    Route::get('admin/brand/destroy/{id}', [App\Http\Controllers\BrandController::class, 'destroy']);

    Route::post('admin/area/store', [App\Http\Controllers\AreaController::class, 'store']);
    Route::get('admin/area/show/{id}', [App\Http\Controllers\AreaController::class, 'show']);
    Route::post('admin/area/update/{id}', [App\Http\Controllers\AreaController::class, 'update']);
    Route::get('admin/area/destroy/{id}', [App\Http\Controllers\AreaController::class, 'destroy']);
    Route::get('get_area_id', [App\Http\Controllers\AreaController::class, 'get_area_id']);

    Route::post('admin/distributor/store', [App\Http\Controllers\DistributorController::class, 'store']);
    Route::get('admin/distributor/show/{id}', [App\Http\Controllers\DistributorController::class, 'show']);
    Route::post('admin/distributor/update/{id}', [App\Http\Controllers\DistributorController::class, 'update']);
    Route::get('admin/distributor/destroy/{id}', [App\Http\Controllers\DistributorController::class, 'destroy']);
    Route::get('admin/distributor/get_kota_edit_dist/{id}', [App\Http\Controllers\DistributorController::class, 'get_kota_edit_dist']);
    Route::get('admin/distributor/get_kecamatan_edit_dist/{id}', [App\Http\Controllers\DistributorController::class, 'get_kecamatan_edit_dist']);
    Route::get('admin/distributor/get_kelurahan_edit_dist/{id}', [App\Http\Controllers\DistributorController::class, 'get_kelurahan_edit_dist']);

    Route::post('admin/generals/store', [App\Http\Controllers\GeneralController::class, 'store']);
    Route::post('admin/generals/generate_id_customer', [App\Http\Controllers\GeneralController::class, 'generate_id_customer']);
    Route::get('admin/generals/show/{id}', [App\Http\Controllers\GeneralController::class, 'show'])->name('generals.show');
    Route::get('admin/generals/atribut/{id}', [App\Http\Controllers\GeneralController::class, 'atribut']);
    Route::get('admin/generals/update/{id}', [App\Http\Controllers\GeneralController::class, 'update']);
    Route::get('admin/generals/berkas/{id}', [App\Http\Controllers\GeneralController::class, 'berkas']);
    Route::get('admin/generals/outlet/{id}', [App\Http\Controllers\GeneralController::class, 'outlet']);
    Route::get('admin/general/visit/{id}', [App\Http\Controllers\GeneralController::class, 'visit'])->name('generals.visit');
    Route::post('export_excel_general', [App\Http\Controllers\GeneralController::class, 'export_excel_general'])->name('generals.export_excel_general');
    Route::post('export_excel_outlet', [App\Http\Controllers\GeneralController::class, 'export_excel_outlet'])->name('generals.export_excel_outlet');
    Route::get('generate/{id}', [App\Http\Controllers\GeneralController::class, 'generate_qrcode'])->name('generals.generate');
    Route::post('scan_qrcode', [App\Http\Controllers\GeneralController::class, 'scan_qrcode'])->name('generals.scan');

    Route::get('admin/outlet/show_form/{id}', [App\Http\Controllers\OutletController::class, 'show_form']);
    Route::get('admin/outlet/show_draf_id', [App\Http\Controllers\OutletController::class, 'show_draf_id']);
    Route::get('admin/outlet/show_data_general', [App\Http\Controllers\OutletController::class, 'show_data_general']);
    Route::get('admin/outlet/get_kota/{id}', [App\Http\Controllers\OutletController::class, 'get_kota']);
    Route::get('admin/outlet/get_kota_edit_outlet/{id}', [App\Http\Controllers\OutletController::class, 'get_kota_edit_outlet']);
    Route::get('admin/outlet/get_kecamatan', [App\Http\Controllers\OutletController::class, 'get_kecamatan']);
    Route::get('admin/outlet/get_kecamatan_edit_outlet/{id}', [App\Http\Controllers\OutletController::class, 'get_kecamatan_edit_outlet']);
    Route::get('admin/outlet/get_kelurahan', [App\Http\Controllers\OutletController::class, 'get_kelurahan']);
    Route::get('admin/outlet/get_kelurahan_edit_outlet/{id}', [App\Http\Controllers\OutletController::class, 'get_kelurahan_edit_outlet']);
    Route::post('admin/outlet/get_kode_pos', [App\Http\Controllers\OutletController::class, 'get_kode_pos']);
    Route::post('admin/outlet/store', [App\Http\Controllers\OutletController::class, 'store']);
    Route::post('admin/outlet/generate_id_outlet', [App\Http\Controllers\OutletController::class, 'generate_id_outlet']);
    Route::post('admin/outlet/generate_id_outlet_berkas', [App\Http\Controllers\OutletController::class, 'generate_id_outlet_berkas']);
    Route::get('admin/outlet/get_distributor_draft_id/{id}', [App\Http\Controllers\OutletController::class, 'get_distributor_draft_id']);
    Route::get('admin/outlet/get_distributor_outlet/{id}', [App\Http\Controllers\OutletController::class, 'get_distributor_outlet']);
    Route::get('admin/outlet/show/{id}', [App\Http\Controllers\OutletController::class, 'show']);
    Route::post('admin/outlet/update/{id}', [App\Http\Controllers\OutletController::class, 'update']);
    Route::get('admin/outlet/get_images_outlet/{id}', [App\Http\Controllers\OutletController::class, 'get_images_outlet']);
    Route::get('admin/outlet/destroy/{id}', [App\Http\Controllers\OutletController::class, 'destroy']);
    Route::get('admin/outlet/deleteFoto/{id}', [App\Http\Controllers\OutletController::class, 'deleteFoto']);

    Route::get('admin/detail_distributor/show_form/{id}', [App\Http\Controllers\DetailDistributorController::class, 'show_form']);
    Route::post('admin/detail_distributor/store', [App\Http\Controllers\DetailDistributorController::class, 'store']);
    Route::get('admin/detail_distributor/show/{id}', [App\Http\Controllers\DetailDistributorController::class, 'show']);
    Route::get('admin/detail_distributor/show_id_outlet/{id}', [App\Http\Controllers\DetailDistributorController::class, 'show_id_outlet']);
    Route::get('admin/detail_distributor/show_draf_id_outlet/{id}', [App\Http\Controllers\DetailDistributorController::class, 'show_draf_id_outlet']);
    Route::get('admin/detail_distributor/tampilDetailDistributor/{id}', [App\Http\Controllers\DetailDistributorController::class, 'tampilDetailDistributor']);
    Route::post('admin/detail_distributor/update/{id}', [App\Http\Controllers\DetailDistributorController::class, 'update']);
    Route::get('admin/detail_distributor/destroy/{id}', [App\Http\Controllers\DetailDistributorController::class, 'destroy']);

    Route::get('admin/legal/show_form/{id}', [App\Http\Controllers\LegalController::class, 'show_form']);
    Route::post('admin/legal/store', [App\Http\Controllers\LegalController::class, 'store']);
    Route::get('admin/legal/show/{id}', [App\Http\Controllers\LegalController::class, 'show']);
    Route::post('admin/legal/update/{id}', [App\Http\Controllers\LegalController::class, 'update']);

    Route::post('admin/contact_person/store', [App\Http\Controllers\ContactPersonController::class, 'store']);
    Route::get('admin/contact_person/show/{id}', [App\Http\Controllers\ContactPersonController::class, 'show']);
    Route::post('admin/contact_person/update/{id}', [App\Http\Controllers\ContactPersonController::class, 'update']);

    Route::get('admin/account/show_form/{id}', [App\Http\Controllers\AccountController::class, 'show_form']);
    Route::post('admin/account/store', [App\Http\Controllers\AccountController::class, 'store']);
    Route::get('admin/account/show/{id}', [App\Http\Controllers\AccountController::class, 'show']);
    Route::post('admin/account/update/{id}', [App\Http\Controllers\AccountController::class, 'update']);

    Route::get('admin/attachment/show_form/{id}', [App\Http\Controllers\AttachmentController::class, 'show_form']);
    Route::post('admin/attachment/store', [App\Http\Controllers\AttachmentController::class, 'store']);

    Route::post('admin/status_data/store', [App\Http\Controllers\StatusDataController::class, 'store']);
    Route::get('admin/status_data/show/{id}', [App\Http\Controllers\StatusDataController::class, 'show']);
    Route::post('admin/status_data/update/{id}', [App\Http\Controllers\StatusDataController::class, 'update']);

    Route::get('show_all_outlet', [App\Http\Controllers\MapsController::class, 'show_all']);
    Route::get('show_all_outlet_by_area/{id}', [App\Http\Controllers\MapsController::class, 'show_all_by_area']);
    Route::get('show_all_outlet_by_radius', [App\Http\Controllers\MapsController::class, 'show_all_by_radius']);


    // route index
    Route::get('/', [FrontLandingController::class, 'index'])->name('landing');
