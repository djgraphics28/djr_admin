<!-- resources/views/barcodes/barcode_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add any necessary styling here */
        .barcode-container {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @for ($i = 0; $i < 10; $i++)

    {{-- {{ dd($barcodeValue) }} --}}
        <div class="barcode-container">
            <p>Barcode Value: {{ $barcodeValue }}</p>
            {{-- {!! DNS1D::getBarcodeHTML($barcodeValue, 'UPCA') !!} --}}
        </div>
    @endfor
</body>
</html>
