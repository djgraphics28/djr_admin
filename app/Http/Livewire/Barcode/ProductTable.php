<?php

namespace App\Http\Livewire\Barcode;

use App\Model\Product;
use Livewire\Component;
use Milon\Barcode\Facades\DNS1DFacade;

class ProductTable extends Component
{
    public $product;
    public $quantity;
    public $barcodes;

    protected $listeners = ['productSelected'];

    public function mount() {
        $this->product = '';
        $this->quantity = 0;
        $this->barcodes = [];
    }

    public function render() {
        return view('livewire.barcode.product-table');
    }

    public function productSelected(Product $product) {
        $this->product = $product;
        $this->quantity = 1;
        $this->barcodes = [];
    }

    public function generateBarcodes(Product $product, $quantity) {
        if ($quantity > 100) {
            return session()->flash('message', 'Max quantity is 100 per barcode generation!');
        }

        $this->barcodes = [];

        $barcodeSymbology = 'UPCA';

        for ($i = 1; $i <= $quantity; $i++) {
            $barcode = DNS1DFacade::getBarCodeSVG($product->barcode, $barcodeSymbology, 2 , 60, 'black', false);
            array_push($this->barcodes, $barcode);
        }
    }

    public function getPdf() {

        $pdf = \PDF::loadView('admin-views.product.partials._barcode', [
            'barcodes' => $this->barcodes,
            'price' => $this->product->price,
            'name' => $this->product->name,
        ]);
        return $pdf->stream('barcodes-'. $this->product->barcode .'.pdf');
    }

    public function printDiv($divId)
    {
        $this->dispatchBrowserEvent('printDiv', ['divId' => $divId]);
    }

    public function updatedQuantity() {
        $this->barcodes = [];
    }
}
