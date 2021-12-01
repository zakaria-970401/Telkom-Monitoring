@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-toolbar">
                        <a href="#add" data-toggle="modal" class="btn btn-sm btn-info mb-4 mt-3"><i class="fas fa-plus"></i> Tambah User</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table tabl-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Dept</th>
                                        <th>Kode Area</th>
                                        <th>Auth Group</th>
                                        <th>Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $list)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$list->nama_user}}</td>
                                        <td>{{$list->username}}</td>
                                        <td>{{$list->nama_dept}}</td>
                                        <td>{{$list->nama_auth}}</td>
                                        <td>
                                            <a href="{{url('super_admin/edit_user/' . $list->id)}}" class="btn btn-sm btn-dark" style="border-radius: 18px;"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{url('super_admin/hapus_user/' . $list->id)}}" class="btn btn-sm btn-primary" style="border-radius: 18px;"><i class="fas fa-trash"></i> Hapus</a>
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
                                                  FORM ADD USER
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-custom gutter-b">
                                        <form action="{{url('super_admin/add_user')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label for="">Nama</label>
                                                      <input type="text" name="name" id="" class="form-control" placeholder="Masukan Nama" required aria-describedby="helpId">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Username</label>
                                                      <input type="text" name="username" id="" class="form-control" placeholder="Masukan NIK" required aria-describedby="helpId">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Email</label>
                                                      <input type="email" name="email" id="" class="form-control" placeholder="Masukan Email" required aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label for="">Departemen</label>
                                                      <select class="form-control" name="dept" id="">
                                                          <option value="" selected disabled>Silahkan Pilih</option>
                                                          @foreach ($dept as $list)
                                                          <option value="{{$list->id}}">{{$list->name}}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Permission</label>
                                                      <select class="form-control" name="auth_group_id" id="">
                                                          <option value="" selected disabled>Silahkan Pilih</option>
                                                          @foreach ($auth_group as $val)
                                                          <option value="{{$val->id}}">{{$val->name}}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Password</label>
                                                      <input type="password" name="password" id="" class="form-control" placeholder="Masukan Password" required aria-describedby="helpId">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                      <label for="">Kode Areaa</label>
                                                      <select class="form-control" name="kode_area" required id="">
                                                        <option value="" selected disabled></option>
                                                        <option value="-">-</option>
                                                        <option value="JATINEGARA">JATINEGARA</option>
                                                        <option value="RAWAMANGUN">RAWAMANGUN</option>
                                                        <option value="PASARREBO">PASARREBO</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save mr-2"></i> Simpan</button>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    </script>
@endpush