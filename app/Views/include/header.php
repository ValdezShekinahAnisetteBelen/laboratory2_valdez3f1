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