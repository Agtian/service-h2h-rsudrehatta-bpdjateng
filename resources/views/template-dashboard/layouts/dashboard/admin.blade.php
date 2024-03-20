@extends('template-dashboard.main')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Get bill data</p>
                                <h5 class="font-weight-bolder">
                                    {{ $countBillData }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                    this year {{ date('Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Payment completed</p>
                                <h5 class="font-weight-bolder">
                                    {{ $countPaymentCompleted }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    this year {{ date('Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-diamond text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">RESPONSE CONNECTED</p>
                                <h5 class="font-weight-bolder">
                                    {{ $countResponseConnected }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder"></span>
                                    this year {{ date('Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-like-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">RESPONSE CONNECTION FAILED</p>
                                <h5 class="font-weight-bolder">
                                    {{ $countResponseConnectionFailed }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder"></span>this year {{ date('Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-sound-wave text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Quantity Request API</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">{{ $getCountHistoryApiAll }} Count Request</span> in {{ date('Y') }}
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-12 mb-lg-0 mt-4 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Quantity Request API Users</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">{{ $getCountHistoryApiAll }} Count Request</span> in {{ date('Y') }}
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="line-chart" class="chart-canvas" height="300px"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row mt-4">
            <div class="col-lg-12">
                @include('template-dashboard.inc.alert')
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Quantity Request API Users</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            @forelse ($getQuantityRequestUser as $item)
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                            <img src="{{ asset('asset/img/user-286.png') }}" width="40" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">User:</p>
                                            <h6 class="text-sm mb-0">{{ $item->company_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Project:</p>
                                        <h6 class="text-sm mb-0">{{ $item->project_name }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Request API:</p>
                                        <h6 class="text-sm mb-0">{{ $item->used_quantity }}</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Year:</p>
                                        <h6 class="text-sm mb-0">{{ date('Y') }}</h6>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data not found !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">User Request API</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @forelse ($resultUserRequestActivate as $item)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-primary shadow text-center">
                                        <i class="ni ni-tag text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{ $item->company }}</h6>
                                        <span class="text-xs">{{ $item->name }}, <span class="font-weight-bold">{{ $item->email }}</span>, <span class="font-weight-bold">{{ $item->no_hp }}</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ url("dashboard/activating-user/".Crypt::encryptString($item->id)."/user") }}" class="btn btn-sm bg-gradient-primary"><i class="ni ni-check-bold" aria-hidden="true"></i> Activation</a>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <span class="text-xs">Request not found</span>
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: [@foreach ($getHistoryApiAll as $item)
                        '@php echo "$item->bulan"; @endphp',
                    @endforeach],
                    // ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Quantity Request",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [@foreach ($getHistoryApiAll as $item)
                        '@php echo "$item->used_quantity"; @endphp',
                    @endforeach],
                // [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                          size: 11,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                    }
              },
              x: {
                  grid: {
                      drawBorder: false,
                      display: false,
                      drawOnChartArea: false,
                      drawTicks: false,
                      borderDash: [5, 5]
                  },
                  ticks: {
                      display: true,
                      color: '#ccc',
                      padding: 20,
                      font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                      },
                  }
              },
            },
        },
    });
</script>
<script>
    // Line chart
    var ctx2 = document.getElementById("line-chart").getContext("2d");
    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
    new Chart(ctx2, {
    type: "line",
    data: {
        labels: [@foreach ($getHistoryApiAll as $item)
                        '@php echo "$item->bulan"; @endphp',
                    @endforeach],
        datasets: [
            @foreach ($getHistoryApiUsersH2HBPDJateng as $item)
            {
                label: @php echo "'$item->company_name'"; @endphp,
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 2,
                pointBackgroundColor: @php echo "'$item->color'"; @endphp,
                borderColor: @php echo "'$item->color'"; @endphp,
                borderWidth: 3,
                backgroundColor: gradientStroke2,
                data: [
                @php
                    foreach (SMSHelper::arrQuantityRequestAPIUsers($item->api_key_id) as $x => $y) {
                        echo "$y".',';
                    }
                @endphp],
                // @php echo "[$item->api_key_id.$item->bulanAngka]" @endphp,
                // [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6
            },
            @endforeach
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
        },
        interaction: {
        intersect: false,
        mode: 'index',
        },
        scales: {
        y: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        x: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 10,
            font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        },
    },
    });
</script>
@endpush
