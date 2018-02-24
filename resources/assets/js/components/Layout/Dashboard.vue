<template>
      <div class="wrapper">
          <div class="sidebar" data-color="black" data-image="/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                        SC
                    </a>
                    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                        SisControl
                    </a>
                </div>
                <div class="user">
                    <div class="photo">
                        <img src="/img/usuario.png" />
                    </div>
                    <div class="info ">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>{{this.$cookie.get('user')}}
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">                      
                                <li>
                                    <a href="#" v-on:click.prevent='logout' class="profile-dropdown">
                                        <span class="sidebar-mini">L</span>
                                        <span class="sidebar-normal">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </router-link>
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
                                <li class="nav-item ">
                                    <router-link to="/GestionRegistro/cajas" class="nav-link">
                                        <span class="sidebar-mini">C</span>
                                        <span class="sidebar-normal">Cajas</span>
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
                                <li class="nav-item ">
                                    <router-link to="/GestionServicio/facturas" class="nav-link">
                                        <span class="sidebar-mini">F</span>
                                        <span class="sidebar-normal">Facturas</span>
                                    </router-link>
                                </li>
                                <li class="nav-item ">
                                    <router-link to="/GestionServicio/transporte" class="nav-link">
                                        <span class="sidebar-mini">T</span>
                                        <span class="sidebar-normal">Transporte</span>
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
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-bullet-list-67"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">                                   
                                    <a href="#" v-on:click.prevent='logout' class="dropdown-item text-danger">
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
                               <router-link to="/GestionServicio/crearservicio">
                                        Facturador
                                </router-link>
                            </li>
                           
                        </ul>
                        <p class="copyright text-center">
                            ©2018
                            
                             Sistema de control Facturador
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
  data() {
    return {
      ejemplo: "datos"
    };
  },
  methods: {
    toggleMenu() {
      this.isClosed = !this.isClosed;
    },
    logout() {
      console.log("saliendo");
      this.$cookie.set("user", "", 1);
      location.href = "/" ;
      
    }
  },
  mounted() {
    console.log("Estoy en el menu.");
  }
};
</script>