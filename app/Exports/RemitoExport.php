<?php

namespace App\Exports;
use App\Cart;

use Maatwebsite\Excel\Concerns\FromCollection;

class RemitoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

  //  protected $id;

    public function __construct($id)
    {
        $this->is = $id;
    }
    public function collection()
    {
        //
        $remitos = Cart::find($id);
        return $remitos;
    }
}
