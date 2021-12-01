@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-custom">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-8">
                                            <div class="alert alert-custom alert-default" role="alert">
                                            <div class="alert-text">
                                                  FORM ADD USER {{$data->nama_user}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-custom gutter-b">
                                        <form action="{{url('super_admin/update_user/' . $data->id )}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label for="">Nama</label>
                                                      <input type="text" name="name" id="" class="form-control" placeholder="Masukan Nama" value="{{$data->nama_user}}" required aria-describedby="helpId">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Username</label>
                                                      <input type="text" name="username" id="" class="form-control" placeholder="Masukan NIK" required aria-describedby="helpId" value="{{$data->username}}">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Email</label>
                                                      <input type="email" name="email" id="" class="form-control" placeholder="Masukan Email" value="{{$data->email}}" required aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                      <label for="">Departemen</label>
                                                      <select class="form-control" name="dept" id="">
                                                          <option value="{{$data->id_dept}}" selected>{{$data->dept_name}}</option>
                                                          <option value="" disabled>Silahkan Pilih</option>
                                                          @foreach ($dept as $list)
                                                          <option value="{{$list->id}}">{{$list->name}}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="">Permission</label>
                                                      <select class="form-control" name="auth_group_id" id="" required>
                                                          <option value="" selected >Silahkan Pilih</option>
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
                                                <a href="javascript:history.back()" class="btn btn-dark btn-md"><i class="fas fa-arrow-left"></i> Kembali</a>
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
        </div>
    </div>
</div>
</div>
</div>

@endsection

@push('scripts')

    <script type="text/javascript">

    </script>
@endpush