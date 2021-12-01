@extends('layouts.base')

@push('styles')
    <link rel="stylesheet" href="{{ url('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="card" style="border-radius: 25px;">
                    <div class="card-body">
                        <div class="alert-text text-dark text-center">
                            <h4>MENU TEKNISI</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="border-radius: 18px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 TableTeknisi" style="display: none;">
                        <h3 class="text-center">
                            <span class="badge badge-pill badge-dark mb-4">LIST OUTSTANDING PENGERJAAN {{Auth::user()->name}} </span>
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>No Gangguan</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cek_status as $item)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->no_gangguan}}</td>
                                        <td>{{$item->alamat}}</td>
                                        <td>
                                            @if($item->status == 1)
                                             <button type="button" class="btn btn-warning spinner spinner-white spinner-right"> Proses Pengerjaan</button>
                                            @else
                                            <span class="badge badge-info"> Selesai Di Kerjakan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                      <div class="col-sm-12">
                            <center><h4><b class="text-center Text" style="display: none;"> SILAHKAN SCAN BARCODE MATERIAL</b></h4></center>
                        <center>
                            <video id="reader" style="width:500px;"></video></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="detail_gangguan" data-keyboard="false"  data-static="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">FORM DETAIL WO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card custom">
                                <div class="card-header">
                                    <div class="card-toolbar">
                                        <h1>
                                        <span class="SudahDiKerjakan badge badge-info" style="display: none"> STATUS : SUDAH DI KERJAKAN</span>
                                        </h1>
                                    </div>
                                </div>
                                <form id="form_post_gangguan" action="{{url('admin_gudang/post_gangguan')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">No. Gangguan</label>
                                        <input type="text" name="no_gangguan" id="" class="form-control NoGangguanValue" placeholder="" autocomplete="off" readonly readonly value="" />
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
                                        <input type="text" name="id_pelanggan" id="" class="form-control IDPelangganValue" placeholder="Masukan ID Pelanggan" autocomplete="off" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat Pelanggan</label>
                                        <input type="text" name="alamat" id="" class="form-control AlamatPelangganValue" placeholder="Masukan Alamat Pelanggan" autocomplete="off" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Titik ONT</label>
                                        <input type="text" name="titik_ont" id="" class="form-control TitikOntValue" placeholder="Masukan Alamat Pelanggan" autocomplete="off" readonly />
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
                                     <input type="text" name="sn_ont" id="" class="form-control TipeGangguanValue" placeholder="Masukan Serial Number ONT" autocomplete="off" readonly />
                                 </div>
                                </div>
                                <div class="col-sm-6">
                                 <div class="form-group">
                                   <label for="">Group Area</label>
                                   <input type="text" name="sn_ont" id="" class="form-control GroupAreaValue" placeholder="Masukan Serial Number ONT" autocomplete="off" readonly />
                                 </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="">Titik Lokasi Pelanggan</label>
                                      <br>
                                        <a href="javascript:void(0)" onclick="ArahkanRute()" class="btn btn-sm btn-dark BtnRute"><i class="fas fa-map-marker-alt"></i> Arahkan Rute</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary BtnClose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info btn-lg BtnSelesai" style="display: none;"><i class="fas fa-check"></i> Selesai Di Kerjakan</button>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="selesai_dikerjakan"  data-keyboard="false"  data-static="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">FORM PENANGANAN WO</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card custom">
                                <form id="close_gangguan" action="{{url('teknisi/close_gangguan')}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <input type="hidden" value="" name="no_gangguan" class="NoGangguanClose">
                                            <div class="form-group">
                                              <select class="form-control PenangananValue" name="penanganan" id="">
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info btn-lg BtnSave"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
           

