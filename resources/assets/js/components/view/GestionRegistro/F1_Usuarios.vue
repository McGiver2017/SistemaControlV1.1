<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <div class="card-block">
                    <h5 class="m-b-10">Gestión de Usuarios</h5>
                    <p class="text-muted m-b-10">Gestiona los datos de los usuarios que ofrece tu empresa.</p>
                    <ul class="breadcrumb-title line">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Gestión de Registro</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Usuarios</a>
                        </li>
                    </ul>
                  </div><br> 
                  <button class="btn btn-info btn-fill btn-wd" @click="agregar()">
                  Agregar
                </button>               
              </div>
            </div>
        </div>
        <div class="card-body">
            <el-table
            v-loading="loadingTabla"
        :data="tableUsuarios"
        style="width: 100%"
        max-height="250">
        <el-table-column
          fixed
          prop="id"
          label="Id"
          width="50">
        </el-table-column>
        <el-table-column
          prop="nombres"
          label="Nombre"
          width="120">
        </el-table-column>
        <el-table-column
          prop="apellidos"
          label="Apellido"
          width="120">
        </el-table-column>
        <el-table-column
          prop="email"
          label="Email"
          width="240">
        </el-table-column>  
        <el-table-column
          fixed="right"
          label="Operaciones"
          width="120">
          <template slot-scope="scope">
            <el-button
              @click.native.prevent="editRow(scope.row.id, tableUsuarios)"
              type="text"
              size="small">
              <i class="fas fa-edit"></i> 
            </el-button>
              <el-button
              @click.native.prevent="deleteRow(scope.row.id, tableUsuarios)"
              type="text"
              size="small">
              <i class="fas fa-trash-alt"></i>
            </el-button>
          </template>
        </el-table-column>
      </el-table>
        </div>
    </div>
    
    <!-- Mini Modal Crear-->
    <div class="modal fade modal-primary" id="WindowsForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ this.operacion }} Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> 
                  <div class="modal">
                      <i class="nc-icon nc-bulb-63"></i>
                  </div>
              </div>                                                       
                  <el-form :model="usuariosForm" status-icon :rules="rules2" ref="usuariosForm" label-width="120px" class="demo-ruleForm">
                    <div class="modal-body text-center">  
                      <el-form-item label="Nombres" prop="nombres">
                        <el-input v-model="usuariosForm.nombres"></el-input>
                      </el-form-item> 
                      <el-form-item label="Apellidos" prop="apellidos">
                        <el-input v-model="usuariosForm.apellidos"></el-input>
                      </el-form-item> 
                      <el-form-item label="Alias" prop="alias">
                        <el-input v-model="usuariosForm.alias"></el-input>
                      </el-form-item> 
                      <el-form-item label="Email" prop="email">
                        <el-input v-model="usuariosForm.email"></el-input>
                      </el-form-item>
                      <el-form-item label="Password" prop="pass">
                        <el-input type="password" v-model="usuariosForm.pass" auto-complete="off"></el-input>
                      </el-form-item>
                      <el-form-item label="Confirm" prop="checkPass">
                        <el-input type="password" v-model="usuariosForm.checkPass" auto-complete="off"></el-input>
                      </el-form-item>
                    </div>
                    <div class="modal-footer">
                      <el-form-item>
                      <el-button type="primary" @click="submitForm('usuariosForm')" class="btn btn-link btn-simple" >Submit</el-button>
                      <el-button @click="resetForm('usuariosForm')" class="btn btn-link btn-simple" >Reset</el-button>
                      <el-button  class="btn btn-link btn-simple" data-dismiss="modal">Close</el-button>                                    
                    </el-form-item>
                    </div>
                </el-form>
          </div>
      </div>
    </div>
    <!--  End Modal -->
    <!-- Mini Modal Edit-->
    <div class="modal fade modal-primary" id="WindowsFormEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ this.operacion }} Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> 
                  <div class="modal">
                      <i class="nc-icon nc-bulb-63"></i>
                  </div>
              </div>                                                       
                  <el-form :model="usuariosForm" status-icon :rules="rules2" ref="usuariosForm" label-width="120px" class="demo-ruleForm">
                    <div class="modal-body text-center">  
                      <el-form-item label="Nombres" prop="nombres">
                        <el-input v-model="usuariosForm.nombres"></el-input>
                      </el-form-item> 
                      <el-form-item label="Apellidos" prop="apellidos">
                        <el-input v-model="usuariosForm.apellidos"></el-input>
                      </el-form-item> 
                      <el-form-item label="Alias" prop="alias">
                        <el-input v-model="usuariosForm.alias"></el-input>
                      </el-form-item> 
                      <el-form-item label="Email" prop="email">
                        <el-input v-model="usuariosForm.email"></el-input>
                      </el-form-item>
                    </div>
                    <div class="modal-footer">
                      <el-form-item>
                      <el-button type="primary" @click="submitForm('usuariosForm')" class="btn btn-link btn-simple" ><i class="fas fa-save"></i></el-button>
                      <el-button @click="resetForm('usuariosForm')" class="btn btn-link btn-simple" ><i class="fas fa-sync"></i></el-button>
                      <el-button  class="btn btn-link btn-simple" data-dismiss="modal"><i class="fas fa-times"></i></el-button>                                    
                    </el-form-item>
                    </div>
                </el-form>
          </div>
      </div>
    </div>
    <!--  End Modal -->

  </div>
