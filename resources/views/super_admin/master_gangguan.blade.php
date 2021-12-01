@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-toolbar">
                        <a href="#add" data-toggle="modal" class="btn btn-sm btn-info mb-4 mt-3"><i class="fas fa-plus"></i> Tambah Data Gangguan</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table tabl-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Gangguan</th>
                                        <th>Penanganan</th>
                                        <th>Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $list)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$list->deskripsi}}</td>
                                        <td>
                                            <ul>
                                                @foreach($sub->where('kode_gangguan', $list->kode_gangguan) as $val)
                                                <li  class="badge badge-info">
                                                    {{$loop->iteration}}. {{$val->penanganan}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{url('super_admin/hapus_gangguan/' . $list->kode_gangguan)}}" class="btn btn-sm btn-primary" style="border-radius: 18px;"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
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

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-custom">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-8">
                                            <div class="alert alert-custom alert-default" role="alert">
                                            <div class="alert-text">
                                                  FORM ADD MASTER GANGGUAN
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-custom gutter-b">
                                        <form action="{{url('super_admin/add_gangguan')}}" method="post" enctype="multipart/form-data" id="post_master_gangguan">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label for="">Masukan Gangguan</label>
                                                      <input type="text" name="deskripsi" id="" class="form-control" placeholder="Masukan Gangguan" aria-describedby="helpId" oninput="this.value = this.value.toUpperCase()">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                  <div class="Append">
                                                     <div class="form-group">
                                                      <label for="">Masukan Penanganan Gangguan</label>
                                                      <input type="text" name="penanganan[]" id="" class="form-control" placeholder="Masukan Penganan Gangguan" required oninput="this.value = this.value.toUpperCase()" aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-dark BtnAdd"><i class="fas fa-plus"></i> Tambah</a>
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-sm btn-primary BtnSave"><i class="fas fa-save mr-2"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                  </form>
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


@endsection

@push('scripts')

    <script src="{{ url('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">
    $('.table').DataTable();

    $('.BtnAdd').on('click', function(){
        $('.Append').append('<div class="form-group">\
                            <label for="">Masukan Penanganan Gangguan</label>\
                            <input type="text" name="penanganan[]" id="" class="form-control" placeholder="Masukan Penganan Gangguan" required oninput="this.value = this.value.toUpperCase()" aria-describedby="helpId">\
                        </div>');
    });

    $('#post_master_gangguan').on('submit', function(){
        $('.BtnSave').hide('slow');
    });

    </script>
@endpush