@extends('layouts.base')

@push('styles')
    <link rel="stylesheet" href="{{ url('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                        <span class="nav-icon"><i class="fas fa-clock"></i></span>
                                        <span class="nav-text">Belum Di Kerjakan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#proses">
                                        <span class="nav-icon"><i class="fas fa-clipboard"></i></span>
                                        <span class="nav-text">Proses Di Kerjakan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                        <span class="nav-icon"><i class="fas fa-check"></i></span>
                                        <span class="nav-text">Selesai Di Kerjakan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>No Gangguan</th>
                                                        <th>ID Pelanggan</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Alamat</th>
                                                        <th>Area Gangguan</th>
                                                        <th>Qr Code</th>
                                                        <th>Status</th>
                                                        <th>Tools</th>
                                                    </tr>
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->where('status', 2) as $list)
                                                <tr class="text-center">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><a href="javascript:void(0)" onclick="detail_tiket('{{$list->no_gangguan}}')"> {{$list->no_gangguan}}</a></td>
                                                    <td>{{$list->id_pelanggan}}</td>
                                                    <td>{{$list->nama_pelanggan}}</td>
                                                    <td>{{$list->alamat}}</td>
                                                    <td>{{$list->kode_area}}</td>
                                                    <td><img src="data:image/png;base64,{{DNS2D::getBarcodePNG($list->barcode, 'QRCODE')}}" alt="barcode" /></td>
                                                    <td><span class="badge badge-warning text-white"><i class="fas fa-clock text-white mr-2"> </i> Belum Di Kerjakan</span></td>
                                                    <td>
                                                        <a href="{{url('helpdesk/hapus_tiket/' . $list->no_gangguan)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>No Gangguan</th>
                                                        <th>ID Pelanggan</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Alamat</th>
                                                        <th>Area Gangguan</th>
                                                        <th>Qr Code</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->where('status', 1) as $list)
                                                <tr class="text-center">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><a href="javascript:void(0)" onclick="detail_tiket('{{$list->no_gangguan}}')"> {{$list->no_gangguan}}</a></td>
                                                    <td>{{$list->id_pelanggan}}</td>
                                                    <td>{{$list->nama_pelanggan}}</td>
                                                    <td>{{$list->alamat}}</td>
                                                    <td>{{$list->kode_area}}</td>
                                                    <td><img src="data:image/png;base64,{{DNS2D::getBarcodePNG($list->barcode, 'QRCODE')}}" alt="barcode" /></td>
                                                    <td><span class="badge badge-dark text-white"><i class="fas fa-clock text-white mr-2"> </i> Proses Di Kerjakan</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>No Gangguan</th>
                                                        <th>ID Pelanggan</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Alamat</th>
                                                        <th>Area Gangguan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->where('status', 0) as $val)
                                                <tr class="text-center">
                                                     <td>{{$loop->iteration}}</td>
                                                    <td><a href="javascript:void(0)" onclick="detail_tiket('{{$val->no_gangguan}}')"> {{$val->no_gangguan}}</a></td>
                                                    <td>{{$val->id_pelanggan}}</td>
                                                    <td>{{$val->nama_pelanggan}}</td>
                                                    <td>{{$val->alamat}}</td>
                                                    <td>{{$val->kode_area}}</td>
                                                    <td><span class="badge badge-success"><i class="fas fa-check text-white"> </i> Selesai Di Kerjakan</span></td>
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

      <div class="modal fade" id="detail_tiket" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tiket <b class="DetailTiketValue"></b></h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('helpdesk/update_tiket')}}" id="update_tiket" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">No. Gangguan</label>
                                <input type="text" name="no_gangguan" id="" class="form-control NoGangguanValue" placeholder="" autocomplete="off" readonly required value="" />
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" id="" class="form-control NamaPelangganValue" placeholder="Masukan Nama Pelanggan" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="">Titik Access Point</label>
                                <input type="text" name="titik_ap" id="" class="form-control TitikAPValue" placeholder="Masukan Titik Access Point" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="">SN AP</label>
                                <input type="text" name="sn_ap" id="" class="form-control SNAPValue" placeholder="Masukan Serial Number AP" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">ID Pelanggan</label>
                                <input type="text" name="id_pelanggan" id="" class="form-control IdPelangganValue" placeholder="Masukan ID Pelanggan" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pelanggan</label>
                                <input type="text" name="alamat" id="" class="form-control AlamatPelangganValue" placeholder="Masukan Alamat Pelanggan" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="">Titik ONT</label>
                                <input type="text" name="titik_ont" id="" class="form-control TitikONTValue" placeholder="Masukan Alamat Pelanggan" autocomplete="off" required />
                            </div>
                                <div class="form-group">
                                <label for="">SN ONT</label>
                                <input type="text" name="sn_ont" id="" class="form-control SNONTValue" placeholder="Masukan Serial Number ONT" autocomplete="off" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="">Tipe Gangguan</label>
                            <select class="form-control TipeGangguanValue" name="kode_gangguan" id="" required>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="">Group Area</label>
                            <select class="form-control KodeAreaValue" name="kode_area" id="" required>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Titik Lokasi Pelanggan</label>
                                <textarea class="form-control LokasiPelangganValue" name="kordinat_pelanggan" id="TitikLokasi" rows="3" placeholder="Masukan Lokasi Pelanggan" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary BtnUpdate"><i class="fas fa-save mr-2"></i> Update</button>
                </div>
              </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

<script src="{{ url('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>
    $('.table').DataTable();

    $('#update_tiket').submit(function()
    {
        $('.BtnUpdate').hide('slow');
    });

    function detail_tiket(no_gangguan)
    {
          jQuery.ajax({
                url: '/helpdesk/detail_tiket/' + no_gangguan,
                type: "GET",
                data: {
                    no_gangguan: no_gangguan
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1)
                    {
                        if(response.data[0].status == 0 || response.data[0].status == 1 )
                        {
                            $('.BtnUpdate').hide();
                        }
                        else
                        {
                            $('.BtnUpdate').show();
                        }
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
