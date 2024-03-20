<?php

namespace App\Livewire\DataLogPayment;

use App\Models\LogPayment;
use Livewire\Component;
use Livewire\WithPagination;

class TableDataLogPayment extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.data-log-payment.table-data-log-payment', [
            'resultDataLogPayment'  => LogPayment::whereIn('status_payment', [1, 2])->orderBy('id', 'DESC')->paginate(10),
        ]);
    }
}
