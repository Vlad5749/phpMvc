<br><p class="message"><?php echo $_GET['text']; ?></p><br>

<div class="messagePanel">
   <form  method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <input type="submit" name="confirm" value="Повернутись до списку товарів">
    </form> 
</div>
