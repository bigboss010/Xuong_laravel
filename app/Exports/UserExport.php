<?php

namespace App\Exports;

use App\Models\KhachHang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class UserExport implements FromCollection, WithHeadings, WithEvents
{
    public $styleHeader = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'wrapText' => true
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor'    => ['argb' => 'ededed'],
        ],
        'font'  => [
            'size'  => 14,
            'name'  => 'Times New Roman',
        ],
    ];
    public $styleCell = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'wrapText' => true
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor'    => ['argb' => 'ededed'],
        ],
        'font'  => [
            'size'  => 14,
            'name'  => 'Times New Roman',
        ],
    ];

    public function collection()
    {
        $outputArr = [];
        $users = KhachHang::join('chuc_vus', 'users.chuc_vu_id', '=', 'chuc_vus.id')
        ->select('users.*', 'chuc_vus.ten_chuc_vu')
        ->orderBy('users.id')
        ->get();
        foreach($users as $key => $value){
           array_push($outputArr, [
                $key + 1,
                $value->name,
                $value->email,
                $value->password,
                $value->phoneNumber,
                $value->address,
                $value->ten_chuc_vu,
           ]);
        }
        return collect($outputArr);
    }

    public function headings() :array {
        return [
            'STT',
            'Name',
            'Email',
            'Password',
            'SĐT',
            'Address',
            'Chức vụ'
        ];
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                //Sheet name
                $event->sheet->getDelegate()->setTitle("List User");

                // All headers
                $event->sheet->getDelegate()->getStyle("A1:G1")->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

                // Merge
                // $event->sheet->getDelegate()->getStyle("C1:D1")->getActiveSheet()->mergeCells('C1:D1');

                // Hide column code
                // $event->sheet->getDelegate()->getStyle("B")->getActiveSheet()->getColumnDimension('B')->setVisible(false);

                // Set width column
                $event->sheet->getDelegate()->getStyle("A")->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getStyle("B")->getActiveSheet()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getStyle("C")->getActiveSheet()->getColumnDimension('C')->setWidth(35);
                $event->sheet->getDelegate()->getStyle("D")->getActiveSheet()->getColumnDimension('D')->setWidth(70);
                $event->sheet->getDelegate()->getStyle("E")->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                $event->sheet->getDelegate()->getStyle("F")->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                $event->sheet->getDelegate()->getStyle("G")->getActiveSheet()->getColumnDimension('G')->setWidth(20);


                // Gán style
                $event->sheet->getDelegate()->getStyle("A1:G1")
                    ->applyFromArray($this->styleHeader);


                $validation = $event->sheet->getDataValidation("E2:E9");
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Value is not in list.');
                $validation->setPromptTitle('Pick from list');
                $validation->setPrompt('Please pick a value from the drop-down list.');
                $validation->setFormula1('"Nam,Nữ"');
            },
        ];
    }
}
