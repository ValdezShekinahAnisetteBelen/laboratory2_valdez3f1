<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
                <?php foreach ($playlist_model as $mus): ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <a href="/playlist/<?= $mus['id'] ?>?playlistID=<?= $mus['id'] ?>"><?= $mus['name'] ?></a>
                        </div>
                    </div>
                <?php endforeach;?>
                <br>
            </div>
            <div class="modal-footer">
               
                <a href="#" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New +</a>
            </div>
        </div>
    </div>
</div>