<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Upload Berkas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    @if(session('success'))
    <div class="alert alert-success">
        <center>{{session('success')}}</center>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mx-auto">
                <h1 class="mt-5 text-monospace">
                    <center>Aplikasi Upload Berkas</center>
                </h1>
                <div class="card my-5">
                    <div class="card-body">
                        {{-- <form method="post" action="{{route('image.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Pilih Berkas Gambar</label>
                                <input name="gambar" type="file"
                                    class="form-control @error('berkas') is-invalid @enderror" required autofocus>
                                @error('berkas')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <button class="mt-3 btn btn-primary btn-block " type="submit">Upload</button>
                        </form> --}}

                        <form action="{{route('image.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="">File(s)</label>
                            <input type="file" name="file[]" id="" multiple="true">
                            <button type="submit">Upload</button>
                        </form>
                    </div>
                </div>
                <div class="card card-signin my-5">
                    <div class="card-body bg-light">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>mime/Type</th>
                                    <th>File Size</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($images as $file)
                                    <tr>
                                        <td>
                                            <img src="{!!url('drop/'.$file->file_title)!!}" class="img-fluid" alt="Responsive image">
                                            <a href="{!!url('drop/'.$file->file_title)!!}">
                                            {!! $file->file_title !!}
                                            </a>
                                        </td>
                                        <td>
                                            {!! $file->file_type !!}
                                        </td>
                                        <td>
                                            {!! number_format($file->file_size/1024,1) !!} Kb
                                        </td>
                                        <td>
                                            <a href="{!!url('drop/'.$file->file_title .'/download')!!}">
                                                Download
                                            </a>
                                            <a href="{!!url('drop/'.$file->id.'/destroy')!!}">
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
</body>

</html>
