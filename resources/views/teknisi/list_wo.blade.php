@extends('layouts.base')


    @push('styles')
        <style type="text/css">
            .hide {
                display: none;
            }

            .message {
                transition-duration: 0.7ms;
            }

        </style>
    @endpush

@section('content')

    <div class="container-fluid">
        <div class="main-body">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card card-custom gutter-b">
                        <div class="card-header card-header-tabs-line">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#proses">
                                            <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                                            <span class="nav-text">Proses</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#selesai">
                                            <span class="nav-icon"><i class="fas fa-check"></i></span>
                                            <span class="nav-text">Selesai</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-toolbar">
                                <h3>
                                    <span class="badge badge-info">History Pengerjaan {{Auth::user()->name}}</span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="proses" role="tabpanel" aria-labelledby="proses">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="bg-primary text-white">
                                                        <tr class="text-white text-center">
                                                            <th class="text-white">No.</th>
                                                            <th class="text-white">#</th>
                                                            <th class="text-white">Nama Teknisi</th>
                                                            <th class="text-white">No. Gangguan</th>
                                                            <th class="text-white">Nama Pelanggan</th>
                                                            <th class="text-white">Alamat Pelanggan</th>
                                                            <th class="text-white">Gangguan</th>
                                                            <th class="text-white">Tanggal WO</th>
                                                            <th class="text-white">Jam Wo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data->where('status', 1) as $list)
                                                        <tr class="text-dark text-center">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td >
                                                                 <a href="javascript:void(0)" onclick="detail_tiket('{{$list->no_gangguan}}')"
                                                                    class="btn btn-dark btn-icon ml-2" style="border-radius: 15px" data-toggle="tooltip" data-placement="bottom" title="Lihat"><i
                                                                        class="fas fa-eye" style="border-radius: 15px"></i>
                                                                </a>
                                                            <td>{{$list->no_gangguan}}</td>
                                                            <td>{{$list->nama_pelanggan}}</td>
                                                            <td>{{$list->alamat}}</td>
                                                            <td>{{$list->alamat}}</td>
                                                            <td>{{Carbon\carbon::parse($list->tgl_wo)->format('d-M-Y')}}</td>
                                                            <td>{{$list->jam_wo}} WIB</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai">
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="bg-primary text-white">
                                                        <tr class="text-white text-center">
                                                            <th class="text-white">No.</th>
                                                            <th class="text-white">#</th>
                                                            <th class="text-white">Nama Teknisi</th>
                                                            <th class="text-white">No. Gangguan</th>
                                                            <th class="text-white">Nama Pelanggan</th>
                                                            <th class="text-white">Alamat Pelanggan</th>
                                                            <th class="text-white">Gangguan</th>
                                                            <th class="text-white">Penanganan</th>
                                                            <th class="text-white">Tanggal Pengerjaan</th>
                                                            <th class="text-white">Jam Pengerjaan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data->where('status', 0) as $item)
                                                        <tr class="text-dark text-center">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td >
                                                                 <a href="javascript:void(0)" onclick="detail_tiket('{{$item->no_gangguan}}')"
                                                                    class="btn btn-dark btn-icon ml-2" style="border-radius: 15px" data-toggle="tooltip" data-placement="bottom" title="Lihat"><i
                                                                        class="fas fa-eye" style="border-radius: 15px"></i>
                                                                </a>
                                                            <td>{{$item->nama_teknisi}}</td>
                                                            <td>{{$item->no_gangguan}}</td>
                                                            <td>{{$item->nama_pelanggan}}</td>
                                                            <td>{{$item->alamat}}</td>
                                                            <td>{{$item->deskripsi}}</td>
                                                            <td>{{$item->penanganan}}</td>
                                                            <td>{{Carbon\carbon::parse($item->tgl_penanganan)->format('d-M-Y')}}</td>
                                                            <td>{{$item->jam_penanganan}} WIB</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="{{ url('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">
        $('.table').DataTable();

    function detail_tiket(no_gangguan)
    {
          jQuery.ajax({
                url: '/teknisi/detail_tiket/' + no_gangguan,
                type: "GET",
                data: {
                    no_gangguan: no_gangguan
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1)
                    {
                        console.log(response.data);
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
    </script>

@endpush
