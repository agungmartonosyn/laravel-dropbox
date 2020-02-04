@extends('backend.layouts.master')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dropbox</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Dropbox</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">

                <div class="card-header">
                    <div class="badge badge-primary">Upload new file</div>
                </div>

                <div class="card-body">
                    <form class="form-inline" action="{{ route('dropbox.store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file[]" multiple="true" required>
                                <label class="custom-file-label">Choose file...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="badge badge-primary">Data Dropbox</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dropboxs">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th>Gambar</th>
                                            <th class="text-center">Tipe</th>
                                            <th class="text-center">Ukuran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dropboxs as $dropbox)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <img alt="image" src="{!!url('dropbox/'.$dropbox->file_title)!!}"
                                                    class="img-fluid" data-toggle="tooltip"
                                                    title="{!!url('dropbox/'.$dropbox->file_title)!!}">
                                            </td>
                                            <td class="text-center">{!! $dropbox->file_type !!}</td>
                                            <td class="text-center">{!! number_format($dropbox->file_size/1024,1) !!} Kb
                                            </td>
                                            <td class="text-center">
                                                <a href="{!!url('dropbox/'.$dropbox->file_title .'/download')!!}"
                                                    class="btn btn-primary">
                                                    Download
                                                </a>
                                                <a href="{!!url('dropbox/'.$dropbox->id)!!}"
                                                    class="btn btn-danger">
                                                    Delete
                                                </a>
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
    </section>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dropboxs').DataTable();
    })

</script>
@endpush
