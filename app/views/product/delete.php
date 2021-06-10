<div class="deletePanel">
    <p class="delete">Ви впевненні, що хочете видалити даний товар?</p>
    <div class="buttonsPanel">
    <form class="buttonForm" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input class="yesButton" type="submit" name="confirm" value="Так">
    </form>

    <form class="buttonForm" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input class="noButton" type="submit" name="confirm" value="Ні">
    </form>
    </div>
</div>
<?php
