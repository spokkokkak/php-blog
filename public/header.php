<?php
    require_once 'function/authen.php';
?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">News</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="blog.php">Blog</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <p class="center"></p>

      <?php if (session_id() && isset($_SESSION['user_id']) && ($_SESSION['plan'] == 'free')): ?>
        <form  action="api/upgrade_to_premium.php" method="POST" onsubmit="return confirm('Are you sure you want to upgrade?');">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" class="btn-getstarted form-control">Upgrade</button>
            <!-- <br>
            <a href="function/logout.php" onclick="return confirm('Are you sure you want to logout?');" class="btn-getstarted">Logout</a> -->
        </form>
      <?php elseif (session_id() && isset($_SESSION['user_id']) && ($_SESSION['plan'] == 'premium')): ?>
        <form  action="api/cancel_premium.php" method="POST" onsubmit="return confirm('Are you sure you want to downgrade?');">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" class="btn-getstarted form-control">downgrade</button>
            <!-- <br>
            <a href="function/logout.php" onclick="return confirm('Are you sure you want to logout?');" class="btn-getstarted">Logout</a> -->
        </form>
       

      <?php else: ?>
        <a class="btn-getstarted" href="login.php">Login</a>

      <?php endif; ?>

    </div>
  </header>

