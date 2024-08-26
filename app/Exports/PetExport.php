<?php

namespace App\Exports;

use App\Models\Pet;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class PetExport implements FromCollection, WithHeadings, WithEvents
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
        $users = Pet::join('danh_mucs', 'pets.danh_muc_id', '=', 'danh_mucs.id')
        ->select(
            'pets.id',
            'pets.ma_pet',
            'pets.ten_pet',
            'pets.image',
            'pets.so_luong',
            'pets.gia_pet',
            'pets.gia_khuyen_mai',
            'pets.ngay_nhap',
            'pets.mota',
            'pets.trang_thai',
            'pets.is_new',
            'pets.is_hot',
            'pets.is_home',
            'pets.luot_xem',
            'pets.deleted',
            'pets.deleted_at',
            'pets.created_at',
            'pets.updated_at',
            'danh_mucs.ten_danh_muc'
        )
        ->orderBy('pets.id')
        ->get();
        foreach($users as $key => $value){
           array_push($outputArr, [
                $key + 1,
                $value->ma_pet,
                $value->ten_pet,
                $value->image,
                $value->so_luong,
                $value->gia_pet,
                $value->gia_khuyen_mai,
                (new DateTime($value->ngay_nhap))->format('d/m/Y'),
                $value->mota,
                $value->ten_danh_muc,
                $value->trang_thai,
           ]);
        }
        return collect($outputArr);
    }

    public function headings() :array {
        return [
            'STT',
            'Mã pet',
            'Tên pet',
            'Image',
            'Số lượng',
            'Giá gốc',
            'Giá khuyến mãi',
            'Ngày nhập',
            'Mô tả ngắn',
            'Danh mục',
            'Trạng thái'
        ];
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                //Sheet name
                $event->sheet->getDelegate()->setTitle("List Pet");

                // All headers
                $event->sheet->getDelegate()->getStyle("A1:K1")->getActiveSheet()->getRowDimension('1')->setRowHeight(35);

                // Merge
                // $event->sheet->getDelegate()->getStyle("C1:D1")->getActiveSheet()->mergeCells('C1:D1');

                // Hide column code
                // $event->sheet->getDelegate()->getStyle("B")->getActiveSheet()->getColumnDimension('B')->setVisible(false);

                // Set width column
                $event->sheet->getDelegate()->getStyle("A")->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getStyle("B")->getActiveSheet()->getColumnDimension('B')->setWidth(10);
                $event->sheet->getDelegate()->getStyle("C")->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getStyle("D")->getActiveSheet()->getColumnDimension('D')->setWidth(70);
                $event->sheet->getDelegate()->getStyle("E")->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                $event->sheet->getDelegate()->getStyle("F")->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getStyle("G")->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $event->sheet->getDelegate()->getStyle("H")->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                $event->sheet->getDelegate()->getStyle("I")->getActiveSheet()->getColumnDimension('I')->setWidth(40);
                $event->sheet->getDelegate()->getStyle("J")->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                $event->sheet->getDelegate()->getStyle("K")->getActiveSheet()->getColumnDimension('K')->setWidth(14);


                // Gán style
                $event->sheet->getDelegate()->getStyle("A1:K1")
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
