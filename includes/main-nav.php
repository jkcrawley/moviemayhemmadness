<nav class='desktop-nav'>
        <h2><a href='index.php'>Movie Mayhem Madness</a></h2>

            <!--Main links -->
            <ul class='main-links'>
                <li><a href='#'>Discover</a> </li>
                <li><a href='#'>Reviews</a></li>
                <li><a href='#'>Articles</a></li>

            </ul>

            <ul>
                <!--Search button-->
                <li>
                    <form action='' method='post'>
                        <div class='search'>
                            <span class="material-symbols-outlined" style='color: black;'>search</span>
                            <input type='search' name='search' class='search-input' placeholder='Search'/>
                        </div>
                    </form>
                </li>

                <!--- Desktop drop down for profile -->
                <li class='dropdown'<?php echo $loggedin; ?>>
                    <button onclick='dropdown()' class='dropbtn'>
                        <span class="material-symbols-outlined person">person</span>
                    </button>
                    <div id="prof-menu" class="profile-links">
                        <a href='#'>My Profile</a>

                        <?php 
                            echo $tools; 
                            echo $review;
                            echo $article; 
                        ?>
                        <a href='logout.php'>Logout</a>
                    </div>
                </li>
                
                <!-- Display signup and log out buttons if user is logged out -->
                <span class='login' <?php echo $loggedout; ?>>
                    <li><a href='signup.php'><button class='nav-signup'>Sign Up</button></a>
                    <a href='login.php'><button class='nav-login'>Log In</button></a><li>
                </span>
            </ul>
        </nav>

        <!-- close menu items -->
        <div class='closemenu' onclick='closefunc()'></div>