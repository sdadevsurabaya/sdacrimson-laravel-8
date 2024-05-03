<?php

namespace App\Exports;

use App\Models\General_model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GeneralExport implements FromView
{
    use Exportable;

    protected $dari;
    protected $sampai;

    function __construct($dari,$sampai) {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    // public function query()
    // {
    //     if ($this->dari == null) {
    //         $data = DB::table('general_informations')
    //             ->join("users as created_by","created_by.id","=","general_informations.created_by")
    //             // ->whereBetween('general_informations.created_date',[ $this->dari,$this->sampai])
    //             ->select('id_customer','type_usaha','nama_usaha', 'nama_lengkap','alamat_kantor','jabatan','telepon','mobile_phone','general_informations.email','web_site','no_npwp','nama_npwp','alamat_npwp','nik','created_by.name')
    //             ->orderBy('general_informations.id');
    //     } else {
    //         $data = DB::table('general_informations')
    //             ->join("users as created_by","created_by.id","=","general_informations.created_by")
    //             ->whereBetween('general_informations.created_date',[ $this->dari,$this->sampai])
    //             ->select('id_customer','type_usaha','nama_usaha', 'nama_lengkap','alamat_kantor','jabatan','telepon','mobile_phone','general_informations.email','web_site','no_npwp','nama_npwp','alamat_npwp','nik','created_by.name')
    //             ->orderBy('general_informations.id');
    //     }

    //     return $data;
    // }

    // public function headings():array{
    //     return[
    //         'Customer',
    //         'Type Usaha',
    //         'Nama Usaha',
    //         'Nama Lengkap',
    //         'Alamat Kantor',
    //         'Jabatan',
    //         'No Telepon',
    //         'No Handphone',
    //         'Email',
    //         'Website',
    //         'No NPWP',
    //         'Nama NPWP',
    //         'Alamat NPWP',
    //         'NIK',
    //         'AR',
    //     ];
    // }

    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 10,
    //         'B' => 10,
    //         'C' => 20,
    //         'D' => 20,
    //         'E' => 55,
    //         'F' => 10,
    //         'G' => 10,
    //         'H' => 15,
    //         'I' => 30,
    //         'J' => 15,
    //         'K' => 20,
    //         'L' => 20,
    //         'M' => 55,
    //         'N' => 25,
    //         'O' => 25,
    //     ];
    // }

    public function view(): View
    {
        if ($this->dari == null) {
            return view('general.excel', [
                'generals' => General_model::join("users as created_by","created_by.id","=","general_informations.ar")
                                            // ->orderBy('general_informations.id', 'DESC')
                                            ->get(['id_customer','type_usaha','nama_usaha', 'nama_lengkap','alamat_kantor','jabatan','telepon','mobile_phone','general_informations.email as email','web_site','no_npwp','nama_npwp','alamat_npwp','nik','created_by.name as ar'])
            ]);
        } else {
            return view('general.excel', [
                'generals' => General_model::join("users as created_by","created_by.id","=","general_informations.ar")
                                            ->whereBetween('general_informations.created_date',[ $this->dari,$this->sampai])
                                            // ->orderBy('general_informations.id', 'DESC')
                                            ->get(['id_customer','type_usaha','nama_usaha', 'nama_lengkap','alamat_kantor','jabatan','telepon','mobile_phone','general_informations.email as email','web_site','no_npwp','nama_npwp','alamat_npwp','nik','created_by.name as ar'])
            ]);
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     // return General_model::all();
    //     return General_model::select('id_customer','type_usaha')->get();
    // }
}
