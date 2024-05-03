<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/checkshipping',
        '/stripecheckouts',
        'discount-addall',
        'choosegift',
        'postImageOutlet',
        'admin/attachment/store',
        'admin/outlet/show_form',
        'admin/outlet/store',
        'admin/outlet/show/',
        'admin/outlet/get_images_outlet',
        'admin/outlet/update/',
        'admin/legal/show_form',
        'admin/legal/update/',
        'admin/legal/store',
        'admin/outlet/get_kota/',
        'admin/outlet/get_kode_pos',
        'admin/generals',
        'admin/contact_person/store',
        'admin/contact_person/update/',
        'admin/generals/atribut/',
        'admin/outlet/get_kelurahan_edit_outlet/',
        'admin/outlet/get_kota_edit_outlet/',
        'admin/outlet/deleteFoto/',
        'scan_qrcode',
        'admin/detail_distributor/show/',
        'admin/detail_distributor/tampilDetailDistributor/',
        'admin/maps/show_all',
        'admin/outlet/generate_id_outlet',
        'admin/generals/generate_id_customer',
        'admin/outlet/generate_id_outlet_berkas',
        'admin/outlet/get_distributor_draft_id',
        'admin/outlet/get_distributor_outlet',
        'admin/area/store',
        'admin/area/get_area_id',
    ];
}
