<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Main Page</title>
</head>
<body>
    <header id="nav-menu">
        <div class="container">
            <div class="nav-start">
                <a class="logo" href="logo.png">
                    <img src="logo.png" width="80" height="80" alt="Inc Logo" />
                </a>
                <nav class="menu">
                    <div class="menu">
                        <ul class="menu-bar">
                            <li>
                                <button class="nav-link dropdown-btn" data-dropdown="dropdown1" aria-expanded="false">Services
                                    <i class="bx bx-chevron-down" aria-hidden="true"></i>
                                </button>
                                <div id="dropdown1" class="dropdown"></div>
                            </li>
                            <li>
                                <button class="nav-link dropdown-btn" data-dropdown="dropdown2" aria-expanded="false">Discover
                                    <i class="bx bx-chevron-down" aria-hidden="true"></i>
                                </button>
                                <div id="dropdown2" class="dropdown">
                                    <ul aria-labelledby="categories-title">
                                        <span id="categories-title" class="dropdown-link-title">Services</span>
                                        <li>
                                            <a class="dropdown-link" href="#branding">Branding</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-link" href="#branding">Branding</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a class="nav-link" href="/">Appointment</a></li>
                            <li><a class="nav-link" href="/">History</a></li>
                            <li><a class="nav-link" href="/">Profile</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
                <button id="hamburger" aria-label="hamburger" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-menu" aria-hidden="true"></i>
                </button>
        </div>
    </header> 
</body>
</html>