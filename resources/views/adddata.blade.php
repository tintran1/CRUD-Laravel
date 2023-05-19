<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT INFORMATION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <input type="hidden" id="id_edit" />
                    <div class="form-group form-md-6 ">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name_edit" class="form-control" required>
                    </div>
                    <div class="form-group form-md-6 ">
                        <label for="email">Email </label>
                        <input type="email" name="email" id="email_edit" class="form-control" required>
                    </div>
                    <div class="form-group form-md-6">
                        <label for="password">
                            Password
                        </label>
                        <input type="password" name="password" id="password_edit" class="form-control" required>
                    </div>
                    <div class="form-group form-md-6">
                        <label class="btn btn-outline-primary w-100" for="img_edit">Chose Image</label>
                        <input class="d-none" type="file" name='img_edit[]' id="img_edit" class=" form-control-file" multiple>
                        <div class="gallery-img-edit"></div>
                    </div>
                    <div class="form-group form-md-6">
                        <label class="btn btn-outline-primary w-100" for="video_edit">Chose Video</label>
                        <input class="d-none" type="file" name='video_edit[]' id="video_edit" class=" form-control-file" multiple>
                        <div class="gallery-video-edit"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="edit_submit" data-dismiss="modal" class="btn btn-primary update">Save changes</button>
            </div>
        </div>
    </div>
</div>