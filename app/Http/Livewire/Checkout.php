<?php

namespace App\Http\Livewire;

use App\Models\CustomerAddress;
use App\Traits\WithCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Checkout extends Component
{
    use WithCart;

    public $note;

    public function mount()
    {
        if (!Session::get('items')) {
            abort(404);
        }

        $this->note = Session::get('note');
    }

    public function render()
    {
        $address = null;
        $date = Carbon::now()->addDay();
        $shipment_date = convertDayEngToInd($date->format('l'), $date->format('l, j M Y'));
        $shipment_time = '06:00 ~ 11:00';

        return view('livewire.checkout', compact('address', 'shipment_date', 'shipment_time'))
            ->layout('layouts.customer');
    }

    public function saveNote()
    {
        session(['note' => $this->note]);
    }
}
