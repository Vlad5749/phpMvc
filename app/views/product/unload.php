<div class="exportPanel">
    <p class="export">Експортувати товари в Xml файл?</p>
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
