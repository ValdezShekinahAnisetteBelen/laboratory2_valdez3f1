<div class="modal fade" id="memod" tabindex="-1" aria-labelledby="memodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Modal title and close button -->
            </div>
            <div class="modal-body">
                <form action="/saveEdit" method="post">
                    <!-- Hidden input to store the selected music's ID -->
                    <input type="text" id="musicID" name="musicID" value="">

                    <!-- Dropdown list of playlists -->
                    <select name="playlist" class="form-select">
                        <?php foreach ($playlist_model as $playlist): ?>
                            <option value="<?= $playlist['id'] ?>">
                                <?= $playlist['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Save button to submit the form -->
                    <input type="submit" class="btn btn-success" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>
