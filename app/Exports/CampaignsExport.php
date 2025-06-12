<?php

namespace App\Exports;

use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampaignsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Campaign::with('list')->get()->map(function ($campaign) {
            return [
                'ID' => $campaign->id,
                'Subject' => $campaign->subject,
                'Message' => strip_tags($campaign->message),
                'List Name' => optional($campaign->list)->name,
                'Created At' => $campaign->created_at->toDateTimeString(),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Subject', 'Message', 'List Name', 'Created At'];
    }
}