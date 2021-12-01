@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-toolbar">
                        <a href="#add" data-toggle="modal" class="btn btn-sm btn-info mb-4 mt-3"><i class="fas fa-plus"></i> Tambah Dept</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama DEPT</th>
                                        <th>Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dept as $list)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>
                                            <a href="{{url('super_admin/hapus_dept/' . $list->id)}}" class="btn btn-sm btn-primary" style="border-radius: 18px;"><i class="fas fa-trash"></i> Hapus</a>
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
                                                  FORM ADD DEPARTMENTS
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-custom gutter-b">
                                        <form action="{{url('super_admin/add_dept')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                      <label for="">Nama Dept</label>
                                                      <input type="text" name="name" id="" class="form-control" placeholder="Masukan Nama" required aria-describedby="helpId">
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