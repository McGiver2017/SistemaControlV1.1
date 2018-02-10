<template>
      <div class="wrapper">
          <div class="sidebar" data-color="purple" data-image="/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                        Ct
                    </a>
                    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                        Creative Tim
                    </a>
                </div>
                <div class="user">
                    <div class="photo">
                        <img src="/img/default-avatar.png" />
                    </div>
                    <div class="info ">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>Tania Andrew
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a class="profile-dropdown" href="#pablo">
                                        <span class="sidebar-mini">MP</span>
                                        <span class="sidebar-normal">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="profile-dropdown" href="#pablo">
                                        <span class="sidebar-mini">EP</span>
                                        <span class="sidebar-normal">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="profile-dropdown" href="#pablo">
                                        <span class="sidebar-mini">S</span>
                                        <span class="sidebar-normal">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#usuarios">
                            <i class="nc-icon nc-app"></i>
                            <p>
                                Usuarios
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="usuarios">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <router-link to="/usuarios" class="nav-link">
                                        <span class="sidebar-mini">U</span>
                                        <span class="sidebar-normal">Mostrar</span>
                                    </router-link>
                                </li>
                                <li class="nav-item ">
                                    <router-link to="/usuarios/create" class="nav-link">
                                        <span class="sidebar-mini">C</span>
                                        <span class="sidebar-normal">Crear</span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#gestionRegistro">
                            <i class="nc-icon nc-app"></i>
                            <p>
                                Gestion de Registro
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="gestionRegistro">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <router-link to="/GestionRegistro/usuarios" class="nav-link">
                                        <span class="sidebar-mini">U</span>
                                        <span class="sidebar-normal">Usuarios</span>
                                    </router-link>
                                </li>
                                 <li class="nav-item ">
                                    <router-link to="/GestionRegistro/clientes" class="nav-link">
                                        <span class="sidebar-mini">C</span>
                                        <span class="sidebar-normal">Clientes</span>
                                    </router-link>
                                </li>
                                <li class="nav-item ">
                                    <router-link to="/GestionRegistro/proveedores" class="nav-link">
                                        <span class="sidebar-mini">P</span>
                                        <span class="sidebar-normal">Proveedores</span>
                                    </router-link>
                                </li>
                                <li class="nav-item ">
                                    <router-link to="/GestionRegistro/conductores" class="nav-link">
                                        <span class="sidebar-mini">C</span>
                                        <span class="sidebar-normal">Conductores</span>
                                    </router-link>
                                </li>
                                <li class="nav-item ">
                                    <router-link to="/GestionRegistro/vehiculos" class="nav-link">
                                        <span class="sidebar-mini">V</span>
                                        <span class="sidebar-normal">Vehiculos</span>
                                    </router-link>
                                </li>
                                 <li class="nav-item ">
                                    <router-link to="/GestionRegistro/productos" class="nav-link">
                                        <span class="sidebar-mini">P</span>
                                        <span class="sidebar-normal">productos</span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#gestionNegocio">
                            <i class="nc-icon nc-app"></i>
                            <p>
                                Gestion de Servicios
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="gestionNegocio">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <router-link to="/GestionServicio/crearservicio" class="nav-link">
                                        <span class="sidebar-mini">CS</span>
                                        <span class="sidebar-normal">Crear Servicio</span>
                                    </router-link>
                                </li>
                                 
                            </ul>
                        </div>
                    </li>
                    
                </ul>
            </div>
          </div>
          <div class="main-panel">
               <!-- Navbar -->
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon d-none d-lg-block">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo"> Sistema de Control </a>
                    </div>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="nav navbar-nav mr-auto">
                            <form class="navbar-form navbar-left navbar-search-form" role="search">
                                <div class="input-group">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    <input type="text" value="" class="form-control" placeholder="Search...">
                                </div>
                            </form>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-planet"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Create New Post</a>
                                    <a class="dropdown-item" href="#">Manage Something</a>
                                    <a class="dropdown-item" href="#">Do Nothing</a>
                                    <a class="dropdown-item" href="#">Submit to live</a>
                                    <li class="divider"></li>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </ul>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-bell-55"></i>
                                    <span class="notification">5</span>
                                    <span class="d-lg-none">Notification</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <a class="dropdown-item" href="#">Notification 4</a>
                                    <a class="dropdown-item" href="#">Notification 5</a>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-bullet-list-67"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">
                                        <i class="nc-icon nc-email-85"></i> Messages
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="nc-icon nc-umbrella-13"></i> Help Center
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="nc-icon nc-settings-90"></i> Settings
                                    </a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="#">
                                        <i class="nc-icon nc-lock-circle-open"></i> Lock Screen
                                    </a>
                                    <a href="#" class="dropdown-item text-danger">
                                        <i class="nc-icon nc-button-power"></i> Log out
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                             <transition name="fade" mode="out-in">
                                <router-view></router-view>
                             </transition>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                <div class="container">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©2016
                            
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
            </div>
                  
          </div>
      </div>     
</template>
<script>
    export default {
        data(){
            return{
                ejemplo: 'datos'
            }
        },
        mounted() {
            console.log('Estoy en el menu.')
        }
    }
</script>