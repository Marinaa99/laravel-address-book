<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ContactExport implements FromView, ShouldAutoSize
{
    protected $contacts;

    public function __construct($contacts){
        $this->contacts = $contacts;
    }

    public function view(): View
    {
        $contacts = $this->contacts->sortBy('last_name');
        return view('exports.contact-export', [
            'contacts' => $contacts,

        ]);
    }

}
