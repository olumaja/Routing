<?php

if(displayFlash('error')){
    echo '<div class="alert alert-danger">'.displayFlash('error').'</div>';
}

if(displayFlash('info')){
    echo '<div class="alert alert-info">'.displayFlash('info').'</div>';
}

if(displayFlash('success')){
    echo '<div class="alert alert-success">'.displayFlash('success').'</div>';
}