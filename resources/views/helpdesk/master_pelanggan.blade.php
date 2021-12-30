@extends('layouts.base')

@push('styles')
    <link rel="stylesheet" href="{{ url('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{url('helpdesk/import_pelanggan')}}" method="post" enctype="multipart/form-data" id="import_pelanggan">
                                @csrf
                                <div class="form-group">
                                  <label for="">Pilih Excel</label>
                                  <input type="file"
                                    class="form-control Excel" name="file" id="" aria-describedby="helpId" required placeholder="">
                                  <small id="helpId" class="form-text text-danger">*xls,xlsx</small>
                                  <div class="float-right">
                                      <button type="submit" class="btn btn-md btn-dark BtnUpload hide"><i class="fas fa-upload"></i> Upload</button>
                                  </div>
                                </form>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="" class="btn btn-lg text-white mt-4 " style="border-radius: 15px; background-color: green;"><i class="fas fa-file-excel mr-2 text-white"></i> Download Template Excel</a>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tools</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Titik AP</th>
                                            <th>Titik ONT</th>
                                            <th>SN AP</th>
                                            <th>SN ONT</th>
                                            <th>Kordinat Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="HapusPelanggan('{{$item->id}}')" class="btn mt-2 btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                <a href="javascript:void(0)" onclick="DetailPelanggan('{{$item->id}}')" class="btn mt-2 btn-sm btn-dark"><i class="fas fa-edit"></i></a>
                                            </td>
                                            <td>{{$item->id_pelanggan}}</td>
                                            <td>{{$item->nama}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>{{$item->titik_ap}}</td>
                                            <td>{{$item->titik_ont}}</td>
                                            <td>{{$item->sn_ap}}</td>
                                            <td>{{$item->sn_ont}}</td>
                                            <td><a href="{{$item->lokasi}}">{{$item->lokasi}}</a></td>
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

      <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{url('helpdesk/update_pelanggan')}}" id="update_pelanggan" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" id="" class="form-control NamaPelangganValue" placeholder="Masukan Nama Pelanggan" autocomplete="off" required />
                                <input type="text" name="id" id="" class="form-control IDValue" placeholder="Masukan Nama Pelanggan" autocomplete="off" hidden />
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

    $('.Excel').on('change', function(){
        $('.BtnUpload').show('fast');
    });

    $('#update_pelanggan').submit(function()
    {
        $('.BtnUpdate').hide('slow');
    });

    $('#import_pelanggan').submit(function()
    {
        $('.BtnUpload').hide('slow');
    });

    function HapusPelanggan(id)
    {
        location.href = 'helpdesk/hapus_pelanggan/' + id;
    }

    function DetailPelanggan(id)
    {
          jQuery.ajax({
                url: '/helpdesk/detail_pelanggan/' + id,
                type: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1)
                    {
                        $('#detail').modal('show')
                        $('.IDValue').val(id)
                        $('.NamaPelangganValue').val(response.data.nama)
                        $('.TitikAPValue').val(response.data.titik_ap)
                        $('.TitikONTValue').val(response.data.titik_ont)
                        $('.SNAPValue').val(response.data.sn_ap)
                        $('.IdPelangganValue').val(response.data.id_pelanggan)
                        $('.AlamatPelangganValue').val(response.data.alamat)
                        $('.SNONTValue').val(response.data.sn_ont)
                        $('.LokasiPelangganValue').val(response.data.lokasi)
                    }
                }
            });
    }
 
</script>

@endpush
