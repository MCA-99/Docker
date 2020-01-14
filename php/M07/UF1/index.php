<!DOCTYPE html>
<html>
    <head>
        <title>Hub</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
    <div class="container z-depth-3 y-depth-3 x-depth-3 grey lighten-4 row" style="width: 350px; margin: 0 auto; margin-top: 5%;">
        <br/>
        <h4 style="margin-left: 30px; margin-top: 0px;">Files List:</h4>
        <br/>
        <?php
            $files = scandir('.');
            sort($files);
            foreach($files as $file){
                if($file == "~" || $file == "." || $file == "index.php"){
                }else{
                    $diff = substr($file, -4);
                    if($diff == ".php"){
                        echo'<i class="material-icons right" style="margin-right: 30px;">insert_drive_file</i>
                        <a href="'.$file.'" style="font-size: 20px; margin-left: 30px;">'.$file.'</a><br/>';
                    }else{
                        echo'<i class="material-icons right" style="margin-right: 30px;">folder</i>
                        <a href="'.$file.'" style="font-size: 20px; margin-left: 30px;">'.$file.'</a><br/>';
                    }
                }
            }
        ?>
        <br/>
    </div>
    </body>
</html>