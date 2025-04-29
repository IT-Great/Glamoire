<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        :root {
            --primary-color: #183018;
            --primary-gradient: #183018;
            --secondary-color: #183018;
            /* Opsional kalau mau sekalian seragam */
            --accent-color: #f8b195;
            /* Bebas, kalau ini mau tetap */
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --text-muted: #718096;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 0.25rem;
            --radius-md: 0.5rem;
            --radius-lg: 1rem;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        /* Main Layout Styles */
        .premium-container {
            padding: 2rem;
            background-color: var(--bg-light);
        }

        .premium-card {
            background-color: var(--bg-white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            border: none;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .premium-card-header {
            background: rgba(97, 67, 133, 0.05);
            color: white;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            font-size: 1.125rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .premium-card-header-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #183018;
            /* ini buat teks di dalamnya */
        }


        .premium-card-body {
            padding: 1.5rem;
        }

        /* Typography */
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.25rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 3rem;
            height: 0.25rem;
            background: var(--primary-gradient);
            border-radius: var(--radius-sm);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-secondary {
            color: var(--secondary-color) !important;
        }

        .text-accent {
            color: var(--accent-color) !important;
        }

        /* Breadcrumb */
        .premium-breadcrumb {
            background-color: transparent;
            padding: 0.5rem 0;
            margin-bottom: 1.5rem;
        }

        .premium-breadcrumb-item {
            display: inline-flex;
            align-items: center;
            font-weight: 500;
        }

        .premium-breadcrumb-item:not(:last-child)::after {
            content: '/';
            margin: 0 0.5rem;
            color: var(--text-muted);
        }

        .premium-breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .premium-breadcrumb-item a:hover {
            color: var(--secondary-color);
        }

        .premium-breadcrumb-item.active {
            color: var(--text-muted);
        }

        /* Form Elements */
        .premium-form-group {
            margin-bottom: 1.25rem;
        }

        .premium-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .premium-input {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            line-height: 1.5;
            color: var(--text-primary);
            background-color: var(--bg-light);
            background-clip: padding-box;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .premium-input[readonly] {
            background-color: rgba(97, 67, 133, 0.05);
            border-color: rgba(97, 67, 133, 0.1);
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Stats Cards */
        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            padding: 1.5rem;
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-gradient);
        }

        .stat-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 2rem;
            opacity: 0.1;
            color: var(--primary-color);
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Discount Tiers */
        .premium-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .premium-table th {
            background-color: rgba(97, 67, 133, 0.05);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            padding: 1rem 1.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .premium-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }

        .premium-table tr:hover {
            background-color: rgba(97, 67, 133, 0.02);
        }

        .tier-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 2rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
        }

        .tier-1 {
            color: #805ad5;
            background-color: rgba(128, 90, 213, 0.1);
        }

        .tier-2 {
            color: #3182ce;
            background-color: rgba(49, 130, 206, 0.1);
        }

        .tier-3 {
            color: #38a169;
            background-color: rgba(56, 161, 105, 0.1);
        }

        .tier-4 {
            color: #d69e2e;
            background-color: rgba(214, 158, 46, 0.1);
        }

        .tier-5 {
            color: #e53e3e;
            background-color: rgba(229, 62, 62, 0.1);
        }

        /* Products */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .product-card {
            background-color: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .product-image-container {
            height: 200px;
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            background: var(--primary-gradient);
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 2rem;
        }

        .product-info {
            padding: 1.25rem;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.125rem;
            color: var(--text-primary);
        }

        .product-description {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .product-price {
            font-weight: 700;
            color: var(--primary-color);
        }

        .product-stock {
            display: inline-flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stock-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .in-stock {
            background-color: #48bb78;
        }

        .low-stock {
            background-color: #f6ad55;
        }

        .out-of-stock {
            background-color: #e53e3e;
        }

        /* Price Comparison */
        .price-comparison {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
        }

        .original-price {
            color: var(--text-muted);
            text-decoration: line-through;
            margin-right: 0.75rem;
            font-size: 0.875rem;
        }

        .discount-price {
            color: #e53e3e;
            font-weight: 700;
        }

        .discount-percentage {
            background-color: rgba(229, 62, 62, 0.1);
            color: #e53e3e;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            margin-left: 0.75rem;
        }

        /* Timeline */
        .timeline-container {
            padding: 1.5rem;
            position: relative;
        }

        .timeline-track {
            height: 4px;
            background-color: var(--border-color);
            border-radius: 2px;
            position: relative;
            margin: 2rem 0;
        }

        .timeline-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .timeline-marker {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid var(--primary-color);
            z-index: 1;
        }

        .timeline-marker.start {
            left: 0;
        }

        .timeline-marker.current {
            left: var(--progress-percentage);
            background-color: var(--primary-color);
        }

        .timeline-marker.end {
            left: 100%;
        }

        .timeline-label {
            position: absolute;
            top: -2rem;
            transform: translateX(-50%);
            font-size: 0.75rem;
            white-space: nowrap;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .timeline-date {
            position: absolute;
            bottom: -2rem;
            transform: translateX(-50%);
            font-size: 0.75rem;
            white-space: nowrap;
            color: var(--text-muted);
        }

        /* Button */
        .premium-btn {
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: var(--radius-md);
            transition: all 0.15s ease-in-out;
            background: var(--primary-gradient);
            color: white;
            border: none;
            text-decoration: none;
        }

        .premium-btn:hover {
            box-shadow: 0 4px 12px rgba(97, 67, 133, 0.3);
            transform: translateY(-2px);
        }

        .premium-btn i {
            margin-right: 0.5rem;
        }

        /* Info Cards */
        .info-card {
            padding: 1.5rem;
            border-radius: var(--radius-md);
            background-color: white;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .info-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .info-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: white;
            margin-right: 1rem;
            font-size: 1.25rem;
        }

        .info-title {
            margin: 0;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Additional UI components */
        .discount-info {
            background-color: rgba(97, 67, 133, 0.05);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }

        .premium-chart-container {
            height: 300px;
            width: 100%;
            position: relative;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .upload__img-box-single,
        .upload__img-box-multiple {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: var(--radius-md);
            overflow: hidden;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .upload__img-box-single:hover,
        .upload__img-box-multiple:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .img-bg-single,
        .img-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .upload__img-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            width: 1.5rem;
            height: 1.5rem;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        {{-- <div id="main" class="premium-container">
            <!-- Breadcrumb -->
            <div class="premium-breadcrumb">
                <div class="premium-breadcrumb-item">
                    <a href="/promo"><i class="bi bi-grid me-2"></i>Promo Dashboard</a>
                </div>
                <div class="premium-breadcrumb-item active">
                    <i class="bi bi-tag me-2"></i>Detail Promo Diskon
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <h2 class="section-title">{{ $promo->promo_name }}</h2>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-success p-2" style="font-size: 0.9rem;">
                        <i class="bi bi-check-circle me-1"></i> Active Campaign
                    </span>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="stat-label">Campaign Duration</div>
                    <div class="stat-value">
                        {{ \Carbon\Carbon::parse($promo->start_date)->diffInDays($promo->end_date) + 1 }}</div>
                    <div class="stat-label">Days</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stat-label">Products in Promo</div>
                    <div class="stat-value">{{ count($promo->products) }}</div>
                    <div class="stat-label">Items</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-layers"></i>
                    </div>
                    <div class="stat-label">Discount Tiers</div>
                    <div class="stat-value">{{ count($promo->tiers) }}</div>
                    <div class="stat-label">Levels</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-label">Days Remaining</div>
                    @php
                        $daysRemaining = max(0, \Carbon\Carbon::parse($promo->end_date)->diffInDays(now()));
                    @endphp
                    <div class="stat-value">{{ $daysRemaining }}</div>
                    <div class="stat-label">Days</div>
                </div>
            </div>

            <!-- Promo Timeline -->
            <div class="col-md-12">
                <div class="premium-card">
                    <div class="premium-card-header">
                        <span style="color: #183018;">Promo Timeline</span>
                        <div class="premium-card-header-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                    <div class="premium-card-body">
                        <div class="premium-form-group">
                            <label class="premium-label">Start Date</label>
                            <input type="text" class="premium-input"
                                value="{{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y, h:i A') }}"
                                readonly>
                        </div>

                        <div class="premium-form-group">
                            <label class="premium-label">End Date</label>
                            <input type="text" class="premium-input"
                                value="{{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y, h:i A') }}" readonly>
                        </div>

                        <div class="timeline-container">
                            @php
                                $startDate = \Carbon\Carbon::parse($promo->start_date);
                                $endDate = \Carbon\Carbon::parse($promo->end_date);
                                $currentDate = now();
                                $totalDuration = $startDate->diffInSeconds($endDate);
                                $elapsedDuration = $startDate->diffInSeconds($currentDate);
                                $progressPercentage = min(100, max(0, ($elapsedDuration / $totalDuration) * 100));
                            @endphp

                            <div class="timeline-track">
                                <div class="timeline-progress" style="width: {{ $progressPercentage }}%"></div>

                                <div class="timeline-marker start">
                                    <div class="timeline-label">Start</div>
                                    <div class="timeline-date">{{ $startDate->format('d M Y') }}</div>
                                </div>

                                <div class="timeline-marker current"
                                    style="--progress-percentage: {{ $progressPercentage }}%">
                                    <div class="timeline-label">Current</div>
                                    <div class="timeline-date">{{ $currentDate->format('d M Y') }}</div>
                                </div>

                                <div class="timeline-marker end">
                                    <div class="timeline-label">End</div>
                                    <div class="timeline-date">{{ $endDate->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <div class="premium-label">Campaign Progress</div>
                                <div class="fw-bold">{{ round($progressPercentage) }}% Complete</div>
                            </div>
                            <div class="text-end">
                                <div class="premium-label">Time Remaining</div>
                                <div class="fw-bold">{{ $daysRemaining }} days</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Discount Tiers -->
            <div class="premium-card mt-4">
                <div class="premium-card-header">
                    <span style="color: #183018;">Discount Tiers</span>
                    <div class="premium-card-header-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <div class="premium-card-body">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Tier Level</th>
                                <th>Purchase Requirement</th>
                                <th>Discount Type</th>
                                <th>Discount Value</th>
                                <th>Customer Savings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promo->tiers as $tier)
                                <tr>
                                    <td>
                                        <span class="tier-badge tier-{{ $tier->tier_level }}">
                                            <i class="bi bi-star-fill me-2"></i> Tier {{ $tier->tier_level }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-basket me-2 text-muted"></i>
                                            <div>
                                                <div class="fw-medium">{{ $tier->min_quantity }} items</div>
                                                <small class="text-muted">Minimum purchase</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($tier->discount_type)
                                            @case('percentage')
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-percent me-2 text-primary"></i>
                                                    <div>Percentage Discount</div>
                                                </div>
                                            @break

                                            @case('nominal')
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-currency-dollar me-2 text-primary"></i>
                                                    <div>Fixed Amount Discount</div>
                                                </div>
                                            @break

                                            @case('package')
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-box me-2 text-primary"></i>
                                                    <div>Package Price</div>
                                                </div>
                                            @break

                                            @default
                                                <div>Standard Discount</div>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">
                                            @switch($tier->discount_type)
                                                @case('percentage')
                                                    {{ $tier->discount_value }}% Off
                                                @break

                                                @case('nominal')
                                                    Rp {{ number_format($tier->discount_value, 0, ',', '.') }} Per Item
                                                @break

                                                @case('package')
                                                    Rp {{ number_format($tier->package_price, 0, ',', '.') }} For
                                                    {{ $tier->min_quantity }} Items
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $avgPrice = $promo->products->avg('regular_price');
                                            $regularTotal = $avgPrice * $tier->min_quantity;

                                            if ($tier->discount_type == 'percentage') {
                                                $discountedTotal = $regularTotal * (1 - $tier->discount_value / 100);
                                                $savings = $regularTotal - $discountedTotal;
                                            } elseif ($tier->discount_type == 'nominal') {
                                                $savings = $tier->discount_value * $tier->min_quantity;
                                            } elseif ($tier->discount_type == 'package') {
                                                $savings = $regularTotal - $tier->package_price;
                                            } else {
                                                $savings = 0;
                                            }

                                            $savingsPercentage = ($savings / $regularTotal) * 100;
                                        @endphp

                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="fw-bold text-success">Rp
                                                    {{ number_format($savings, 0, ',', '.') }}</div>
                                                <small class="text-muted">Est. total savings</small>
                                            </div>
                                            <span class="discount-percentage">{{ round($savingsPercentage) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="alert alert-light mt-4 discount-info">
                        <h6 class="d-flex align-items-center">
                            <i class="bi bi-megaphone me-2"></i>
                            <span>All Discount Tiers Description</span>
                        </h6>
                        <div class="mt-2">
                            {!! $promo->all_discount_tiers !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products in Promo -->
            <div class="premium-card mt-4">
                <div class="premium-card-header">
                    <span style="color: #183018;">Featured Products in Promo</span>
                    <div class="premium-card-header-icon">
                        <i class="bi bi-grid"></i>
                    </div>
                </div>
                <div class="premium-card-body">
                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <h6 class="info-title">Total Products</h6>
                                </div>
                                <div class="stat-value">{{ count($promo->products) }}</div>
                                <small class="text-muted">Items eligible for discount</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <h6 class="info-title">Average Price</h6>
                                </div>
                                <div class="stat-value">Rp
                                    {{ number_format($promo->products->avg('regular_price'), 0, ',', '.') }}</div>
                                <small class="text-muted">Before discount</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <h6 class="info-title">In Stock</h6>
                                </div>
                                @php
                                    $inStockCount = $promo->products->where('stock_quantity', '>', 0)->count();
                                @endphp
                                <div class="stat-value">{{ $inStockCount }}</div>
                                <small
                                    class="text-muted">{{ round(($inStockCount / count($promo->products)) * 100) }}%
                                    availability</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-tag"></i>
                                    </div>
                                    <h6 class="info-title">Best Savings</h6>
                                </div>
                                @php
                                    $lastTier = $promo->tiers->last();
                                    $bestPercentage = 0;

                                    if ($lastTier->discount_type == 'percentage') {
                                        $bestPercentage = $lastTier->discount_value;
                                    } elseif ($lastTier->discount_type == 'nominal') {
                                        $avgPrice = $promo->products->avg('regular_price');
                                        $bestPercentage = ($lastTier->discount_value / $avgPrice) * 100;
                                    } elseif ($lastTier->discount_type == 'package') {
                                        $avgPrice = $promo->products->avg('regular_price');
                                        $regularTotal = $avgPrice * $lastTier->min_quantity;
                                        $bestPercentage =
                                            (($regularTotal - $lastTier->package_price) / $regularTotal) * 100;
                                    }
                                @endphp
                                <div class="stat-value">{{ round($bestPercentage) }}%</div>
                                <small class="text-muted">Maximum discount available</small>
                            </div>
                        </div>
                    </div>

                    <!-- Product Cards Grid View -->
                    <div class="product-grid">
                        @foreach ($promo->products as $product)
                            <div class="product-card">
                                <div class="product-image-container">
                                    <img src="{{ Storage::url($product->main_image) }}"
                                        alt="{{ $product->product_name }}" class="product-image"
                                        onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                    @if ($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                                        <div class="product-badge">Low Stock</div>
                                    @elseif($product->stock_quantity == 0)
                                        <div class="product-badge"
                                            style="background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);">Sold
                                            Out</div>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <h5 class="product-name">{{ $product->product_name }}</h5>
                                    <p class="product-description">{{ Str::limit($product->description, 100) }}</p>

                                    <div class="price-comparison">
                                        <span class="original-price">Rp
                                            {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                        @php
                                            $bestTier = $promo->tiers->last();
                                            $discountedPrice = 0;

                                            if ($bestTier->discount_type == 'percentage') {
                                                $discountedPrice =
                                                    $product->regular_price * (1 - $bestTier->discount_value / 100);
                                            } elseif ($bestTier->discount_type == 'nominal') {
                                                $discountedPrice = $product->regular_price - $bestTier->discount_value;
                                            } elseif ($bestTier->discount_type == 'package') {
                                                $discountedPrice = $bestTier->package_price / $bestTier->min_quantity;
                                            }

                                            $discountedPrice = max(0, $discountedPrice);
                                            $savingsPercentage =
                                                (($product->regular_price - $discountedPrice) /
                                                    $product->regular_price) *
                                                100;
                                        @endphp
                                        <span class="discount-price">Rp
                                            {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                        <span class="discount-percentage">-{{ round($savingsPercentage) }}%</span>
                                    </div>

                                    <div class="product-meta">
                                        <div class="product-stock">
                                            @if ($product->stock_quantity > 10)
                                                <span class="stock-badge in-stock"></span>
                                                <span>In Stock ({{ $product->stock_quantity }})</span>
                                            @elseif($product->stock_quantity > 0)
                                                <span class="stock-badge low-stock"></span>
                                                <span>Low Stock ({{ $product->stock_quantity }})</span>
                                            @else
                                                <span class="stock-badge out-of-stock"></span>
                                                <span>Out of Stock</span>
                                            @endif
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Table View (Hidden by Default) -->
                    <div class="table-responsive mt-4" id="tableView" style="display: none;">
                        <table class="premium-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Original Price</th>
                                    <th>Best Deal Price</th>
                                    <th>Savings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promo->products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ Storage::url($product->main_image) }}"
                                                alt="{{ $product->product_name }}"
                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-sm); cursor: pointer;"
                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $product->product_name }}</div>
                                            <small
                                                class="text-muted">{{ Str::limit($product->description, 60) }}</small>
                                        </td>
                                        <td>
                                            @if ($product->stock_quantity > 10)
                                                <span class="badge bg-success">In Stock
                                                    ({{ $product->stock_quantity }})
                                                </span>
                                            @elseif($product->stock_quantity > 0)
                                                <span class="badge bg-warning text-dark">Low Stock
                                                    ({{ $product->stock_quantity }})</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-medium">Rp
                                                {{ number_format($product->regular_price, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            @php
                                                $bestTier = $promo->tiers->last();
                                                $discountedPrice = 0;

                                                if ($bestTier->discount_type == 'percentage') {
                                                    $discountedPrice =
                                                        $product->regular_price * (1 - $bestTier->discount_value / 100);
                                                } elseif ($bestTier->discount_type == 'nominal') {
                                                    $discountedPrice =
                                                        $product->regular_price - $bestTier->discount_value;
                                                } elseif ($bestTier->discount_type == 'package') {
                                                    $discountedPrice =
                                                        $bestTier->package_price / $bestTier->min_quantity;
                                                }

                                                $discountedPrice = max(0, $discountedPrice);
                                            @endphp
                                            <div class="fw-bold text-primary">Rp
                                                {{ number_format($discountedPrice, 0, ',', '.') }}</div>
                                            <small class="text-muted">with {{ $bestTier->min_quantity }}+
                                                items</small>
                                        </td>
                                        <td>
                                            @php
                                                $savings = $product->regular_price - $discountedPrice;
                                                $savingsPercentage = ($savings / $product->regular_price) * 100;
                                            @endphp
                                            <div class="fw-bold text-success">Rp
                                                {{ number_format($savings, 0, ',', '.') }}</div>
                                            <span class="discount-percentage">{{ round($savingsPercentage) }}%</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <a href="{{ route('index-promo-diskon') }}" class="premium-btn">
                        <i class="bi bi-arrow-left"></i> Back to Promo List
                    </a>
                </div>

            </div>

        </div> --}}


        <div id="main" class="premium-container">
            <!-- Breadcrumb -->
            <div class="premium-breadcrumb">
                <div class="premium-breadcrumb-item">
                    <a href="{{ route('index-promo-diskon') }}"><i class="bi bi-grid me-2"></i>Dashboard Promo</a>
                </div>
                <div class="premium-breadcrumb-item active">
                    <i class="bi bi-tag me-2"></i>Detail Promo Diskon
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <h2 class="section-title">{{ $promo->promo_name }}</h2>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-success p-2" style="font-size: 0.9rem;">
                        <i class="bi bi-check-circle me-1"></i> Kampanye Aktif
                    </span>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="stat-label">Durasi Kampanye</div>
                    <div class="stat-value">
                        {{ \Carbon\Carbon::parse($promo->start_date)->diffInDays($promo->end_date) + 1 }}</div>
                    <div class="stat-label">Hari</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stat-label">Produk dalam Promo</div>
                    <div class="stat-value">{{ count($promo->products) }}</div>
                    <div class="stat-label">Item</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-layers"></i>
                    </div>
                    <div class="stat-label">Tingkat Diskon</div>
                    <div class="stat-value">{{ count($promo->tiers) }}</div>
                    <div class="stat-label">Level</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-label">Sisa Waktu</div>
                    @php
                        $daysRemaining = max(0, \Carbon\Carbon::parse($promo->end_date)->diffInDays(now()));
                    @endphp
                    <div class="stat-value">{{ $daysRemaining }}</div>
                    <div class="stat-label">Hari</div>
                </div>
            </div>

            <!-- Promo Timeline -->
            <div class="col-md-12">
                <div class="premium-card">
                    <div class="premium-card-header">
                        <span style="color: #183018;">Jadwal Promo</span>
                        <div class="premium-card-header-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                    <div class="premium-card-body">
                        <div class="premium-form-group">
                            <label class="premium-label">Tanggal Mulai</label>
                            <input type="text" class="premium-input"
                                value="{{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y, h:i A') }}"
                                readonly>
                        </div>

                        <div class="premium-form-group">
                            <label class="premium-label">Tanggal Selesai</label>
                            <input type="text" class="premium-input"
                                value="{{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y, h:i A') }}" readonly>
                        </div>

                        <div class="timeline-container">
                            @php
                                $startDate = \Carbon\Carbon::parse($promo->start_date);
                                $endDate = \Carbon\Carbon::parse($promo->end_date);
                                $currentDate = now();
                                $totalDuration = $startDate->diffInSeconds($endDate);
                                $elapsedDuration = $startDate->diffInSeconds($currentDate);
                                $progressPercentage = min(100, max(0, ($elapsedDuration / $totalDuration) * 100));
                            @endphp

                            <div class="timeline-track">
                                <div class="timeline-progress" style="width: {{ $progressPercentage }}%"></div>

                                <div class="timeline-marker start">
                                    <div class="timeline-label">Mulai</div>
                                    <div class="timeline-date">{{ $startDate->format('d M Y') }}</div>
                                </div>

                                <div class="timeline-marker current"
                                    style="--progress-percentage: {{ $progressPercentage }}%">
                                    <div class="timeline-label">Sekarang</div>
                                    <div class="timeline-date">{{ $currentDate->format('d M Y') }}</div>
                                </div>

                                <div class="timeline-marker end">
                                    <div class="timeline-label">Selesai</div>
                                    <div class="timeline-date">{{ $endDate->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <div class="premium-label">Progres Kampanye</div>
                                <div class="fw-bold">{{ round($progressPercentage) }}% Selesai</div>
                            </div>
                            <div class="text-end">
                                <div class="premium-label">Sisa Waktu</div>
                                <div class="fw-bold">{{ $daysRemaining }} hari</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Discount Tiers -->
            <div class="premium-card mt-4">
                <div class="premium-card-header">
                    <span style="color: #183018;">Tingkatan Diskon</span>
                    <div class="premium-card-header-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <div class="premium-card-body">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Level Tingkatan</th>
                                <th>Syarat Pembelian</th>
                                <th>Jenis Diskon</th>
                                <th>Nilai Diskon</th>
                                <th>Penghematan Pelanggan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promo->tiers as $tier)
                                <tr>
                                    <td>
                                        <span class="tier-badge tier-{{ $tier->tier_level }}">
                                            <i class="bi bi-star-fill me-2"></i> Tingkat {{ $tier->tier_level }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-basket me-2 text-muted"></i>
                                            <div>
                                                <div class="fw-medium">{{ $tier->min_quantity }} item</div>
                                                <small class="text-muted">Minimal pembelian</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($tier->discount_type)
                                            @case('percentage')
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-percent me-2 text-primary"></i>
                                                    <div>Diskon Persentase</div>
                                                </div>
                                            @break

                                            @case('nominal')
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-currency-dollar me-2 text-primary"></i>
                                                    <div>Diskon Nominal Tetap</div>
                                                </div>
                                            @break

                                            @case('package')
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-box me-2 text-primary"></i>
                                                    <div>Harga Paket</div>
                                                </div>
                                            @break

                                            @default
                                                <div>Diskon Standar</div>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">
                                            @switch($tier->discount_type)
                                                @case('percentage')
                                                    {{ $tier->discount_value }}% Potongan
                                                @break

                                                @case('nominal')
                                                    Rp {{ number_format($tier->discount_value, 0, ',', '.') }} Per Item
                                                @break

                                                @case('package')
                                                    Rp {{ number_format($tier->package_price, 0, ',', '.') }} Untuk
                                                    {{ $tier->min_quantity }} Item
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $avgPrice = $promo->products->avg('regular_price');
                                            $regularTotal = $avgPrice * $tier->min_quantity;

                                            if ($tier->discount_type == 'percentage') {
                                                $discountedTotal = $regularTotal * (1 - $tier->discount_value / 100);
                                                $savings = $regularTotal - $discountedTotal;
                                            } elseif ($tier->discount_type == 'nominal') {
                                                $savings = $tier->discount_value * $tier->min_quantity;
                                            } elseif ($tier->discount_type == 'package') {
                                                $savings = $regularTotal - $tier->package_price;
                                            } else {
                                                $savings = 0;
                                            }

                                            $savingsPercentage = ($savings / $regularTotal) * 100;
                                        @endphp

                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="fw-bold text-success">Rp
                                                    {{ number_format($savings, 0, ',', '.') }}</div>
                                                <small class="text-muted">Est. total penghematan</small>
                                            </div>
                                            <span class="discount-percentage">{{ round($savingsPercentage) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="alert alert-light mt-4 discount-info">
                        <h6 class="d-flex align-items-center">
                            <i class="bi bi-megaphone me-2"></i>
                            <span>Deskripsi Semua Tingkat Diskon</span>
                        </h6>
                        <div class="mt-2">
                            {!! $promo->all_discount_tiers !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products in Promo -->
            <div class="premium-card mt-4">
                <div class="premium-card-header">
                    <span style="color: #183018;">Produk Unggulan dalam Promo</span>
                    <div class="premium-card-header-icon">
                        <i class="bi bi-grid"></i>
                    </div>
                </div>
                <div class="premium-card-body">
                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <h6 class="info-title">Total Produk</h6>
                                </div>
                                <div class="stat-value">{{ count($promo->products) }}</div>
                                <small class="text-muted">Item yang memenuhi syarat diskon</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <h6 class="info-title">Harga Rata-rata</h6>
                                </div>
                                <div class="stat-value">Rp
                                    {{ number_format($promo->products->avg('regular_price'), 0, ',', '.') }}</div>
                                <small class="text-muted">Sebelum diskon</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <h6 class="info-title">Tersedia</h6>
                                </div>
                                @php
                                    $inStockCount = $promo->products->where('stock_quantity', '>', 0)->count();
                                @endphp
                                <div class="stat-value">{{ $inStockCount }}</div>
                                <small
                                    class="text-muted">{{ round(($inStockCount / count($promo->products)) * 100) }}%
                                    ketersediaan</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-tag"></i>
                                    </div>
                                    <h6 class="info-title">Penghematan Terbaik</h6>
                                </div>
                                @php
                                    $lastTier = $promo->tiers->last();
                                    $bestPercentage = 0;

                                    if ($lastTier->discount_type == 'percentage') {
                                        $bestPercentage = $lastTier->discount_value;
                                    } elseif ($lastTier->discount_type == 'nominal') {
                                        $avgPrice = $promo->products->avg('regular_price');
                                        $bestPercentage = ($lastTier->discount_value / $avgPrice) * 100;
                                    } elseif ($lastTier->discount_type == 'package') {
                                        $avgPrice = $promo->products->avg('regular_price');
                                        $regularTotal = $avgPrice * $lastTier->min_quantity;
                                        $bestPercentage =
                                            (($regularTotal - $lastTier->package_price) / $regularTotal) * 100;
                                    }
                                @endphp
                                <div class="stat-value">{{ round($bestPercentage) }}%</div>
                                <small class="text-muted">Diskon maksimum yang tersedia</small>
                            </div>
                        </div>
                    </div>

                    <!-- Product Cards Grid View -->
                    <div class="product-grid">
                        @foreach ($promo->products as $product)
                            <div class="product-card">
                                <div class="product-image-container">
                                    <img src="{{ Storage::url($product->main_image) }}"
                                        alt="{{ $product->product_name }}" class="product-image"
                                        onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                    @if ($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                                        <div class="product-badge">Stok Terbatas</div>
                                    @elseif($product->stock_quantity == 0)
                                        <div class="product-badge"
                                            style="background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);">
                                            Habis</div>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <h5 class="product-name">{{ $product->product_name }}</h5>
                                    <p class="product-description">{{ Str::limit($product->description, 100) }}</p>

                                    <div class="price-comparison">
                                        <span class="original-price">Rp
                                            {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                        @php
                                            $bestTier = $promo->tiers->last();
                                            $discountedPrice = 0;

                                            if ($bestTier->discount_type == 'percentage') {
                                                $discountedPrice =
                                                    $product->regular_price * (1 - $bestTier->discount_value / 100);
                                            } elseif ($bestTier->discount_type == 'nominal') {
                                                $discountedPrice = $product->regular_price - $bestTier->discount_value;
                                            } elseif ($bestTier->discount_type == 'package') {
                                                $discountedPrice = $bestTier->package_price / $bestTier->min_quantity;
                                            }

                                            $discountedPrice = max(0, $discountedPrice);
                                            $savingsPercentage =
                                                (($product->regular_price - $discountedPrice) /
                                                    $product->regular_price) *
                                                100;
                                        @endphp
                                        <span class="discount-price">Rp
                                            {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                        <span class="discount-percentage">-{{ round($savingsPercentage) }}%</span>
                                    </div>

                                    <div class="product-meta">
                                        <div class="product-stock">
                                            @if ($product->stock_quantity > 10)
                                                <span class="stock-badge in-stock"></span>
                                                <span>Tersedia ({{ $product->stock_quantity }})</span>
                                            @elseif($product->stock_quantity > 0)
                                                <span class="stock-badge low-stock"></span>
                                                <span>Stok Terbatas ({{ $product->stock_quantity }})</span>
                                            @else
                                                <span class="stock-badge out-of-stock"></span>
                                                <span>Habis</span>
                                            @endif
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Table View (Hidden by Default) -->
                    <div class="table-responsive mt-4" id="tableView" style="display: none;">
                        <table class="premium-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Harga Asli</th>
                                    <th>Harga Terbaik</th>
                                    <th>Penghematan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promo->products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ Storage::url($product->main_image) }}"
                                                alt="{{ $product->product_name }}"
                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-sm); cursor: pointer;"
                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $product->product_name }}</div>
                                            <small
                                                class="text-muted">{{ Str::limit($product->description, 60) }}</small>
                                        </td>
                                        <td>
                                            @if ($product->stock_quantity > 10)
                                                <span class="badge bg-success">Tersedia
                                                    ({{ $product->stock_quantity }})
                                                </span>
                                            @elseif($product->stock_quantity > 0)
                                                <span class="badge bg-warning text-dark">Stok Terbatas
                                                    ({{ $product->stock_quantity }})</span>
                                            @else
                                                <span class="badge bg-danger">Habis</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-medium">Rp
                                                {{ number_format($product->regular_price, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            @php
                                                $bestTier = $promo->tiers->last();
                                                $discountedPrice = 0;

                                                if ($bestTier->discount_type == 'percentage') {
                                                    $discountedPrice =
                                                        $product->regular_price * (1 - $bestTier->discount_value / 100);
                                                } elseif ($bestTier->discount_type == 'nominal') {
                                                    $discountedPrice =
                                                        $product->regular_price - $bestTier->discount_value;
                                                } elseif ($bestTier->discount_type == 'package') {
                                                    $discountedPrice =
                                                        $bestTier->package_price / $bestTier->min_quantity;
                                                }

                                                $discountedPrice = max(0, $discountedPrice);
                                            @endphp
                                            <div class="fw-bold text-primary">Rp
                                                {{ number_format($discountedPrice, 0, ',', '.') }}</div>
                                            <small class="text-muted">dengan {{ $bestTier->min_quantity }}+
                                                item</small>
                                        </td>
                                        <td>
                                            @php
                                                $savings = $product->regular_price - $discountedPrice;
                                                $savingsPercentage = ($savings / $product->regular_price) * 100;
                                            @endphp
                                            <div class="fw-bold text-success">Rp
                                                {{ number_format($savings, 0, ',', '.') }}</div>
                                            <span class="discount-percentage">{{ round($savingsPercentage) }}%</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <a href="{{ route('index-promo-diskon') }}" class="premium-btn">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Promo
                    </a>
                </div>
            </div>
        </div>

        <script>
            // Fungsi untuk membuka gambar di tab baru
            function openImageInNewTab(url) {
                window.open(url, '_blank');
            }
        </script>

        <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
</body>

</html>
