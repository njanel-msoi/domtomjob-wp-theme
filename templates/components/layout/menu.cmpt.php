<?php
?>

<!-- Desktop Menu -->
<header class="header sticky-bar stickable">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo"><a class="d-flex" href="<?= PAGES_URLS->Accueil ?>">
                        <img alt="<?= esc_attr(get_bloginfo('name', 'display')) ?>" src="<?= get_stylesheet_directory_uri() . '/images/logo_dtj.png' ?>">
                    </a></div>
            </div>
            <div class="header-nav">
                <nav class="nav-main-menu">
                    <ul class="main-menu large-screen">
                        <li><a href="<?= PAGES_URLS->ListeOffres ?>">Offres d'emploi</a></li>
                        <li><a href="<?= PAGES_URLS->ListeEntreprises ?>">Les recruteurs</a></li>
                        <li><a href="<?= PAGES_URLS->PublierAnnonce ?>">Publier une offre</a></li>
                        <!-- <li><a href="<?= PAGES_URLS->NosOffres ?>">Tarifs</a></li> -->
                    </ul>
                    <ul class="main-menu middle-screen">
                        <li class="has-children"><a href="<?= PAGES_URLS->Accueil ?>">Recruteurs</a>
                            <ul class="sub-menu">
                                <li><a href="<?= PAGES_URLS->PublierAnnonce ?>">Publier une offre</a></li>
                                <li><a href="<?= PAGES_URLS->NosOffres ?>">Tarifs</a></li>
                                <li><a href="<?= PAGES_URLS->EspaceRecruteur ?>">Espace recruteur</a></li>
                            </ul>
                        </li>
                        <li class="has-children"><a href="<?= PAGES_URLS->ListeOffres ?>">Emploi</a>
                            <ul class="sub-menu">
                                <li><a href="<?= PAGES_URLS->ListeOffres ?>">Offres d'emploi</a></li>
                                <li><a href="<?= PAGES_URLS->ListeEntreprises ?>">Découverte des entreprises</a></li>
                                <li><a href="<?= PAGES_URLS->EspaceCandidat ?>">Espace candidat</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
            <div class="header-right">
                <nav class="nav-main-menu">
                    <ul class="main-menu">
                        <li class="has-children"><a class="fw-bold">Mon espace</a>
                            <ul class="sub-menu">
                                <li><a href="<?= PAGES_URLS->EspaceCandidat ?>">Espace candidat</a></li>
                                <li><a href="<?= PAGES_URLS->EspaceRecruteur ?>">Espace recruteur</a></li>
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
<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">

            <div>
                <!-- <div class="mobile-search mobile-header-border mb-30">
                    <form action="#">
                        <input type="text" placeholder="Search…"><i class="fi-rr-search"></i>
                    </form>
                </div> -->
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start-->
                    <nav>
                        <ul class="mobile-menu font-heading">

                            <li class="has-children"><a>Recruteurs</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= PAGES_URLS->PublierAnnonce ?>">Publier une offre</a></li>
                                    <li><a href="<?= PAGES_URLS->NosOffres ?>">Tarifs</a></li>
                                    <li><a href="<?= PAGES_URLS->EspaceRecruteur ?>" class="fw-bold">Espace recruteur</a></li>
                                </ul>
                            </li>
                            <li class="has-children"><a>Candidats</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= PAGES_URLS->ListeOffres ?>">Offres d'emploi</a></li>
                                    <li><a href="<?= PAGES_URLS->ListeEntreprises ?>">Découverte des entreprises</a></li>
                                    <li><a href="<?= PAGES_URLS->EspaceCandidat ?>" class="fw-bold">Espace candidat</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
                <!-- <div class="mobile-account">
                    <h6 class="mb-10">Your Account</h6>
                    <ul class="mobile-menu font-heading">
                        <li><a href="blog-grid.html">Espace candidat</a></li>
                        <li><a href="blog-grid.html">Espace recruteur</a></li>
                    </ul>
                </div> -->
                <!-- <div class="site-copyright">Copyright 2022 &copy; JobBox.<br>Designed by AliThemes.</div> -->
            </div>
        </div>
    </div>
</div>