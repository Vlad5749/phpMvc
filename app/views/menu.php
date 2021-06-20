<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php 
        foreach($this->get('menuCollection') as $item)  :
    ?>
        <li>
            <?php if ($item['name'] !== 'Експорт в Xml') {
                echo \Core\Url::getLink($item['path'], $item['name']);
            } elseif (Core\Helper::isAdmin()) {
                echo \Core\Url::getLink($item['path'], $item['name']);}?>
        </li>
    <?php endforeach; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php if (!isset($_SESSION['id'])) : ?>
        <li><a href="<?php echo $this->getBP();?>/customer/registration/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="<?php echo $this->getBP();?>/customer/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php else: ?>
        <li><a href="<?php echo $this->getBP();?>/customer/user?id=<?php echo $_SESSION['id'] ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['last_name'] . ' ' . $_SESSION['first_name']; ?></a></li>
        <li><a href="<?php echo $this->getBP();?>/customer/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php endif; ?>
    </ul>
  </div>
</nav>
