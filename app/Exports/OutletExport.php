<?php

namespace App\Exports;

use App\Models\Outlet_model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OutletExport implements FromView
{
    use Exportable;

    protected $dari;
    protected $sampai;

    function __construct($dari,$sampai) {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function view(): View
    {
        if ($this->dari == null) {
            return view('general.excel_outlet', [
                'outlets' => Outlet_model::join("users as created_by","created_by.id","=","outlet.ar")
                                            ->leftJoin("contact_person","contact_person.id_outlet","=","outlet.id_outlet")
                                            ->join("general_informations","general_informations.id_customer","=","outlet.id_customer")
                                            ->orderBy('outlet.id', 'ASC')
                                            ->get(['outlet.id_customer as id_customer','outlet.id_outlet as id_outlet','general_informations.type_usaha as type_usaha','general_informations.nama_usaha as nama_outlet','outlet_type','address_type','alamat','provinsi','kota','kecamatan','kelurahan','kode_pos','latitude','longitude','contact_person.nama_lengkap as nama_lengkap','contact_person.jabatan as jabatan','contact_person.no_telpon as no_telpon','contact_person.email as email','brand','outlet.status as status','remarks','created_by.name as ar'])

            ]);
        } else {
            return view('general.excel_outlet', [
                'outlets' => Outlet_model::join("users as created_by","created_by.id","=","outlet.ar")
                                            ->leftJoin("contact_person","contact_person.id_outlet","=","outlet.id_outlet")
                                            ->join("general_informations","general_informations.id_customer","=","outlet.id_customer")
                                            ->whereBetween('outlet.created_date',[ $this->dari,$this->sampai])
                                            ->orderBy('outlet.id', 'ASC')
                                            ->get(['outlet.id_customer as id_customer','outlet.id_outlet as id_outlet','general_informations.type_usaha as type_usaha','general_informations.nama_usaha as nama_outlet','outlet_type','address_type','alamat','provinsi','kota','kecamatan','kelurahan','kode_pos','latitude','longitude','contact_person.nama_lengkap as nama_lengkap','contact_person.jabatan as jabatan','contact_person.no_telpon as no_telpon','contact_person.email as email','brand','outlet.status as status','remarks','created_by.name as ar'])
            ]);
        }
    }
}
