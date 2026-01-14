<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesAnalysisExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    protected $sales;
    protected $year;

    public function __construct($sales, $year)
    {
        $this->sales = collect($sales);
        $this->year = $year;
    }

    public function collection()
    {
        return $this->sales;
    }

    public function title(): string
    {
        return 'Analisis Sales ' . $this->year;
    }

    public function headings(): array
    {
        return [
            'Nama Sales',
            'Cabang',
            'Role',
            'Total Kunjungan (Actual)',
            'Target Tahunan',
            'Pencapaian (%)',
            'Status'
        ];
    }

    public function map($sale): array
    {
        $status = 'Poor';
        if ($sale->percentage_yearly >= 80) $status = 'Excellent';
        elseif ($sale->percentage_yearly >= 50) $status = 'Good';

        return [
            ucwords(strtolower($sale->name)),
            $sale->nama_cabang ?? '-',
            $sale->role,
            $sale->actual_yearly,
            $sale->target_yearly,
            $sale->percentage_yearly . '%',
            $status
        ];
    }
}
