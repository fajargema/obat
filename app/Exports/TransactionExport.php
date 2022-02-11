<?php

namespace App\Exports;

use App\Models\Transaction;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromView, ShouldAutoSize, WithStyles
{
    private $from, $to;

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '0000000'],
                ],
            ],

            'alignment' => [
                'horizontal' => "center"
            ],
        ];

        $set = $sheet->getHighestRowAndColumn('A');
        for ($i = 0; $i <= $set['row']; $i++) {
            $sheet->getStyle('A' . $i . ':' . $set['column'] . $i)
                ->applyFromArray($styleArray);

            if ($i == 1) {
                $sheet->getStyle('A' . $i . ':' . $set['column'] . $i)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFFF00');
            } elseif ($i == $set['row']) {
                $sheet->getStyle('A' . $i . ':' . $set['column'] . $i)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFFF00');
            }
        }
    }


    public function setPeriode($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        $from = $this->from;
        $to = $this->to;

        $data = Transaction::whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"])->get();
        $total = $data->sum('total');

        return view('export.transaksi', compact('data', 'total'));
    }
}
