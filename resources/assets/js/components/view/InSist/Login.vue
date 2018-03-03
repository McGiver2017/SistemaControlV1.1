<template>
      <div class="wrapper wrapper-full-page">
        <div class="full-page section-image" data-color="black" data-image="/img/fondo_login.jpg"  >
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                        <form class="form" v-on:submit.prevent="login_in">
                            <div class="card card-login card-hidden">
                                <div class="card-header ">
                                    <h3 class="header text-center">Login</h3>
                                </div>
                                <div class="card-body ">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" placeholder="Enter email" class="form-control" v-model='email'>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" class="form-control" v-model='password'>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">
                                    <button type="submit" class="btn btn-warning btn-wd">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>     
</template>
<script>
  import axios from 'axios'
  export default {
    name: 'login',
    data () {
      return {
        email: '',
        password: ''
      }
    },
    methods: {
      toggleNavbar () {
        document.body.classList.toggle('nav-open')
      },
      closeMenu () {
        document.body.classList.remove('nav-open')
        document.body.classList.remove('off-canvas-sidebar')
      },mensajeInfo() {
        this.$notify.info({
          title: 'Info',
          message: 'Ingresando al sistema'
        });
      },
    mensajeSucces(mensaje) {
      this.$notify({
        title: 'Success',
        message: mensaje,
        type: 'success'
      });
    },
    mensajeWarning() {
      this.$notify({
        title: 'Error',
        message: 'Oh no! correo o contraseña incorrectos :(',
        type: 'warning'
      });
    },
    initdash(){
        demo.checkFullPageBackgroundImage();
        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    },
      login_in () {
        this.mensajeInfo();
        var url = '/api/usuarios'
        axios.post(url,
          {
            email: this.email,
            password: this.password
          }).then(response => {
            var data = response.data
            console.log(data.data)
            console.log(data.data.id)
            console.log(data.data.alias)
            if (data) {
              this.mensajeSucces('Bienvenido')
              this.$cookie.set('id', data.data.id, 1)
              this.$cookie.set('user', data.data.alias, 1)
              location.href = "/" ;
              
            } else { 
              this.mensajeWarning()
              console.log('no entrar contraseña o email invalidos') }
          }).catch(
            error => {
              this.mensajeWarning()
              console.log(error)
            }
          )
        // this.$router.push('/admin')
      }
    },
    beforeDestroy () {
      this.closeMenu()
    },
    
  }
</script>
