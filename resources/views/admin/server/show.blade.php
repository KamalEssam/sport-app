
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $server->channel->name.' - '. $server->name }}">
    <meta name="keywords" content="{{ $server->channel->name.','. $server->name }}">
    <title>{{ $server->channel->name.' - '. $server->name }}</title>
    <style type="text/css">
        html {
            height: 100%;
            width: 100%; 
        }
        body {
            margin: 0px;
            padding: 0px;
            height: 100%;
            width: 100%; 
            overflow-x: hidden; 
            text-align: center;
            overflow: hidden;
        }
        /* iframe's parent node */
        div#root {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #000;
        }

        /* iframe itself */
        div#root > iframe {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
        }

    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div id="root">
        <?php 
        $code = str_replace('[[id]]', $server->code, $server->serverType->code);
        $code = str_replace('[[width]]', 'document.getElementById("root").offsetWidth', $code);
        $code = str_replace('[[height]]', 'document.getElementById("root").offsetHeight', $code);
        echo $code; 
        ?>
    </div>
</html>
