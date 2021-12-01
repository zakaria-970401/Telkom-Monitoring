@extends('layouts.base-display')

@section('title', 'DASHBOARD REPORT GANGGUAN')

@push('styles')
    <link rel="stylesheet" href="{{ url('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <style type="text/css">

    </style>
@endpush

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body CardAppend">
            <div class="row">
                <div class="col-sm-7">
                    <div id="performa_day" style="border-radius: 18px;"></div>
                </div>
                <div class="col-sm-5">
                    <div id="line_bulanan" class="mt-4"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-4">
                    <div id="pie" style="border-radius: 18px;"></div>
                </div>
                <div class="col-sm-6 mt-4">
                    <div id="teknisi" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
        <ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">
            <li class="nav-item mb-2" id="kt_demo_panel_toggle" data-toggle="tooltip" title="" data-placement="left" data-original-title="Custom Date">
            <a class="btn btn-sm btn-icon btn-bg-light btn-icon-dark btn-hover-dark" href="#modal_search" data-toggle="modal">
                <i class="fas fa-search"></i>
            </a>
        </li>
    </ul>
</div>

<div class="modal fade" id="modal_search" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                              <input type="date" name="" id="" class="form-control TglMulai" placeholder="" aria-describedby="helpId">
                              <small id="helpId" class="text-danger">Mulai Dari</small>
                        </div>
                        <div class="col-sm-6">
                              <input type="date" name="" id="" class="form-control TglSelesai" placeholder="" aria-describedby="helpId">
                              <small id="helpId" class="text-danger">Sampai</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type=" button" class="btn btn-primary btn-block BtnSearch" id="Lihat"><i class="fas fa-search"></i>
                        Cari</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="detail_tiket" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tiket <b class="DetailTiketValue"></b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">No. Gangguan</label>
                                <input type="text" name="no_gangguan" id="" class="form-control NoGangguanValue" placeholder="" autocomplete="off"  readonly value="" />
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" id="" class="form-control NamaPelangganValue" placeholder="Masukan Nama Pelanggan" autocomplete="off" readonly />
                            </div>
                            <div class="form-group">
                                <label for="">Titik Access Point</label>
                                <input type="text" name="titik_ap" id="" class="form-control TitikAPValue" placeholder="Masukan Titik Access Point" autocomplete="off" readonly />
                            </div>
                            <div class="form-group">
                                <label for="">SN AP</label>
                                <input type="text" name="sn_ap" id="" class="form-control SNAPValue" placeholder="Masukan Serial Number AP" autocomplete="off" readonly />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">ID Pelanggan</label>
                                <input type="text" name="id_pelanggan" id="" class="form-control IdPelangganValue" placeholder="Masukan ID Pelanggan" autocomplete="off" readonly />
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pelanggan</label>
                                <input type="text" name="alamat" id="" class="form-control AlamatPelangganValue" placeholder="Masukan Alamat Pelanggan" autocomplete="off" readonly />
                            </div>
                            <div class="form-group">
                                <label for="">Titik ONT</label>
                                <input type="text" name="titik_ont" id="" class="form-control TitikONTValue" placeholder="Masukan Alamat Pelanggan" autocomplete="off" readonly />
                            </div>
                                <div class="form-group">
                                <label for="">SN ONT</label>
                                <input type="text" name="sn_ont" id="" class="form-control SNONTValue" placeholder="Masukan Serial Number ONT" autocomplete="off" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="">Tipe Gangguan</label>
                            <select class="form-control TipeGangguanValue" disabled name="kode_gangguan" id="" readonly>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="">Group Area</label>
                            <select class="form-control KodeAreaValue" disabled name="kode_area" id="" readonly>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Titik Lokasi Pelanggan</label>
                                <textarea class="form-control LokasiPelangganValue" name="kordinat_pelanggan" id="TitikLokasi" rows="3" placeholder="Masukan Lokasi Pelanggan" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    @endsection

    @push('scripts')

        <script src="{{ url('/') }}/assets/js/highcharts/highcharts.js"></script>
        <script src="{{ url('/') }}/assets/js/highcharts/data.js"></script>
        <script src="{{ url('/') }}/assets/js/highcharts/drilldown.js"></script>
        <script src="{{ url('/') }}/assets/js/highcharts/exporting.js"></script>
        <script src="{{ url('/') }}/assets/js/highcharts/export-data.js"></script>
        <script src="{{ url('/') }}/assets/js/highcharts/accessibility.js"></script>
        <script src="{{ url('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

        <script type="text/javascript">
        $('.table').DataTable({
          "ordering": false, 
        });

        $('.BtnSearch').on('click', function(){
            var mulai = $('.TglMulai').val();
            var selesai = $('.TglSelesai').val();

            $.ajax({
                url: 'cari_report/' + mulai + '/' +selesai,
                type: "get",
                dataType: "JSON",
                data: {
                    mulai : mulai,
                    selesai : selesai,
                },
                success: function(response) {
                    if(response.status == 1)
                    {
                        $('#modal_search').modal('hide')
                        $('.CardAppend').html("")
                        $('.CardAppend').append('<div class="row">\
                                                <div class="col-sm-12">\
                                                  <a href="javascript:location.reload();" class="btn btn-md btn-dark mb-2 mt-4 text-white" style="border-radius: 13px;"><i class="fas fa-arrow-left text-white mr-2"></i> Kembali</a>\
                                                  <a href="/download_excel/'+mulai+'/'+selesai+'" class="btn btn-md mb-2 mt-4 text-white" style="border-radius: 13px; background-color: green;"><i class="fas fa-file-excel text-white mr-2"></i> Download Excel</a>\
                                                    <div class="table-responsive">\
                                                        <table class="table table-bordered" id="tbl_search">\
                                                            <thead>\
                                                                <tr class="text-center">\
                                                                    <th>No.</th>\
                                                                    <th>No. Gangguan</th>\
                                                                    <th>Nama Pelanggan</th>\
                                                                    <th>ID Pelanggan</th>\
                                                                    <th>Gangguan</th>\
                                                                    <th>Nama Teknisi</th>\
                                                                    <th>Penanganan</th>\
                                                                    <th class="bg-light-warning">Status</th>\
                                                                    <th class="bg-light-warning">Waktu Pengerjaan</th>\
                                                                </tr>\
                                                            </thead>\
                                                            <tbody>\
                                                            </tbody>\
                                                        </table>\
                                                    </div>\
                                                </div>\
                                                <div class="col-sm-6 mt-4">\
                                                    <div id="teknisi_result" class="mt-4"></div>\
                                                </div>\
                                                <div class="col-sm-6 mt-4">\
                                                    <div id="pie_result" class="mt-4"></div>\
                                                </div>\
                                            </div>')
                        $('#tbl_search tbody').html("")

                        $.each(response.data.data, function(id, value) {
                            console.log(value);
                             var days = daysdifference(value.tgl_create, value.tgl_teknisi);  
                            // Add two dates to two variables    
                                
                            function daysdifference(firstDate, secondDate){  
                                var startDay = new Date(firstDate);  
                                var endDay = new Date(secondDate);  
                            
                            // Determine the time difference between two dates     
                                var millisBetween = startDay.getTime() - endDay.getTime();  
                            
                            // Determine the number of days between two dates  
                                var days = millisBetween / (1000 * 3600 * 24);  
                            
                            // Show the final number of days between dates     
                                return Math.round(Math.abs(days));  
                            }  
                            if(value.status == 0)
                            {
                                status = '<span class="badge bagde-pill badge-info"> Sudah Dikerjakan</span>'
                            }
                            else
                            {
                                status = '<span class="badge bagde-pill badge-dark"> Belum Dikerjakan</span>'
                            }
                            if(days == 0 && value.status == 1)
                            {
                                day = '<span class="badge bagde-pill badge-dark">-</span>'
                            }
                            else if(days == 0){
                                day = '<span class="badge badge-info"> Tepat</span>'
                            }
                            else
                            {
                                day = '<span class="badge badge-danger">'+days+' Hari</span>'
                            }
                           

                        $('#tbl_search tbody').append('<tr class="text-center">\
                                        <td>'+(parseInt(id) + 1)+'</td>\
                                        <td><a href="javascript:void(0)" onclick="detail(\''+value.no_gangguan+'\')">'+value.no_gangguan+'</a></td>\
                                        <td>'+value.nama_pelanggan+'</td>\
                                        <td>'+value.id_pelanggan+'</td>\
                                        <td>'+value.deskripsi+'</td>\
                                        <td>'+value.nama_teknisi+'</td>\
                                        <td>'+value.penanganan+'</td>\
                                        <td class="bg-light-warning">'+status+'</td>\
                                        <td class="bg-light-warning">'+day+'</td>\
                                        </tr>');
                    });

                    Highcharts.chart('teknisi_result', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'ALL AREA TANGGAL' + ' ' + mulai + ' '+ ' Sampai' + ' ' +selesai
                                },
                                xAxis: {
                                    categories: ['RAWA MANGUN', 'JATINEGARA', 'PASAR REBO'],
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        align: 'high'
                                    },
                                    labels: {
                                        overflow: 'justify'
                                    }
                                },
                                tooltip: {
                                    valueSuffix: ' Solved'
                                },
                                plotOptions: {
                                    column: {
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                series: [{
                                    name: 'AREA',
                                    data: [
                                        response.data.rawamangun,
                                        response.data.jatinegara,
                                        response.data.pasarebo,
                                    ]
                                }]
                            });

                            Highcharts.chart('pie_result', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie',
                                    },
                                    title: {
                                        text: 'ALL AREA TANGGAL' + ' ' + mulai + ' '+ ' Sampai' + ' ' +selesai
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y}',
                                                connectorColor: 'silver'
                                            }
                                        }
                                    },
                                    series: [{
                                                    name: 'Jumlah',
                                                    colorByPoint: true,
                                                    data: response.data.pie_result
                                                }]
                                });
                  }
                },
                error: function(error) {
					Swal.fire({
							position: "bottom-right",
							icon: "error",
							title: "Fitur ini hanya bisa di nikmati oleh helpdesk",
							showConfirmButton: false,
							allowOutsideClick: false,
							allowEscapeKey: false,
							timer: 3500
						});
				}
			});
        });

    function detail(no_gangguan)
    {
          jQuery.ajax({
                url: '/dashboard/detail/' + no_gangguan,
                type: "GET",
                data: {
                    no_gangguan: no_gangguan
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1)
                    {
                        $('#detail_tiket').modal('show')
                        $('.DetailTiketValue').text(no_gangguan)
                        $('.NoGangguanValue').val(no_gangguan)
                        $('.NamaPelangganValue').val(response.data[0].nama_pelanggan)
                        $('.TitikAPValue').val(response.data[0].titik_ap)
                        $('.TitikONTValue').val(response.data[0].titik_ont)
                        $('.SNAPValue').val(response.data[0].sn_ap)
                        $('.IdPelangganValue').val(response.data[0].id_pelanggan)
                        $('.AlamatPelangganValue').val(response.data[0].alamat)
                        $('.SNONTValue').val(response.data[0].sn_ont)
                        $('.LokasiPelangganValue').val(response.data[0].kordinat_pelanggan)

                        $('.TipeGangguanValue').append('<option value="'+response.data[1].deskripsi+'">'+response.data[1].deskripsi+'</option>')
                        $('.KodeAreaValue').append('<option value="'+response.data[0].kode_area+'">'+response.data[0].kode_area+'</option>')
                    }
                }
            });
    }

        // $(document).ready(function() {
        //     setInterval(function() {
        //         location.reload()
        //     }, 300000);
        // });

        Highcharts.chart('performa_day', {
                        chart: {
                            type: 'spline',
                            backgroundColor: '#e0dce0',
                        },
                        title: {
                            text: 'GANGGUAN PER-HARI'
                        },

                        yAxis: {
                            title: {
                                text: 'GANGGUAN PER-HARI'
                            },
                            accessibility: {
                                description: 'Percentage usage'
                            }
                        },

                        xAxis: {
                            title: {
                                text: 'TANGGAL'
                            },
                            categories: {!!json_encode($day)!!}
                        },

                        tooltip: {
                            valueSuffix: ' Data'
                        },

                        plotOptions: {
                            series: {
                                point: {
                                    events: {
                                        click: function() {
                                            alert(this.x);
                                            // window.location.href = this.series.options.website;
                                        }
                                    }
                                },
                                cursor: 'pointer',
                                dataLabels: {
                                                enabled: true,
                                                format: '{y}'
                                            },
                            }
                        },
                        series: [{
                            name: 'DATA GANGGUAN PER-HARI',
                            data: {!! json_encode($data_harian)!!},
                            website: '',
                            color: "#9500c7",
                        }],
                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 550
                                },
                                chartOptions: {
                                    chart: {
                                        spacingLeft: 3,
                                        spacingRight: 3
                                    },
                                    legend: {
                                        itemWidth: 150
                                    },
                                    xAxis: {
                                        categories: ['Dec. 2010'],
                                        title: ''
                                    },
                                    yAxis: {
                                        visible: false
                                    }
                                }
                            }]
                        }
                    });

        // Radialize the colors
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

