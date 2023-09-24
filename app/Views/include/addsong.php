<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Upload Music</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/save" method="post" class="form-border">
                    <div class="form-group">
                   
                       
                       <input type="file" class="form-control" name="file" id="file" onchange="updateFilePath()">
                   </div>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= isset($pro['id']) ? $pro['id'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label>title</label>
                        <input type="text" class="form-control" name="title" placeholder="title" value="<?= isset($pro['title']) ? $pro['title'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label>artist</label>
                        <input type="text" class="form-control" name="artist" placeholder="artist" value="<?= isset($pro['artist']) ? $pro['artist'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label>file_path</label>
                        <input type="text" class="form-control" name="file_path" id="display_file_path" placeholder="file_path" value="<?= isset($pro['file_path']) ? $pro['file_path'] : '' ?>">
                        <input type="hidden" name="actual_file_path" id="actual_file_path">
                    </div>
                    <div class="form-group">
                        <label>duration</label>
                        <input type="number" class="form-control" name="duration" placeholder="duration" value="<?= isset($pro['duration']) ? $pro['duration'] : '' ?>">
                    </div>
                            <form action="/save" method="post" class="form-border" onsubmit="updateAudioSource()">
             <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save Music">
            </div>
        </form>
                </form>
                <br>
                <form action="upload_music" method="post" enctype="multipart/form-data">
                </form>
            </div>
            
        </div>
    </div>
</div> 