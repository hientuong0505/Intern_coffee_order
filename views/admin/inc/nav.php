      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav"></ul>
            <?php
              include(__DIR__ . '\..\..\lib\session.php');
              Session::checkSession();
              if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                Session::destroy();
              }
            ?>
            <button>
              <a href="?action=logout">Log out</a>
            </button>
            </ul>
          </div>

        </div>


      </nav>