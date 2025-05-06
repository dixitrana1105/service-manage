@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12 text-center">
                    <h1 class="font-weight-bold text-primary">Admin Dashboard</h1>
                    <h5>
                        <p class="text-secondary mt-2" id="currentDateTime">
                            {{ now()->format('l, F j, Y - h:i A') }}
                        </p>
                    </h5>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">

            <!-- Company Growth Graph (Top Section) -->
            <div class="row mt-4 mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
                            <h3 class="card-title mb-0 fw-bold">
                                <i class="fas fa-chart-line me-2"></i> IT - Base Company Growth Overview
                            </h3>
                        </div>

                        <div class="card-body position-relative bg-light rounded-bottom text-center p-4"
                            style="min-height: 300px;">

                            {{-- Optional watermark --}}
                            <div class="watermark-text" style="
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            font-size: 60px;
                            font-family: 'Times New Roman', Times, serif;
                            color: rgba(0, 0, 0, 0.05);
                            white-space: nowrap;
                            pointer-events: none;
                            z-index: 0;">
                                companyGrowthChart
                            </div>

                            {{-- Chart Canvas --}}
                            <canvas id="companyGrowthChart" style="position: relative; z-index: 1;"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Stats Cards (Users, Companies, Branches) - Displayed in a Horizontal Row -->
            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="card card-watermark border-0 shadow-lg rounded-lg text-center p-3 bg-light"
                        data-watermark="Clients">
                        <div class="card-body">
                            <i class="fas fa-user-friends fa-3x text-primary"></i>
                            <h3 class="mt-2">{{ $clientCount }}</h3>
                            <p class="text-muted"><strong style="font-family: 'Times New Roman', Times, serif;">Total
                                    Clients</strong></p>
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-primary btn-sm">View
                                Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-watermark border-0 shadow-lg rounded-lg text-center p-3 bg-light"
                        data-watermark="Services">
                        <div class="card-body">
                            <i class="fas fa-tools fa-3x text-success"></i>
                            <h3 class="mt-2">{{ $serviceCount }}</h3>
                            <p class="text-muted"><strong style="font-family: 'Times New Roman', Times, serif;">Total
                                    Services</strong></p>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-success btn-sm">View
                                Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-watermark border-0 shadow-lg rounded-lg text-center p-3 bg-light"
                        data-watermark="Users">
                        <div class="card-body">
                            <i class="fas fa-users nav-icon fa-3x text-warning"></i>
                            <!-- <i class="fas fa-calendar-alt fa-3x text-warning"></i> -->
                            <h3 class="mt-2">{{ $userCount }}</h3>
                            <p class="text-muted"><strong style="font-family: 'Times New Roman', Times, serif;">Total
                                    Users</strong></p>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-warning btn-sm">View
                                Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-watermark border-0 shadow-lg rounded-lg text-center p-3 bg-light"
                        data-watermark="Appoinment">
                        <div class="card-body">
                            <!-- <i class="fas fa-users nav-icon fa-3x text-warning"></i> -->
                            <i class="fas fa-calendar-alt fa-3x text-warning"></i>
                            <h3 class="mt-2">{{ $appointmentCount }}</h3>
                            <p class="text-muted"><strong style="font-family: 'Times New Roman', Times, serif;">Total
                                    Appoinment</strong></p>
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-warning btn-sm">View
                                Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-watermark border-0 shadow-lg rounded-lg text-center p-3 bg-light"
                        data-watermark="Subscribers">
                        <div class="card-body">
                            <!-- <i class="fas fa-users nav-icon fa-3x text-warning"></i> -->
                            <i class="fa-solid fa-bell fa-3x text-warning"></i>
                            <h3 class="mt-2">{{ $subscriberCount }}</h3>
                            <p class="text-muted"><strong style="font-family: 'Times New Roman', Times, serif;">Total
                                    Subscriber</strong></p>
                            <a href="{{ route('admin.subscribers') }}" class="btn btn-outline-warning btn-sm">View
                                Details</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@section('customJs')
    <!-- Chart Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('companyGrowthChart').getContext('2d');
            const companyGrowthChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($growthYears),
                    datasets: [{
                        label: 'Revenue Growth (in Millions)',
                        data: @json($growthRevenue),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: "top"
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Revenue (in Millions ₹)"
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Year"
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection