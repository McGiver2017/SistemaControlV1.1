/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
import Vue from 'vue'
import VueRouter from 'vue-router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale'
import lang from 'element-ui/lib/locale/lang/es'
var VueCookie = require('vue-cookie')

Vue.use(VueRouter)
Vue.use(ElementUI)
Vue.use(VueCookie)
locale.use(lang)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app', require('./components/AppComponent.vue'))
Vue.component('DashBoard', require('./components/Layout/DashBoard.vue'))
import DashBoard from './components/Layout/DashBoard'
import ViewUsuariosIndex from './components/view/usuarios/index.vue'
import ViewUsuariosCreate from './components/view/usuarios/create.vue'
import F1_Usuarios from './components/view/GestionRegistro/F1_Usuarios.vue'
import F2_Clientes from './components/view/GestionRegistro/F2_Clientes.vue'
import F3_Proveedores from './components/view/GestionRegistro/F3_Proveedores.vue'
import F4_Conductores from './components/view/GestionRegistro/F4_Conductores.vue'
import F5_Vehiculos from './components/view/GestionRegistro/F5_Vehiculos.vue'
import F6_Productos from './components/view/GestionRegistro/F6_Productos.vue'
import F7_Cajas from './components/view/GestionRegistro/F7_Cajas.vue'
import F8_DetalleCaja from './components/view/GestionRegistro/F8_DetalleCaja.vue'

import N1_Servicio from './components/view/GestionNegocio/N1_Servicio.vue'
import N1_Guia from './components/view/GestionNegocio/N1_Guia.vue'
import N2_Facturas from './components/view/GestionNegocio/N2_Facturas.vue'
import N3_Transporte from './components/view/GestionNegocio/N3_Transporte.vue'
import N4_DetalleTransporte from './components/view/GestionNegocio/N4_DetalleTransporte.vue'

import Login from './components/view/InSist/Login.vue'

const Foo = {
  template: '<div>foo</div>'
}
const Bar = {
  template: '<div>bar</div>'
}
const routes = [{
  path: '/login',
  component: Login
},
  {
    path: '/usuarios',
    component: DashBoard,
    redirect: '/usuarios/index',
    children: [{
      path: 'index',
      name: 'Usuarios',
      component: ViewUsuariosIndex
    },
      {
        path: 'create',
        name: 'Crear Usuarios',
        component: ViewUsuariosCreate
      }
    ]
  },
  {
    path: '/GestionRegistro',
    component: DashBoard,
    redirect: '/GestionRegistro/usuarios',
    children: [{
      path: 'usuarios',
      name: 'Usuarios',
      component: F1_Usuarios
    },
      {
        path: 'clientes',
        name: 'Clientes',
        component: F2_Clientes
      },
      {
        path: 'proveedores',
        name: 'Proveedores',
        component: F3_Proveedores
      },
      {
        path: 'conductores',
        name: 'Conductores',
        component: F4_Conductores
      },
      {
        path: 'vehiculos',
        name: 'Vehiculos',
        component: F5_Vehiculos
      },
      {
        path: 'productos',
        name: 'Productos',
        component: F6_Productos
      },
      {
        path: 'cajas',
        name: 'Cajas',
        component: F7_Cajas
      }, {
        path: 'caja/:id',
        name: 'Detalle Caja',
        component: F8_DetalleCaja
    }
    ]
  },
  {
    path: '/GestionServicio',
    component: DashBoard,
    redirect: '/GestionServicio/crearservicio',
    children: [{
      path: 'crearservicio',
      name: 'Crear Servicio',
      component: N1_Servicio
    },
      {
        path: 'crearguia/:id',
        name: 'Crear Guia',
        component: N1_Guia
      },
      {
        path: 'facturas',
        name: 'Facturas',
        component: N2_Facturas
      }, {
        path: 'transporte',
        name: 'transporte',
        component: N3_Transporte
      }, {
        path: 'transporte/:id',
        name: 'transporte',
        component: N4_DetalleTransporte
      }
    ]
  },
  {
    path: '/',
    component: DashBoard
  }
]
const router = new VueRouter({
  routes // forma corta para routes: routes
})
router.beforeEach((to, from, next) => {
  var login = VueCookie.get('user')
  console.log('estoy pasando' + login)
  var donde = to.path
  var de = to.path
  console.log(to.path)
  console.log(from)
  if (de !== '/register') {
    if (donde !== '/login') {
      if (login) {
        console.log('pasa normal')
        next()
      } else {
        console.log('no esta bien')
        next('/login')
      }
    } else {
      if (login) {
        next('/')
      } else {
        console.log('no esta bien')
        next()
      }
    }
  } else {
    next()
  }
})
const app = new Vue({
  el: '#app',
router})
