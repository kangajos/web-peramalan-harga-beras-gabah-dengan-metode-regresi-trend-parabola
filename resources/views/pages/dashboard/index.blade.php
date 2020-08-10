@extends('layouts.main')
@section('title')
    Dasboard
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-money fa fa-money text-success border-success"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text font-weight-bold">Total Porfit Gabah</div>
                            <div class="stat-digit"><b>{{number_format($_total_gabah)}}</b></div>
                        </div>
                        <a href="{{url("transaksi")}}" class="btn btn-success btn-md pull-right">Lihat Detail <span
                                    class="fa fa-eye"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-money fa fa-money text-success border-success"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text font-weight-bold">Total Profit Beras</div>
                            <div class="stat-digit"><b>{{number_format($_total_beras)}}</b></div>
                        </div>
                        <a href="{{url("transaksi")}}" class="btn btn-success btn-md pull-right">Lihat Detail <span
                                    class="fa fa-eye"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="chartjs-size-monitor"
                         style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                             style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                             style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <h4 class="mb-3">Bar Chart GABAH</h4>
                    <canvas id="barChart" height="700" width="701" class="chartjs-render-monitor"
                            style="display: block; width: 701px; height: 701px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="chartjs-size-monitor"
                         style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                             style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                             style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <h4 class="mb-3">Bar Chart BERAS</h4>
                    <canvas id="barChart2" height="700" width="701" class="chartjs-render-monitor"
                            style="display: block; width: 701px; height: 701px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('barchart')

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
        //bar chart
        var ctx = document.getElementById("barChart");
        //    ctx.height = 200;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [{!! $bulan_gabah_hasil !!}],
                datasets: [
                    {!! $barchart_gabah !!}
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //bar chart beras
        var ctx = document.getElementById("barChart2");
        //    ctx.height = 200;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [{!! $bulan_beras_hasil !!}],
                datasets: [
                    {!! $barchart_beras !!}
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

@endsection