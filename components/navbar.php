<nav class="top-navbar">

    <div class="nav-left">

        <div class="logo-box">
            🍩
        </div>

        <div>
            <h2>Donutlicious</h2>
            <small>Smart Recommendation for Sweet Lovers</small>
        </div>

    </div>

    <div class="nav-right">

        <button class="notif-btn">
            🔔
        </button>

        <div class="user-profile">

            <div class="avatar">
                🍩
            </div>
            <div class="user-info">

                <span class="username">
                    <?php
                    if(isset($_SESSION['nama_admin'])){
                        echo $_SESSION['nama_admin'];
                    }else{
                        echo "Guest User";
                    }
                    ?>
                </span>

                <small>
                    <?php
                    if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){
                        echo "Administrator";
                    }else{
                        echo "Customer";
                    }
                    ?>
                </small>

            </div>

            <span class="dropdown-icon">
                ▼
            </span>

        </div>

    </div>

</nav>