</template>

<script>
import { Loading } from 'element-ui';
  export default {
    beforeCreate: function () {
        this.loading = true;
    },
    created: function () {
        this.loading = false;
        this.getUsuarios();
    },
    data() { 
      var checktext = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('Please input the field'));
        }
        setTimeout(() => {
              callback();
        }, 1000);
      };
        var checkEmail = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('Please input the email'));
        }
        setTimeout(() => {
              callback();
        }, 1000);
      };
        var checkAge = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('Please input the age'));
        }
        setTimeout(() => {
          if (!Number.isInteger(value)) {
            callback(new Error('Please input digits'));
          } else {
            if (value < 18) {
              callback(new Error('Age must be greater than 18'));
            } else {
              callback();
            }
          }
        }, 1000);
      };
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password'));
        } else {
          if (this.usuariosForm.checkPass !== '') {
            this.$refs.usuariosForm.validateField('checkPass');
          }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password again'));
        } else if (value !== this.usuariosForm.pass) {
          callback(new Error('Two inputs don\'t match!'));
        } else {
          callback();
        }
      };   
      return {
        operacion: 'Registrar Nuevo',
        loadingTabla: true,
        loading: true,
        fullscreenLoading: false,
        tableUsuarios: [],
        ruleForm2: {
          pass: '',
          checkPass: '',
          age: '',
          email: ''
        },
        usuariosForm: {
          id: '',
          nombres: '',
          apellidos: '',
          alias: '',
          pass: '',
          checkPass: '',
          email: ''
        },
        rules2: {
          text: [
            { validator: checktext, trigger: 'blur' }
          ],
          nombres: [
            { validator: checktext, trigger: 'blur' }
          ],
          apellidos: [
            { validator: checktext, trigger: 'blur' }
          ],
          alias: [
            { validator: checktext, trigger: 'blur' }
          ],
          email: [
            { validator: checkEmail, trigger: 'blur' },
            {  type: 'email', message: 'Please input correct email address', trigger: 'blur,change' }
          ],
          pass: [
            { validator: validatePass, trigger: 'blur' }
          ],
          checkPass: [
            { validator: validatePass2, trigger: 'blur' }
          ],
          age: [
            { validator: checkAge, trigger: 'blur' }
          ]
        }
      }
      
    },
     methods: {
      seendDataForm(){
        if (this.operacion == "Registrar Nuevo") {
          $('#WindowsForm').modal('hide')  
          this.register()
        }
        else{
          $('#WindowsFormEdit').modal('hide') 
          this.update()          
        }
      },
      agregar(){
        this.operacion = "Registrar Nuevo"
        $('#WindowsForm').modal('show')
      },
      deleteRow(index, rows) {
        this.mensajeInfo()
        this.delete(index)
      }, 
      editRow(index, rows) {
        this.operacion = "Editar"
        this.getUsuario(index)
        $('#WindowsFormEdit').modal('show')  
      },
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.loadingTabla = true
            this.mensajeInfo()        
            this.seendDataForm()           
          } else {
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      register () {        
        this.boton = 'Registrandose'
        var url = '/api/user'
        axios.post(url,
          {
            nombres: this.usuariosForm.nombres,
            apellidos: this.usuariosForm.apellidos,
            alias: this.usuariosForm.alias,
            email: this.usuariosForm.email,
            password: this.usuariosForm.pass
          }).then(response => {
            if (response.data=="Registrado") {
              this.mensajeSucces("Se registro correctamente :)")
              this.getUsuarios()
              this.loadingTabla = false
              this.resetForm('usuariosForm')
            }     
            else{
              this.mensajeWarning()
              this.loadingTabla = false
              this.resetForm('usuariosForm')
            }       
          }).catch((e) => {
            this.mensajeWarning()
            this.loadingTabla = false
            this.resetForm('usuariosForm')
          })
      },
      update (id) {        
        this.boton = 'Registrandose'
        id = this.usuariosForm.id
        var url = '/api/user/'+ id
        axios.put(url,
          {
            nombres: this.usuariosForm.nombres,
            apellidos: this.usuariosForm.apellidos,
            alias: this.usuariosForm.alias,
            email: this.usuariosForm.email,
          }).then(response => {
            if (response.data=="Actualizado") {
              this.mensajeSucces("Actualización completada satisfactoriamente :)")
              this.getUsuarios()
              this.loadingTabla = false
              this.resetForm('usuariosForm')
            }     
            else{
              this.mensajeWarning()
              this.loadingTabla = false
              this.resetForm('usuariosForm')
            }       
          }).catch((e) => {
            this.mensajeWarning()
            this.loadingTabla = false
            this.resetForm('usuariosForm')
          })
      },
       delete (id) { 
        var url = '/api/user/'+ id
        axios.delete(url).then(response => {
            if (response.data=="Eliminado") {
              this.mensajeSucces("Se elimino satisfactoriamente el elemento :(")
              this.getUsuarios()
              this.loadingTabla = false
              this.resetForm('usuariosForm')
            }     
            else{
              this.mensajeWarning()
              this.loadingTabla = false
              this.resetForm('usuariosForm')
            }       
          }).catch((e) => {
            this.mensajeWarning()
            this.loadingTabla = false
            this.resetForm('usuariosForm')
          })
      },
       getUsuarios () {
        var url = '/api/user'
        axios.get(url).then(response => {
          this.tableUsuarios = response.data
          this.loadingTabla = false
        }).catch(error => {
        })
      },
      getUsuario (id) {
        var url = '/api/user/'+id+'/edit'
        axios.get(url).then(response => {
          this.usuariosForm.id = response.data.id
          this.usuariosForm.nombres = response.data.nombres
          this.usuariosForm.apellidos = response.data.apellidos
          this.usuariosForm.alias = response.data.alias
          this.usuariosForm.email = response.data.email
          this.usuariosForm.pass = response.data.pass
        }).catch(error => {
        })
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
          message: 'Oh no! ah ocurrido un error :(',
          type: 'warning'
        });
      },
      mensajeInfo() {
        this.$notify.info({
          title: 'Info',
          message: 'Procesando su petición'
        });
      },
    }
  }
</script>