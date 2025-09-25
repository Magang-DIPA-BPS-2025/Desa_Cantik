@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons-wind.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Admin Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUsers }}
                            </div>
                            <div class="card-footer">
                                <small>All registered users</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">       
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Guru</h4>
                            </div>
                            <div class="card-body">
                                <h6>1</h6>
                            </div>
                            <div class="card-footer">
                                <small>Teaching staff</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAdmin }}
                            </div>
                            <div class="card-footer">
                                <small>Administrator accounts</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistik User --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Statistics</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="userChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script>
            $(document).ready(function () {
                // User Statistics Chart
                var ctx = document.getElementById('userChart').getContext('2d');
                var userChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'New Users',
                            data: [{{ implode(',', $monthlyUsers) }}],
                            borderColor: '#6777ef',
                            backgroundColor: 'transparent',
                            borderWidth: 2,
                            pointBackgroundColor: '#fff',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                },
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }]
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
