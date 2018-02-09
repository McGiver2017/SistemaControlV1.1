<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <h4 class="title">Lista de Usuarios</h4> 
                  <a class="btn btn-info btn-fill btn-wd" data-toggle="modal" data-target="#myModal1" href="#pablo">
                  Agregar
                </a>               
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
          prop="date"
          label="Fecha"
          width="150">
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
              @click.native.prevent="deleteRow(scope.$index, tableData4)"
              type="text"
              size="small">
              Eliminar
            </el-button>
          </template>
        </el-table-column>
      </el-table>
        </div>
    </div>
    
    <!-- Mini Modal -->
                    <div class="modal fade modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Registrar Nuevo Usuario</h5>
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
  </div>
</template>

<script>
import { Loading } from 'element-ui';
  export default {
    beforeCreate: function () {
        this.loading = true;
        console.log("cargando");
    },
    created: function () {
        this.loading = false;
        console.log("finalizo de cargar");
        this.getUsuarios();
    },
    methods: {
      deleteRow(index, rows) {
        rows.splice(index, 1);
      }
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
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.loadingTabla = true  
            $('#myModal1').modal('hide')  
            this.mensajeInfo()        
            this.register()            
          } else {
            console.log('error submit!!');
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
            console.log(response.data)
            if (response.data=="Registrado") {
              this.mensajeSucces()
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
         console.log("cargando datos")
        var url = '/api/user'
        axios.get(url).then(response => {
          this.tableUsuarios = response.data
          this.loadingTabla = false
        }).catch(error => {
          console.log(error)
        })
      },
      mensajeSucces() {
        this.$notify({
          title: 'Success',
          message: 'This is a success message',
          type: 'success'
        });
      },
      mensajeWarning() {
        this.$notify({
          title: 'Error',
          message: 'This is a warning message',
          type: 'warning'
        });
      },
      mensajeInfo() {
        this.$notify.info({
          title: 'Info',
          message: 'This is an info message'
        });
      },
    }
  }
</script>