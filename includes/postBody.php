<?php

    if(isset($_POST['text'])){
        echo '
            <textarea name="textBody" id="textBody" placeholder="Enter Post body"></textarea>
            <br>
            <!--<span id="change">Change body type</span>
            <br>-->
        ';
    }else if(isset($_POST['image'])){
        echo '
            <label>Image</label>
           <input type="file" id="image" accept="image/*" capture="camcoder">
           <br>
           <textarea id="caption" name="caption" col="4" max="100" placeholder="Caption"></textarea>
           <br>
           <!--<span id="change">Change body type</span>
            <br>-->
        ';
    }else if(isset($_POST['video'])){
        echo '
            <label>Video</label>
           <input type="file" id="video" accept="video/*" capture="camcoder">
           <br>
           <textarea id="caption" name="caption" col="4" max="100" placeholder="Caption"></textarea>
           <br>
           <!--<span id="change">Change body type</span>
            <br>-->
        ';
    }else if(isset($_POST['change'])){
        echo '
        <p>Select a post body type</p><br>
        <span id="textBody">Text Body</span>
        <span id="imageBody">Image Body</span>
        <span id="videoBody">Video Body</span>
        ';
    }

?>