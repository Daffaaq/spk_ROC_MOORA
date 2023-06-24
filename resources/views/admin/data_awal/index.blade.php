@extends('layouts.admin')

@section('content')

@section('pages', 'data')
@section('title', 'alternatives')

@push('scripts')
@endpush



<div class="container">
    {{-- <div class="card rounded card-primary">
        <div class="card-header">
            <h4>Add</h4>
            <div class="card-header-action">
                <a data-collapse="#collapseTambah" class="btn btn-icon btn-primary" href="#"><i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="collapse" id="collapseTambah">
            <div class="card-body">
                <form action="{{ route('alternative.create') }}" method="POST" autocomplete="off" class="form">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <h6 class="label-control">Nama Alternatif</h6>
                                <input class="form-control" type="text" name="nama" placeholder="e.g. Tembalang..."
                                    required>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <h6 class="label-control">Kode</h6>
                                <input class="form-control" type="text" name="kode" placeholder="e.g. A9" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <h6 class="label-control">Vegetasi area embung</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Vegetasi area genangan embung')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <h6 class="label-control">Volume material timbunan</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Volume material timbunan')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <h6 class="label-control">Luas daerah dibebaskan</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Luas daerah yang akan dibebaskan')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <h6 class="label-control">Volume tampungan efektif</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Volume tampungan efektif')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <h6 class="label-control">Lama operasi</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Lama operasi')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <h6 class="label-control">Harga air/m3</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Harga air/m3')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <h6 class="label-control">Akses jalan menuju site bendungan</h6>
                            <select class="form-control select2" style="width: 100%" name="criteria[]"
                                data-minimum-results-for-search="-1" required>
                                @foreach ($classifications as $classification)
                                @if ($classification->nama == 'Akses jalan menuju site bendungan')
                                <option value={{ $classification->value }}>{{ $classification->classification }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success btn-md" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="row">

        <div class="col-12">

            <div class="card rounded card-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover table-md"
                            id="DataTables">
                            <div class="show-import" style="display: block">
                                <div class="custom-file">
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <label class="custom-file-label" for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input"
                                            name="import_file">
                                        <br /> <br />
                                        <div class="footer text-right">
                                            <button class="btn btn-primary">Import File</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Alternatives</th>
                                    <th>Code</th>
                                    @foreach ($criterias as $criteria)
                                        <th>{{ $criteria->nama }}</th>
                                    @endforeach
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($alternatives as $alternative)
                                    <tr align="center">
                                        <td>{{ $alternative->id }}</td>
                                        <td>{{ $alternative->nama }}</td>
                                        <td>{{ $alternative->kode }}</td>
                                        @foreach ($values as $value)
                                            @if ($value->alternative_id == $alternative->id)
                                                <td>{{ $value->value }}</td>
                                            @endif
                                        @endforeach
                                        {{-- <td>
                                        <a class="btn btn-icon btn-info"
                                            href="{{ route('alternative.edit', $data->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        <button class="btn btn-icon btn-danger" data-toggle="modal"
                                            data-target="#modaldelete{{ $data->id }}"><i
                                                class="fas fa-trash-alt"></i></button>
                                        <div class="modal fade" id="modaldelete{{ $data->id }}" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Alternative</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6 style="font-weight:normal">Do you really want to delete
                                                            alternative {{ $data->nama }}?</h6>
                                                        <div class="text-secondary" style="align-content: flex-start">
                                                            Last
                                                            updated:
                                                            {{ $data->updated_at->format('d F Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <div style="display:none">
                                                            <input type="text" name="id" value="{{ $data->id }}">
                                                        </div>
                                                        <button class="btn btn-md btn-default"
                                                            data-dismiss="modal">No</button>
                                                        <form action="{{ route('alternative.delete', $data->id) }}"
                                                            method="POST" class="form">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger" type="submit">Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}
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

@endsection
