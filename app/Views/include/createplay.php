<div class="modal fade" id="createPlaylist" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Create Music</h5>
            </div>
            <div class="modal-body">
                <br>
                <form action="/saveCreate" method="post" class="form-border">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="playlist name" value="<?= isset($pro['name']) ? $pro['name'] : '' ?>">
                    </div>
                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>