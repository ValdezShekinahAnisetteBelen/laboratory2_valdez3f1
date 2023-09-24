<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML head content here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            padding: 200px;
        }

        h1 {
            color: #333;
        }

        #player-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        audio {
            width: 100%;
        }

        #playlist {
            list-style: none;
            padding: 0;
        }

        #playlist li {
            cursor: pointer;
            padding: 10px;
            background-color: #eee;
            margin: 5px 0;
            transition: background-color 0.2s ease-in-out;
        }

        #playlist li:hover {
            background-color: #ddd;
        }

        #playlist li.active {
            background-color: #007bff;
            color: #fff;
        }
                
        .button-container {
        display: flex;
        align-items: center;
    }

    .plus-button {
    background-color: blue; 
    width: 30px; 
    height: 30px; 
    display: inline-block;
    margin-right: 10px; 
    text-align: center;
    border-radius: 5px; 
    cursor: pointer;
}

.plus-icon {
    font-size: 24px; 
    color: white; 
    line-height: 30px; 
}
    .ex-button {
        width: 30px;
        height: 30px;
        display: inline-flex;
        margin-right: 8px;
        text-align: center;
        border-radius: 5px;
    }

    .ex-icon {
        font-size: 24px;
        color: blue; 
        line-height: 30px;
    }
    .play-link:hover span {
        text-decoration: underline blue; 
    }

    .play-link-container {
        display: flex;
        flex-grow: 1;
        align-items: center;
    }

   
    </style>
</head>
<body>


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
                        <a href="/playlist/"><?= $mus['name'] ?></a>
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

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Upload Music</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
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
            <!-- ... Your form fields ... -->
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



<audio id="audio" controls autoplay></audio>

<ul id="playlist">
    <?php foreach ($music_view as $index => $music): ?>
        <li class="playlist-item" data-src="<?= $music['file_path'] ?>">
        <a href="#" class="play-link" data-index="<?= $index ?>" style="text-decoration: none; color: black; display: flex; align-items: center; justify-content: center;">
            <span style="border-bottom: 1px solid transparent;">Title: <?= $music['title'] ?> - Artist: <?= $music['artist'] ?></span>
        </a>
            <div class="button-container">
                <div class="plus-button">
                    <div class="plus-icon">+</div>
                </div>
                <div class="ex-button">
                    <a href="/delete/<?= $music['id'] ?>" class="fas fa-trash ex-icon"></a>
                </div>
                <div class="play-link-container">
                </div>.
        </li>
        </div>
    <?php endforeach; ?>
</ul>


    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select from playlist</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/" method="post">
                        <input type="hidden" id="musicID" name="musicID">
                        <select name="playlist" class="form-control">
                            <option value="playlist">playlist</option>
                        </select>
                        <input type="submit" name="add">
                    </form>
                </div>
               
            </div>
        </div>
    </div>

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