@endsection
@push('scripts')
    <script src="{{ url('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('/assets/js/instascan.min.js') }}"></script>


    <script type="text/javascript">
        $('.table').DataTable();

        @if(count($cek_status) > 0)
        {
            $('.TableTeknisi').show();
        }
        @endif

  let scanner = new Instascan.Scanner({ video: document.getElementById('reader') });
      scanner.addListener('scan', function (no_gangguan) {
          
                Swal.fire({
                    title: "VALIDASI BARCODE",
                    text: "Tunggu Sebentar, Proses Validasi Barcode.",
                    timer: 4000,
                    onOpen: function() {
                        Swal.showLoading()
                    }
                }).then(function(result) {
                
                jQuery.ajax({
                    url: '/teknisi/cari_gangguan/' + no_gangguan,
                    type: "GET",
                    data: {
                        no_gangguan: no_gangguan
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1)
                        {
                            console.log(response.data);
                            if(response.data.data.kode_area != '{{Auth::user()->kode_area}}')
                            {
                                Swal.fire({
                                    position: "bottom-right",
                                    icon: "error",
                                    title: "WO Ini Khusus Untuk Area " + response.data.data.kode_area,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    timer: 3500
                                });
                            }
                            else
                            {
                                $('.NoGangguanValue').val(response.data.data.no_gangguan)
                                $('.IDPelangganValue').val(response.data.data.id_pelanggan)
                                $('.NamaPelangganValue').val(response.data.data.nama_pelanggan)
                                $('.AlamatPelangganValue').val(response.data.data.alamat)
                                $('.TitikAPValue').val(response.data.data.titik_ap)
                                $('.TitikOntValue').val(response.data.data.titik_ont)
                                $('.SNONTValue').val(response.data.data.sn_ont)
                                $('.SNAPValue').val(response.data.data.sn_ap)
                                $('.TitikLokasiValue').text(response.data.data.kordinat_pelanggan)

                                $('.GroupAreaValue').val(response.data.data.kode_area)
                                $('.TipeGangguanValue').val(response.data.gangguan.deskripsi)
                                        
                                $('#detail_gangguan').modal('show');
                                sessionStorage.setItem('kordinat_pelanggan', response.data.data.kordinat_pelanggan )
                                sessionStorage.setItem('no_gangguan', response.data.data.no_gangguan )
                                sessionStorage.setItem('kode_gangguan', response.data.data.kode_gangguan )
                            }
                            if(response.data.data.status == 0)
                            {
                                $('.SudahDiKerjakan').show('fast');
                                $('.BtnRute').hide('fast');
                                Swal.fire({
                                    position: "bottom-right",
                                    icon: "error",
                                    title: "WO Ini Sudah Selesai Dikerjakan",
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    timer: 2000
                                });
                            }
                            if(response.data.data.status == 1)
                            {
                                $('.BtnRute').hide('fast');
                                $('.BtnSelesai').show('fast');
                            }
                        }
                    }
                });
            });
        });

        $('.BtnSelesai').on('click', function(){
            var kode_gangguan = sessionStorage.getItem('kode_gangguan');
            var no_gangguan = sessionStorage.getItem('no_gangguan');
            $('.NoGangguanClose').val(no_gangguan);
            $('.BtnClose').hide('fast')
            $('.BtnSelesai').hide('fast')

               jQuery.ajax({
                    url: '/teknisi/cari_penanganan/' + kode_gangguan,
                    type: "GET",
                    data: {
                        kode_gangguan: kode_gangguan
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1)
                        {
                            $('#detail_gangguan').modal('hide');
                            $('#selesai_dikerjakan').modal('show')

                            $('.PenangananValue').html("")
                            
                            jQuery.each(response.data, function(index, value) {
                            $('.PenangananValue').append('<option value="'+value.kode_penanganan+'" selected>'+value.penanganan+'</option>')
                            });
                        }
                    },
                    error: function(response)
                    {
                        alert('Internal Server Error, Coba Lagi..')
                    }
               });
        });

        $('#close_gangguan').submit(function(){
            $('.BtnSave').hide();
        });

        function ArahkanRute()
        {
            var kordinat = sessionStorage.getItem('kordinat_pelanggan')
            window.open(kordinat);

            var no_gangguan = sessionStorage.getItem('no_gangguan');
            location.href = '/teknisi/ubah_status/' + no_gangguan;

            return back();
        }

      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

    </script>

@endpush
