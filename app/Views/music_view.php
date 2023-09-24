<!DOCTYPE html>
<html lang="en">

<body>

<?php include 'include/header.php';
include 'include/manageplaylist.php'; 
include 'include/addsong.php'; 
include 'include/addtoplaylist.php';
include 'include/createplay.php';
?>



 


<!-- Search form -->
<form action="/search" method="get">
        <input type="search" name="search" placeholder="Search song">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <h1>Music Player</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        My Playlist
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
    Upload Music
</button>

    <!-- Audio Player -->
    <audio id="audio" controls autoplay></audio>

    <!-- Music Playlist -->
    <ul id="playlist">
    <?php foreach ($music_view as $index => $music): ?>
        <li class="playlist-item" data-src="<?= $music['file_path'] ?>">
            <a href="#" class="play-link" data-index="<?= $index ?>" style="text-decoration: none; color: black;">
                <span>Title: <?= $music['title'] ?> - Artist: <?= $music['artist'] ?></span>
            </a>

            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#memod" data-id="<?= $music['id'] ?>">
                <i class="fas fa-plus"></i>
            </button>

            <div class="ex-button">
                <a href="/delete/<?= $music['id'] ?>" class="fas fa-trash ex-icon"></a>
            </div>
        </li>

        <script>
            // Add an event listener to each button individually
            document.addEventListener('DOMContentLoaded', function () {
                const addButton = document.querySelector('button[data-bs-target="#memod"][data-id="<?= $music['id'] ?>"]');
                const musicIDInput = document.getElementById('musicID');

                addButton.addEventListener('click', function () {
                    const musicID = addButton.getAttribute('data-id'); // Get the value from data-id attribute
                    console.log('musicID:', musicID); // Check the value in the console
                    musicIDInput.value = musicID; // Set the value in the input field
                });
            });
        </script>
    <?php endforeach; ?>
</ul>

 
    <!-- Add any other HTML elements or styling as needed -->


  





    <script>
    function updateAudioSource() {
        const audio = document.getElementById('audio');
        const displayFilePathInput = document.getElementById('display_file_path');
        const actualFilePathInput = document.getElementById('actual_file_path');

        const filePath = actualFilePathInput.value;

       
        audio.src = filePath;
        audio.play();

        return true;
    }
</script>
    <script>
    function updateFilePath() {
        const fileInput = document.getElementById('file');
        const displayFilePathInput = document.getElementById('display_file_path');
        const actualFilePathInput = document.getElementById('actual_file_path');

        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            const filePath = selectedFile.name; 
            const name = "http://localhost/laboratory2_valdez3f1/";
            displayFilePathInput.value =  name.concat(filePath); 
            actualFilePathInput.value = filePath; 
        }
    }
</script>


<script>
    $(document).ready(function () {
        const audio = document.getElementById('audio');
        const playlistItems = document.querySelectorAll('.playlist-item');

        function playTrack(trackIndex) {
            if (trackIndex >= 0 && trackIndex < playlistItems.length) {
                const track = playlistItems[trackIndex];
                const trackSrc = track.getAttribute('data-src');
                audio.src = trackSrc; 
                audio.play(); 
            }
        }

        playlistItems.forEach((item, index) => {
            const playLink = item.querySelector('.play-link');
            playLink.addEventListener('click', (e) => {
                e.preventDefault(); 
                const dataIndex = playLink.getAttribute('data-index');
                playTrack(dataIndex); 
            });
        });
    });
</script>

</body>
</html>