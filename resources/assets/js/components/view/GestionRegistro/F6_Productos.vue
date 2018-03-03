<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <div class="card-block">
                    <h5 class="m-b-10">Gestión de Productos</h5>
                    <p class="text-muted m-b-10">Gestiona los datos de los productos que ofrece tu empresa.</p>
                    <ul class="breadcrumb-title line">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Gestión de Registro</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Productos</a>
                        </li>
                    </ul>
                  </div>
                <br>
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
          prop="cod_producto"
          label="Codigo de Producto"
          width="200">
        </el-table-column>
        <el-table-column
          prop="descripcion"
          label="Descripcion"
          width="240">
        </el-table-column>
        <el-table-column
          prop="unidad"
          label="Unidad"
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
              size="small"
              class="btn btn-sm md">
              <i class="fas fa-edit"></i>
            </el-button>
              <el-button
              @click.native.prevent="deleteRow(scope.row.id, tabledata)"
              type="text"
              size="small"
              class="btn btn-sm md">
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
                <h5 class="modal-title" id="exampleModalLongTitle">{{ this.operacion }} Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> 
                  <div class="modal">
                      <i class="nc-icon nc-bulb-63"></i>
                  </div>
              </div>                                                       
                  <el-form :model="Form" status-icon :rules="rules2" ref="Form" label-width="120px" class="demo-ruleForm">
                    <div class="modal-body text-center">  
                      <el-form-item label="Codigo de producto" prop="cod_producto">
                        <el-input v-model="Form.cod_producto"></el-input>
                      </el-form-item> 
                      <el-form-item label="Descripción" prop="descripcion">
                        <el-input v-model="Form.descripcion"></el-input>
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
import { Loading } from "element-ui";
export default {
  beforeCreate: function() {
    this.loading = true;
  },
  created: function() {
    this.loading = false;
    this.getData();
  },
  data() {
    var checktext = (rule, value, callback) => {
      if (!value) {
        return callback(new Error("Please input the field"));
      }
      setTimeout(() => {
        callback();
      }, 1000);
    };
    return {
      operacion: "Registrar Nuevo",
      loadingTabla: true,
      loading: true,
      fullscreenLoading: false,
      tabledata: [],
      Form: {
        id: '',
        cod_producto: '',
        descripcion: '',
        unidad: ''
      },
      rules2: {
        cod_producto: [{ validator: checktext, trigger: "blur" }],
        descripcion: [{ validator: checktext, trigger: "blur" }],
        }
    };
  },
  methods: {
    seendDataForm() {
      if (this.operacion == "Registrar Nuevo") {
        $("#WindowsForm").modal("hide");
        this.register();
      } else {
        $("#WindowsForm").modal("hide");
        this.update();
      }
    },
    agregar() {
      this.operacion = "Registrar Nuevo";
      $("#WindowsForm").modal("show");
    },
    deleteRow(index, rows) {
      this.mensajeInfo();
      this.delete(index);
    },
    editRow(index, rows) {
      this.operacion = "Editar";
      this.getItem(index);
      $("#WindowsForm").modal("show");
    },
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          this.loadingTabla = true;
          this.mensajeInfo();
          this.seendDataForm();
        } else {
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    register() {
      this.boton = "Registrandose";
      var url = "/api/producto";
      axios
        .post(url, {
          cod_producto: this.Form.cod_producto,
          descripcion: this.Form.descripcion        
        })
        .then(response => {
          if (response.data == "Registrado") {
            this.mensajeSucces("Se registro correctamente :)");
            this.getData();
            this.loadingTabla = false;
            this.resetForm("Form");
          } else {
            this.mensajeWarning();
            this.loadingTabla = false;
            this.resetForm("Form");
          }
        })
        .catch(e => {
          this.mensajeWarning();
          this.loadingTabla = false;
          this.resetForm("Form");
        });
    },
    update(id) {
      this.boton = "Registrandose";
      id = this.Form.id;
      var url = "/api/producto/" + id;
      axios
        .put(url, {
          cod_producto: this.Form.cod_producto,
          descripcion: this.Form.descripcion,
          unidad: this.Form.unidad
        })
        .then(response => {
          if (response.data == "Actualizado") {
            this.mensajeSucces(
              "Actualización completada satisfactoriamente :)"
            );
            this.getData();
            this.loadingTabla = false;
            this.resetForm("Form");
          } else {
            this.mensajeWarning();
            this.loadingTabla = false;
            this.resetForm("Form");
          }
        })
        .catch(e => {
          this.mensajeWarning();
          this.loadingTabla = false;
          this.resetForm("Form");
        });
    },
    delete(id) {
      var url = "/api/producto/" + id;
      axios
        .delete(url)
        .then(response => {
          if (response.data == "Eliminado") {
            this.mensajeSucces("Se elimino satisfactoriamente el elemento :(");
            this.getData();
            this.loadingTabla = false;
            this.resetForm("Form");
          } else {
            this.mensajeWarning();
            this.loadingTabla = false;
            this.resetForm("Form");
          }
        })
        .catch(e => {
          this.mensajeWarning();
          this.loadingTabla = false;
          this.resetForm("Form");
        });
    },
    getData() {
      var url = "/api/producto";
      axios
        .get(url)
        .then(response => {
          this.tabledata = response.data;
          this.loadingTabla = false;
        })
        .catch(error => {});
    },
    getItem(id) {
      var url = "/api/producto/" + id + "/edit";
      axios
        .get(url)
        .then(response => {
          this.Form.id = response.data.id
          this.Form.cod_producto = response.data.cod_producto
          this.Form.descripcion = response.data.descripcion
          this.Form.unidad = response.data.unidad
        })
        .catch(error => {});
    },
    mensajeSucces(mensaje) {
      this.$notify({
        title: "Success",
        message: mensaje,
        type: "success"
      });
    },
    mensajeWarning() {
      this.$notify({
        title: "Error",
        message: "Oh no! ah ocurrido un error :(",
        type: "warning"
      });
    },
    mensajeInfo() {
      this.$notify.info({
        title: "Info",
        message: "Procesando su petición"
      });
    }
  }
};
</script>