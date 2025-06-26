<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label Pengiriman - {{ $shippingData['order_number'] }}</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include JsBarcode for barcode generation -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .print-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .shipping-label {
            width: 100%;
            border: 2px solid #000;
            padding: 0;
            margin-bottom: 20px;
            page-break-inside: avoid;
            background: #fff;
        }

        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px dotted #000;
            padding: 10px 15px;
        }

        .shopee-logo {
            display: flex;
            align-items: center;
        }

        .shopee-logo img {
            width: 40px;
            margin-right: 10px;
        }

        .shopee-logo span {
            font-size: 24px;
            font-weight: bold;
            color: #ee4d2d;
        }

        .partner-logo {
            font-weight: bold;
        }

        .order-number {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            border-bottom: 2px dotted #000;
            padding: 10px 0;
        }

        .barcode-container {
            text-align: center;
            padding: 15px 0;
            border-bottom: 2px dotted #000;
        }

        .barcode-container svg {
            max-width: 90%;
            height: 70px;
        }

        .info-container {
            display: flex;
            border-bottom: 2px dotted #000;
        }

        .info-section {
            width: 50%;
            padding: 10px 15px;
        }

        .info-section h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .address-details {
            font-size: 14px;
            line-height: 1.4;
        }

        .delivery-details {
            display: flex;
            border-bottom: 2px dotted #000;
        }

        .detail-box {
            width: 50%;
            text-align: center;
            padding: 10px 0;
            font-weight: bold;
            font-size: 16px;
        }

        .detail-box:first-child {
            border-right: 2px dotted #000;
        }

        .shipping-info {
            display: flex;
            padding: 10px 15px;
            border-bottom: 2px dotted #000;
        }

        .shipping-detail {
            width: 33.33%;
        }

        .shipping-detail h4 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .shipping-detail p {
            font-size: 14px;
            margin-bottom: 0;
        }

        .footer-barcode {
            text-align: center;
            padding: 15px 0;
        }

        .product-list {
            margin-top: 20px;
            border: 2px solid #000;
            width: 100%;
        }

        .product-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-list th,
        .product-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }

        .product-list th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 10px;
        }

        .action-buttons button {
            flex: 1;
            padding: 10px;
        }

        @media print {
            body {
                padding: 0;
                background: #fff;
            }

            .print-container {
                box-shadow: none;
                max-width: 100%;
            }

            .action-buttons,
            .btn-back {
                display: none;
            }

            @page {
                margin: 0.5cm;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('index-admin-order-need-sent') }}" class="btn btn-secondary btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="print-container">
            <!-- Shipping Label -->
            <div class="shipping-label">
                <div class="logo-container">
                    <div class="shopee-logo">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0MCA0MCI+PHBhdGggZD0iTTM3LjUsMTcuNWMtMC4zLTMuNC0yLjQtNi4xLTUuNS03LjVjMS0xLDEuNi0yLjQsMS42LTMuOVYzLjhjMC0wLjQtMC4zLTAuOC0wLjgtMC44SDcuMmMtMC40LDAtMC44LDAuMy0wLjgsMC44IHY0LjJjMCwwLDAsMCwwLDBjMCwxLjUsMC42LDMsMS42LDMuOWMtMy4xLDEuNC01LjIsNC4xLTUuNSw3LjVjLTAuMSwwLjgsMCwxLjYsMC4xLDIuNGMwLjcsMy44LDMuNCw3LDcuMiw5LjYgYzMuMSwyLjEsNi42LDMuNCwxMC4yLDMuNGMzLjYsMCw3LjEtMS4zLDEwLjItMy40YzMuOC0yLjYsNi41LTUuOCw3LjItOS42QzM3LjUsMTkuMSwzNy42LDE4LjMsMzcuNSwxNy41eiIgc3R5bGU9ImZpbGw6ICNlZTRkMmQiPjwvcGF0aD48ZyBzdHlsZT0iZmlsbDogI2ZmZiI+PHBhdGggZD0iTTE2LjQsMjAuM2MwLDIsMi4xLDMuNiw0LjYsMy42YzIuNiwwLDQuNi0xLjYsNC42LTMuNnMtMi4xLTMuNi00LjYtMy42QzE4LjQsMTYuNywxNi40LDE4LjMsMTYuNCwyMC4zeiI+PC9wYXRoPjxjaXJjbGUgY3g9IjI2LjUiIGN5PSIxMyIgcj0iMS44Ij48L2NpcmNsZT48Y2lyY2xlIGN4PSIxMy41IiBjeT0iMTMiIHI9IjEuOCI+PC9jaXJjbGU+PC9nPjwvc3ZnPg==">
                        <span>Shopee</span>
                    </div>
                    <div class="partner-logo">
                        POS INDONESIA
                    </div>
                </div>

                <div class="order-number">
                    No. Pesanan: {{ $shippingData['order_number'] }}
                </div>

                <div class="barcode-container">
                    <svg id="barcode"></svg>
                </div>

                <div class="info-container">
                    <div class="info-section">
                        <h3>Penerima:</h3>
                        <div class="address-details">
                            <strong>{{ $shippingData['recipient_name'] }}</strong><br>
                            {{ $shippingData['recipient_phone'] }}<br>
                            {{ $shippingData['recipient_address'] }}
                        </div>
                    </div>
                    <div class="info-section">
                        <h3>Pengirim:</h3>
                        <div class="address-details">
                            <strong>{{ $shippingData['sender_name'] }}</strong><br>
                            {{ $shippingData['sender_phone'] }}<br>
                            {{ $shippingData['sender_city'] }}
                        </div>
                    </div>
                </div>

                <div class="delivery-details">
                    <div class="detail-box">
                        {{ $shippingData['recipient_city'] }}
                    </div>
                    <div class="detail-box">
                        {{ $shippingData['recipient_district'] }}
                    </div>
                </div>

                <div class="shipping-info">
                    <div class="shipping-detail">
                        <h4>Berat:</h4>
                        <p>{{ $shippingData['weight'] }}</p>
                    </div>
                    <div class="shipping-detail">
                        <h4>COD:</h4>
                        <p>Rp{{ number_format($shippingData['cod_amount'], 0, ',', '.') }}</p>
                    </div>
                    <div class="shipping-detail">
                        <h4>Batas Kirim:</h4>
                        <p>{{ $shippingData['shipping_date'] }}</p>
                    </div>
                </div>

                <div class="footer-barcode">
                    <svg id="barcode2"></svg>
                    <div>No. Pesanan: {{ $shippingData['order_number'] }}</div>
                </div>
            </div>

            <!-- Products List -->
            <div class="product-list">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>SKU</th>
                            <th>Variasi</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shippingData['items'] as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->product_name ?? 'Produk tidak tersedia' }}</td>
                            <td>{{ $item->product->product_code ?? '-' }}</td>
                            <td>{{ $item->product_variant_id ? 'Variasi '.$item->product_variant_id : '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Print Label Pengiriman
                </button>
                <button onclick="downloadAsPDF()" class="btn btn-success">
                    <i class="bi bi-download"></i> Download PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Include PDF generation library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        // Generate barcodes when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Generate main barcode
            JsBarcode("#barcode", "{{ $shippingData['barcode'] }}", {
                format: "CODE128",
                lineColor: "#000",
                width: 2,
                height: 70,
                displayValue: false
            });

            // Generate footer barcode
            JsBarcode("#barcode2", "{{ $shippingData['barcode'] }}", {
                format: "CODE128",
                lineColor: "#000",
                width: 2,
                height: 50,
                displayValue: false
            });
        });

        // Function to download shipping label as PDF
        function downloadAsPDF() {
            // Get the print container element
            const element = document.querySelector('.print-container');
            
            // Configure pdf options
            const opt = {
                margin: 10,
                filename: 'label-pengiriman-{{ $shippingData["order_number"] }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Generate and download PDF
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>

</html>