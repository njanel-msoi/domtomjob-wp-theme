<?php
$siteTitle = esc_attr(get_bloginfo('name', 'display'));
$siteLogo = get_stylesheet_directory_uri() . '/images/logo_dtj.png';

?>

<!-- Desktop Menu -->
<header class="header sticky-bar">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo"><a class="d-flex" href="<?= PAGES_URLS->Accueil ?>">
                        <img alt="<?= $siteTitle ?>" src="<?= $siteLogo ?>" style="height: 36px;">
                    </a></div>
            </div>
            <div class="header-nav">
                <nav class="nav-main-menu">
                    <ul class="main-menu">
                        <!-- <li><a href="<?= PAGES_URLS->Accueil ?>">Accueil</a> -->
                        </li>
                        <li class="has-children"><a href="jobs-grid.html">Recruteurs</a>
                            <ul class="sub-menu">
                                <li><a href="jobs-list.html">Publier une offre</a></li>
                                <li><a href="jobs-grid.html">Tarifs</a></li>
                                <li><a href="job-details.html">Espace recruteur</a></li>
                            </ul>
                        </li>
                        <li class="has-children"><a href="candidates-grid.html">Emploi</a>
                            <ul class="sub-menu">
                                <li><a href="candidates-grid.html">Offres d'emploi</a></li>
                                <li><a href="candidate-details.html">Espace candidat</a></li>
                            </ul>
                        </li>
                        <li class="has-children"><a href="blog-grid.html">Régions</a>
                            <ul class="sub-menu">
                                <li><a href="page-about.html">Réunion</a></li>
                                <li><a href="page-about.html">France métropolitaine</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
            <div class="header-right">
                <nav class="nav-main-menu">
                    <ul class="main-menu">
                        <li class="has-children"><a href="blog-grid.html" class="fw-bold">Mon espace</a>
                            <ul class="sub-menu">
                                <li><a href="blog-grid.html">Espace candidat</a></li>
                                <li><a href="blog-grid.html">Espace recruteur</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- <li class="dashboard"><a href="http://wp.alithemes.com/html/jobbox/demos/dashboard" target="_blank">Dashboard</a></li>
                <div class="block-signin"><a class="text-link-bd-btom hover-up" href="page-register.html">Register</a>
                    <a class="btn btn-default btn-shadow ml-40 hover-up" href="page-signin.html">Sign in</a>
                </div> -->
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->