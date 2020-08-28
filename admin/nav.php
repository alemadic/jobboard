<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">back to site</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="navLink" href="../logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">
                  Admin Index
                </a>
              </li>

              <?php 
                $strana = $_SERVER['PHP_SELF'] ;

                if(strpos($strana, "index")):
              ?>
              <li class="nav-item">
                <a class="nav-link link" href="index.php?link=jobs">
                  Jobs
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link link" href="index.php?link=categories">
                  
                  Categories
                </a>
              </li>
                <?php endif; ?>
            </ul>
            
          </div>
        </nav>