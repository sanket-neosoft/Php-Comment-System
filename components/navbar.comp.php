<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://uilogos.co/img/logotype/earth.png" class="logotype nav-logo" alt="logomark">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                if (empty($_SESSION["username"])) {
                ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item my-1 mx-2">
                            <button type="button" class="btn btn-outline-success">Login</button>
                        </li>
                        <li class="nav-item my-1 mx-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Register</button>
                        </li>
                    </ul>
                <?php
                } else {
                ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item my-1 mx-2">
                            <button class="btn">Welcome: <?= $_SESSION["username"] ?></button>
                        </li>
                        <li class="nav-item my-1 mx-2">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                <i class="bi bi-pencil me-2"></i>Change Password
                            </button>
                        </li>
                        <li class="nav-item my-1 mx-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-plus-square me-2"></i> Add Post
                            </button>
                        </li>
                        <li class="nav-item my-1 mx-2">
                            <form action="" method="POST">
                                <button type="submit" class="btn btn-success" name="logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
</header>