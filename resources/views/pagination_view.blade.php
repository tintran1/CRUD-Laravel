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
                                    <img src="/images/avatar.png" style="height: 100px; width: 150px;">
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($usesr->Video))
                                    @foreach((array)$users->Video as $videos)
                                    @php
                                    $array = explode(',', $videos);
                                    @endphp
                                    @foreach($array as $arrays)
                                    <video controls src="{{'videos/'.$arrays}}" style="height: 100px; width: 150px;"></video>
                                    @endforeach
                                    @endforeach
                                    @else
                                    <video controls src="/videos/avatar.png" style="height: 100px; width: 150px;"></video>
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
                    