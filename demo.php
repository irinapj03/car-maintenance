<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="demo.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
<header id="nav-menu" aria-label="navigation bar">
  <div class="container">
    <div class="nav-start">
      <a class="logo" href="/">
        <img src="https://github.com/Evavic44/responsive-navbar-with-dropdown/blob/main/assets/images/logo.png?raw=true" width="35" height="35" alt="Inc Logo" />
      </a>
      <nav class="menu">
        <ul class="menu-bar">
          <li>
            <button class="nav-link dropdown-btn" data-dropdown="dropdown1" aria-haspopup="true" aria-expanded="false" aria-label="browse">
              Browse
              <i class="bx bx-chevron-down" aria-hidden="true"></i>
            </button>
            <div id="dropdown1" class="dropdown"></div>
                 
            <button class="nav-link dropdown-btn" data-dropdown="dropdown2" aria-haspopup="true" aria-expanded="false" aria-label="discover">
              Discover
              <i class="bx bx-chevron-down" aria-hidden="true"></i>
            </button>
            <div id="dropdown2" class="dropdown">
              <ul role="menu">
                <li>
                  <span class="dropdown-link-title">Browse Categories</span>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="#branding">Branding</a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="#illustrations">Illustration</a>
                </li>
              </ul>
              <ul role="menu">
                <li>
                  <span class="dropdown-link-title">Download App</span>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="#mac-windows">MacOS & Windows</a>
                </li>
                <li role="menuitem">
                  <a class="dropdown-link" href="#linux">Linux</a>
                </li>
              </ul>
            </div>
          </li>
          <li><a class="nav-link" href="/">Jobs</a></li>
          <li><a class="nav-link" href="/">Livestream</a></li>
          <li><a class="nav-link" href="/">About</a></li>
        </ul>
      </nav>
    </div>

      <button id="hamburger" aria-label="hamburger" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-menu" aria-hidden="true"></i>
      </button>
    </div>
  </div>
</header>

<!-- Page markup: Not important -->
<main style="padding: 1.5rem; margin: 0 auto; max-width: 1300px">
  <h1>Navigation Bar</h1>
  <p>
    Want to learn how to make this?
    <a style="text-decoration: underline; color: var(--primary-color)" href="https://www.freecodecamp.org/news/how-to-build-a-responsive-navigation-bar-with-dropdown-menu-using-javascript/" target="_blank">Read the tutorial</a>
  </p>
</main>
</body>
</html>
