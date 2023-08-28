@extends('layouts.admin.app')

@section('title', translate('Barcode Generator'))

@section('content')
<style>
    /* Add any necessary styling here */
    .barcode-container {
        width: 60%;
        /* margin-bottom: 2px; */
        padding: 5px;
        border-style: dashed;
    }
</style>
<div class="content container-fluid initial-38">
    <div class="row justify-content-center" id="printableArea">
        <div class="col-md-12">
            <center>
                <input type="button" class="btn btn--primary non-printable text-white" onclick="printDiv('printableArea')"
                       value="{{translate('Proceed, If thermal printer is ready.')}}"/>
                <a href="{{url()->previous()}}" class="btn btn--danger non-printable text-white">{{ translate('Back') }}</a>
            </center>
            <hr class="non-printable">

            <div class="initial-38-1">
                {{-- @for ($i = 0; $i < 10; $i++)
                    <div class="barcode-container">
                        {!! DNS1D::getBarcodeHTML($barcodeValue, 'UPCA', 2, 50) !!}
                        p - {{ $barcodeValue }}
                    </div>
                @endfor --}}
                @for ($i = 0; $i < 10; $i++)
                    <div class="barcode-container">
                        {!! DNS1D::getBarcodeHTML($barcodeValue, 'UPCA', 2, 50) !!}
                        p - {{ $barcodeValue }}
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endpush
