<?php

namespace App\Exports;

use App\Models\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;

class InquiryExport implements FromCollection
{
    public function headings(): array
    {
        return ["Id", "Name", "Phone", "Date"];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Inquiry::select('id', 'name', 'phone', 'created_at')->get();
    }
}
