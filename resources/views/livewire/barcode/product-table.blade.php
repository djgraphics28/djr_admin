<div>
    @if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <span>{{ session('message') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr class="align-middle">
                        <th class="align-middle">Product Name</th>
                        <th class="align-middle">Code</th>
                        <th class="align-middle">
                            Quantity <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Max Quantity: 100"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @if(!empty($product))
                            <td class="align-middle">{{ $product->name }}</td>
                            <td class="align-middle">{{ $product->barcode }}</td>
                            <td class="align-middle text-center" style="width: 200px;">
                                <input wire:model="quantity" class="form-control" type="number" min="1" max="100" value="{{ $quantity }}">
                            </td>
                        @else
                            <td colspan="3" class="text-center">
                                <span class="text-danger">Please search & select a product!</span>
                            </td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button wire:click="generateBarcodes({{ $product }}, {{ $quantity }})" type="button" class="btn btn-primary">
                    <i class="bi bi-upc-scan"></i> Generate Barcodes
                </button>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="generateBarcodes" class="w-100">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    @if(!empty($barcodes))
        <div class="text-right mb-3">
            {{-- <button wire:click="getPdf" wire:loading.attr="disabled" type="button" class="btn btn-primary">
                <span wire:loading wire:target="getPdf" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <i wire:loading.remove wire:target="getPdf" class="bi bi-file-earmark-pdf"></i> Print Barcode
            </button> --}}
            <input type="button" class="btn btn--primary non-printable text-white" onclick="printDiv()"
                       value="{{translate('Print, If thermal printer is ready.')}}"/>

        </div>
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center" id="printableArea">
                    @foreach($barcodes as $barcode)
                        <div class="col-lg-2 col-md-4 col-sm-6" style="border: 1px solid #ffffff;border-style: dashed;background-color: #48FCFE;">
                            <p class="mt-3 mb-1" style="font-size: 15px;color: #000;">
                                {{ $product->name }}
                            </p>
                            <div>
                                {!! $barcode !!}
                            </div>
                            <p style="font-size: 15px;color: #000;">
                                p-{{ $product->barcode }} | Price: {{ $product->price }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

@push('script')
<script>
    function printDiv() {
        var divContents = document.getElementById("printableArea").innerHTML;
        var a = window.open('', '', 'height=700, width=1080');
        a.document.write('<html>');
        a.document.write('<body >');
        a.document.write('<div >');
        a.document.write(divContents);
        a.document.write('</div >');
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
@endpush
