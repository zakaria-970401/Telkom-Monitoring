@extends('layouts.base')

@push('styles')
    <link rel="stylesheet" href="{{ url('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-toolbar">
                            <div class="card-title">
                                <h3 class="card-label">MENU CREATE TIKET</h3>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-title">
                                <a href="{{url('helpdesk/master_helpdesk')}}" class="btn btn-md btn-dark"><i class="fas fa-database mr-2"></i> Master Helpdesk</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{url('helpdesk/create_tiket')}}" method="post" id="post_tiket" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <label for="">PILIH PELANGGAN</label>
                                      <select class="form-control select2" id="" required onchange="PilihPelanggan(this.value)">
                                          <option value="" disabled selected>SILAHKAN PILIH</option>
                                          @foreach ($pelanggan as $item)
                                            <option value="{{$item->id}}">{{$item->nama . '-' .$item->id_pelanggan}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="Hasil hide">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">No. Gangguan</label>
                                        <input type="text" name="no_gangguan" id="" class="form-control NoGangguanValue" placeholder="" autocomplete="off" readonly required value="{{'GTLKM0000' . $no_gangguan}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" id="" class="form-control NamaPelangganValue" placeholder="Masukan Nama Pelanggan" autocomplete="off" readonly required />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Titik Access Point</label>
                                        <input type="text" name="titik_ap" id="" class="form-control TitikAPValue" placeholder="Masukan Titik Access Point" autocomplete="off" readonly required />
                                    </div>
                                    <div class="form-group">
                                        <label for="">SN AP</label>
                                        <input type="text" name="sn_ap" id="" class="form-control SNAPValue" placeholder="Masukan Serial Number AP" autocomplete="off" readonly required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">ID Pelanggan</label>
                                        <input type="text" name="id_pelanggan" id="" class="form-control IdPelangganValue" placeholder="Masukan ID Pelanggan" readonly autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat Pelanggan</label>
                                        <input type="text" name="alamat" id="" class="form-control AlamatPelangganValue" placeholder="Masukan Alamat Pelanggan" readonly autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Titik ONT</label>
                                        <input type="text" name="titik_ont" id="" class="form-control TitikONTValue" placeholder="Masukan Alamat Pelanggan" readonly autocomplete="off" required />
                                    </div>
                                      <div class="form-group">
                                        <label for="">SN ONT</label>
                                        <input type="text" name="sn_ont" id="" class="form-control SNONTValue" placeholder="Masukan Serial Number ONT" readonly autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Titik Lokasi Pelanggan</label>
                                        <textarea class="form-control TitikLokasiValue" name="kordinat_pelanggan" id="TitikLokasi" rows="3" placeholder="Masukan Lokasi Pelanggan" required></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="">Group Area</label>
                                    <select class="form-control" name="kode_area" id="" required>
                                        <option value="" selected disabled>SILAHKAN PILIH</option>
                                        <option value="JATINEGARA">JATINEGARA</option>
                                        <option value="RAWAMANGUN">RAWA MANGUN</option>
                                        <option value="PASARREBO">PASAR REBO</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="">Tipe Gangguan</label>
                                    <select class="form-control KeluhanSelect" name="kode_gangguan" id="" required>
                                        <option value="" selected disabled>SILAHKAN PILIH</option>
                                        @foreach ($data as $item)
                                        <option value="{{$item->kode_gangguan}}">{{$item->deskripsi}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <input type="hidden" name="barcode" class="form-control Hasilqrcode" />
    
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-lg btn-primary BtnSave" style="display: none;"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
@endsection

@push('scripts')

<script src="{{ url('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ url('/assets/js/jquery.qrcode.min.js') }}"></script>


<script>
    $('.table').DataTable();
    $('.select2').select2();

    function PilihPelanggan(id)
    {
        $('.BtnSave').show('fast');
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
                        $('.Hasil').show('show')
                        $('.NamaPelangganValue').val(response.data.nama)
                        $('.TitikAPValue').val(response.data.titik_ap)
                        $('.TitikONTValue').val(response.data.titik_ont)
                        $('.SNAPValue').val(response.data.sn_ap)
                        $('.IdPelangganValue').val(response.data.id_pelanggan)
                        $('.AlamatPelangganValue').val(response.data.alamat)
                        $('.SNONTValue').val(response.data.sn_ont)
                        $('.TitikLokasiValue').val(response.data.lokasi)
                    }
                }
            });
    }

    $('#post_tiket').submit(function(){
            $('.Hasilqrcode').html('')
            $('.Hasilqrcode').qrcode({
                width: 250,
                height: 250,
                text: $('.Hasilqrcode').val()
            });

        $('.BtnSave').attr('disabled', 'true');
        $('.BtnSave').addClass('spinner spinner-left pl-15')
    });

    
</script>

@endpush
