<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <h4 class="title">Lista de Proveedores</h4> 
                  <button class="btn btn-info btn-fill btn-wd" @click="agregar()">
                  Agregar
                </button>               
              </div>
            </div>
        </div>
        <div class="card-body">
            <el-table
            v-loading="loadingTabla"
        :data="tabledata"
        style="width: 100%"
        max-height="250">
        <el-table-column
          fixed
          prop="id"
          label="Id"
          width="50">
        </el-table-column>
        <el-table-column
          prop="ruc"
          label="Nº de Ruc"
          width="120">
        </el-table-column>
        <el-table-column
          prop="razon_social"
          label="Razon Social"
          width="240">
        </el-table-column>
        <el-table-column
          prop="direccion"
          label="Direccion"
          width="240">
        </el-table-column>  
        <el-table-column
          fixed="right"
          label="Operaciones"
          width="120">
          <template slot-scope="scope">
            <el-button
              @click.native.prevent="editRow(scope.row.id, tabledata)"
              type="text"
              size="small">
              <i class="fas fa-edit"></i>
            </el-button>
              <el-button
              @click.native.prevent="deleteRow(scope.row.id, tabledata)"
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
                  <el-form :model="Form" status-icon :rules="rules2" ref="Form" label-width="120px" class="demo-ruleForm">
                    <div class="modal-body text-center">  
                      <el-form-item label="Nº de Ruc" prop="ruc">
                        <el-input v-model="Form.ruc"></el-input>
                      </el-form-item> 
                      <el-form-item label="Razón Social" prop="razon_social">
                        <el-input v-model="Form.razon_social"></el-input>
                      </el-form-item> 
                      <el-form-item label="Dirección" prop="direccion">
                        <el-input v-model="Form.direccion"></el-input>
                      </el-form-item> 
                    </div>
                    <div class="modal-footer">
                      <el-form-item>
                      <el-button type="primary" @click="submitForm('Form')" class="btn btn-link btn-simple" ><i class="fas fa-save"></i></el-button>
                      <el-button @click="resetForm('Form')" class="btn btn-link btn-simple" ><i class="fas fa-sync"></i></el-button>
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
        this.getData();
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
      return {
        operacion: 'Registrar Nuevo',
        loadingTabla: true,
        loading: true,
        fullscreenLoading: false,
        tabledata: [],
        Form: {
          id: '',
          ruc: '',
          razon_social: '',
          direccion: ''
        },
        rules2: {
          ruc: [
            { validator: checktext, trigger: 'blur' }
          ],
          razon_social: [
            { validator: checktext, trigger: 'blur' }
          ],
          direccion: [
            { validator: checktext, trigger: 'blur' }
          ],
          
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
          $('#WindowsForm').modal('hide') 
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
        this.getItem(index)
        $('#WindowsForm').modal('show')  
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
        var url = '/api/proveedor'
        axios.post(url,
          {
            ruc: this.Form.ruc,
            razon_social: this.Form.razon_social,
            direccion: this.Form.direccion
          }).then(response => {
            if (response.data=="Registrado") {
              this.mensajeSucces("Se registro correctamente :)")
              this.getData()
              this.loadingTabla = false
              this.resetForm('Form')
            }     
            else{
              this.mensajeWarning()
              this.loadingTabla = false
              this.resetForm('Form')
            }       
          }).catch((e) => {
            this.mensajeWarning()
            this.loadingTabla = false
            this.resetForm('Form')
          })
      },
      update (id) {        
        this.boton = 'Registrandose'
        id = this.Form.id
        var url = '/api/proveedor/'+ id
        axios.put(url,
          {
            ruc: this.Form.ruc,
            razon_social: this.Form.razon_social,
            direccion: this.Form.direccion
          }).then(response => {
            if (response.data=="Actualizado") {
              this.mensajeSucces("Actualización completada satisfactoriamente :)")
              this.getData()
              this.loadingTabla = false
              this.resetForm('Form')
            }     
            else{
              this.mensajeWarning()
              this.loadingTabla = false
              this.resetForm('Form')
            }       
          }).catch((e) => {
            this.mensajeWarning()
            this.loadingTabla = false
            this.resetForm('Form')
          })
      },
       delete (id) { 
        var url = '/api/proveedor/'+ id
        axios.delete(url).then(response => {
            if (response.data=="Eliminado") {
              this.mensajeSucces("Se elimino satisfactoriamente el elemento :(")
              this.getData()
              this.loadingTabla = false
              this.resetForm('Form')
            }     
            else{
              this.mensajeWarning()
              this.loadingTabla = false
              this.resetForm('Form')
            }       
          }).catch((e) => {
            this.mensajeWarning()
            this.loadingTabla = false
            this.resetForm('Form')
          })
      },
       getData () {
        var url = '/api/proveedor'
        axios.get(url).then(response => {
          this.tabledata = response.data
          this.loadingTabla = false
        }).catch(error => {
        })
      },
      getItem (id) {
        var url = '/api/proveedor/'+id+'/edit'
        axios.get(url).then(response => {
          this.Form.id = response.data.id
          this.Form.ruc = response.data.ruc
          this.Form.razon_social = response.data.razon_social
          this.Form.direccion = response.data.direccion
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