// Build the chart
Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
    },
    title: {
        text: 'RATA-RATA GANGGUAN BULANAN'
    },
    // tooltip: {
    //     pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
    // },
    // accessibility: {
    //     point: {
    //         valueSuffix: '%'
    //     }
    // },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
                    name: 'Jumlah',
                    colorByPoint: true,
                    data: {!! json_encode($pie) !!}
                }]
});

Highcharts.chart('line_bulanan', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'GANGGUAN PER-BULAN'
    },
    xAxis: {
        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'GANGGUAN PER-BULAN'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'DATA GANGGUAN PER-BULAN TAHUN ' + '{{date('Y')}}',
        data: {!! json_encode($data_bulan)!!}
    }]
});

Highcharts.chart('teknisi', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'REWARD TEKNISI TAHUNAN'
    },
    xAxis: {
        categories: ['RAWA MANGUN', 'JATINEGARA', 'PASAR REBO'],
    },
    yAxis: {
        min: 0,
        title: {
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Solved'
    },
    plotOptions: {
        column: {
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [{
        name: 'AREA',
        data: [
            {!!json_encode($rawamangun)!!},
            {!!json_encode($jatinegara)!!},
            {!!json_encode($pasarebo)!!}
        ]
    }]
});

      
        </script>

    @endpush
