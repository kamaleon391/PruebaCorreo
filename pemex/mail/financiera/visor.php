<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
    body{
        margin: 0;
        padding: 0;
    }
    .frame{
        width: 100%;
        height: 1240px;
        border:none;
    }
</style>

<?php
function pdfViewer()
{
    $id = base64_decode($_GET['file']);
    $url = "http://187.247.253.5/".$id;
    #$url = "http://192.168.3.154/".$id;


    echo '<iframe class="frame" scrolling="YES"   src="'.$url.'"/>';


}


pdfViewer();

?>   
