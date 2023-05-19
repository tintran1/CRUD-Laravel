<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="my-6 text-center">Information</h1>
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <label class="btn btn-outline-primary w-100 " for="img">Chose Image</label>
                        <input class="d-none  form-control-file" type="file" name="img[]" id="img" multiple>
                        <div class="gallery-img"></div>
                    </div>
                    <div class="form-group">
                        <label class="btn btn-outline-primary w-100" for="video">Chose Video</label>
                        <input class="d-none  form-control-file" type="file" name="video[]" id="video" multiple>
                        <div class="gallery-video"></div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-primary " id="submit">Submit</button>

                    </div>
                </form>
                <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Tim kiem">
                <div class="table-data">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Image</th>
                                <th scope="col">Video</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $key=>$users)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$users->Name}}</td>
                                <td>{{$users->Email}}</td>
                                <td>
                                    @if(!empty($users->Image))
                                    @foreach((array)$users->Image as $images)
                                    @php
                                    $array = explode(',', $images);
                                    @endphp
                                    @foreach($array as $arrays)
                                    <img src="{{'images/'.$arrays}}" style="height: 100px; width: 150px;">
                                    @endforeach
                                    @endforeach
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($users->Video))
                                    @foreach((array)$users->Video as $videos)
                                    @php
                                    $array = explode(',', $videos);
                                    @endphp
                                    @foreach($array as $arrays)
                                    <video controls src="{{'videos/'.$arrays}}" style="height: 100px; width: 150px;"></video>
                                    @endforeach
                                    @endforeach
                                    @else
                                    @endif
                                </td>
                                <td class="d-flex border-0">
                                    <button class='delete btn btn-danger' id='delete"{{$users->id }} "'>Delete</button>
                                    <button class='edit btn btn-warning' id='edit"{{$users->id }} "' data-toggle="modal" data-target="#exampleModal">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $user->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('adddata')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'col-3 w-50 h-50').appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i])
                    }
                }
            }

            $('#img').on('change', function() {
                imagesPreview(this, 'div.gallery-img');
            })

            $('#img_edit').on('change', function() {
                imagesPreview(this, 'div.gallery-img-edit');
            })

        });

        $(function() {
            var videosPreview = function(input, placeToInsertvideoPreview) {
                if (input.files) {
                    var filesAmount = input.files.length
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<video></video>')).attr('src', event.target.result).attr('class', 'col-3 w-50 h-50').attr('controls', '').appendTo(placeToInsertvideoPreview);
                        }
                        reader.readAsDataURL(input.files[i])
                    }
                }
            }

            $('#video').on('change', function() {
                videosPreview(this, 'div.gallery-video')
            })

            $('#video_edit').on('change', function() {
                videosPreview(this, 'div.gallery-video-edit')
            })
        })
    </script>
    <script type="text/javascript" src="{{ asset('/js/pagination.js') }}"></script>
</body>

</html>