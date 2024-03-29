@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="container mb-4 text-center">
            <h1 class="mt-3">Analysis Chart</h1>
        </div>


        <form action="#" method="GET">
            @csrf
            <div class="form-group mb-3">
                <div class="card p-3">
                    <div class="d-flex flex-row">
                        <div class="col-4 pe-2">
                            <div class="form-floating">
                                <select name="type" id="type" class="form-select">
                                    <option hidden value="">Choose type...</option>
                                    <option>Inner</option>
                                    <option>Outer</option>
                                    <option>TTC</option>
                                </select>
                                <label for="type" class="form-label text-black" style="font-weight: bold">Type</label>
                            </div>
                        </div>
                        <div class="col-4 pe-2">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="start_date" id="start_date">
                                <label for="start_date" class="form-label text-black" style="font-weight: bold">Start
                                    Date</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="end_date" id="end_date">
                                <label for="end_date" class="form-label text-black" style="font-weight: bold">End
                                    Date</label>
                            </div>
                        </div>
                    </div>
                    <button id="search" type="submit" class="btn btn-primary mt-3 w-100">Search</button>
                </div>
            </div>
        </form>


        <h1>Voltage</h1>
        <div class="chartBox mb-4"
            style="padding: 20px;border-radius: 20px;border: solid 3px rgba(54, 162, 235, 1);background: white;">
            <canvas id="voltageChart" height="120"></canvas>
        </div>

        <h1>Current</h1>
        <div class="chartBox mb-4"
            style="padding: 20px;border-radius: 20px;border: solid 3px rgba(54, 162, 235, 1);background: white;">
            <canvas id="currentChart" height="120"></canvas>
        </div>

        <h1>Temperature</h1>
        <div class="chartBox mb-4"
            style="padding: 20px;border-radius: 20px;border: solid 3px rgba(54, 162, 235, 1);background: white;">
            <canvas id="tempChart" height="120"></canvas>
        </div>
    </div>
    <script>
        var vol = document.getElementById('voltageChart');
        var cur = document.getElementById('currentChart');
        var tmp = document.getElementById('tempChart');

        var detailChartVol = new Chart(vol, {
            type: "line",
            data: {
                labels: [],
                datasets: [],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                plugins: {
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            drag: {
                                enabled: true
                            },
                            mode: 'xy',
                        },
                    }
                }
            },
        });

        var detailChartCur = new Chart(cur, {
            type: "line",
            data: {
                labels: [],
                datasets: [],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                plugins: {
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            drag: {
                                enabled: true
                            },
                            mode: 'xy',
                        },
                    }
                }
            },
        });

        var detailChartTmp = new Chart(tmp, {
            type: "line",
            data: {
                labels: [],
                datasets: [],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                plugins: {
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            drag: {
                                enabled: true
                            },
                            mode: 'xy',
                        },
                    }
                }
            },
        });


        $(window).on('load', function() {
            start_date = ''
            end_date = ''
            type = ''
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Info!',
                text: 'Isi range tanggal terlebih dahulu',
                showConfirmButton: false,
                timer: 2000
            })
        })

        var updateChart = function(start_date, end_date, type) {

            if ((start_date == '' && end_date == '') || type == '') {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Isi range tanggal terlebih dahulu',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {

                $.ajax({
                    url: "/analysis/all",
                    type: "GET",
                    dataType: "json",
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        type: type,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(data) {
                        // LABELS 
                        detailChartVol.data.labels = data.labels;
                        detailChartCur.data.labels = data.labels;
                        detailChartTmp.data.labels = data.labels;

                        // LABEL => NAMA RECTIFIERS
                        detailChartVol.data.datasets = data.datasetsVol;
                        detailChartCur.data.datasets = data.datasetsCur;
                        detailChartTmp.data.datasets = data.datasetsTmp;

                        // UPDATE SERIES CHART
                        detailChartVol.update();
                        detailChartCur.update();
                        detailChartTmp.update();
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            }

        };


        $('#search').click(function(e) {
            e.preventDefault();
            start_date = $('#start_date').val()
            end_date = $('#end_date').val()
            type = $('#type').val()

            console.log(`start date: ${start_date} | end date: ${end_date} | type: ${type}`);

            updateChart(start_date, end_date, type)
            // updateChartVoltage(start_date, end_date)
            // updateChartCurrent(start_date, end_date)
            // updateChartTmp(start_date, end_date)
        })
    </script>
@endsection
