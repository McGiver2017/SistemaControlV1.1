<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 "> 
                <div class="card-block">
                    <h5 class="m-b-10">Gestión de Caja</h5>
                    <p class="text-muted m-b-10">Gestiona los datos de la caja que aperturara parax tu empresa.</p>
                    <ul class="breadcrumb-title line">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Gestión de Registro</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Cajas</a>
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
          prop="descripcion"
          label="Descripción"
          width="250">
        </el-table-column>
        <el-table-column
          prop="fecha_apertura"
          label="Apertura"
          width="120">
        </el-table-column>
        <el-table-column
          prop="fecha_cierre"
          label="Cierre"
          width="120">
        </el-table-column>
        <el-table-column
          prop="monto"
          label="Monto"
          width="120">
        </el-table-column>
        <el-table-column
          prop="estado"
          label="Estado"
          width="120">
        </el-table-column>
        <el-table-column
          fixed="right"
          label="Operaciones"
          width="120">
          <template slot-scope="scope">
            <el-button
              @click.native.prevent="veringresos(scope.row.id, tabledata)"
              type="text"
              size="small"
              class="btn btn-sm md"
              rel="tooltip" title="Ver Ingresos">
              <i class="fas fa-align-justify">

              </i>
            </el-button>
              <el-button
              @click.native.prevent="deleteRow(scope.row.id, tabledata)"
              type="text"
              size="small"
              class="btn btn-sm md"
              rel="tooltip" title="Cerrar Caja">
              <i class="fas fa-chevron-circle-down"></i>
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
                <h5 class="modal-title" id="exampleModalLongTitle">{{ this.operacion }} Caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> 
                  <div class="modal">
                      <i class="nc-icon nc-bulb-63"></i>
                  </div>
              </div>                                                       
                  <el-form :model="Form" status-icon :rules="rules2" ref="Form" label-width="120px" class="demo-ruleForm">
                    <div class="modal-body text-center">  
                      <el-form-item label="Descripción" prop="descripcion">
                        <el-input v-model="Form.descripcion"></el-input>
                      </el-form-item> 
                      <el-form-item label="Apertura" prop="fecha_apertura">
                        <el-date-picker type="date" v-model="Form.fecha_apertura" placeholder="Fecha de Apertura">
                      </el-date-picker>
                      </el-form-item> 
                      <el-form-item label="Fecha de cierre" prop="fecha_cierre">
                        <el-date-picker type="date" v-model="Form.fecha_cierre" placeholder="Fecha de Cierre">
                      </el-date-picker>
                      </el-form-item> 
                      <el-form-item label="Monto" prop="monto">
                        <el-input v-model="Form.monto"></el-input>
                      </el-form-item>
                    </div>
                    <div class="modal-footer">
                      <el-form-item>
                      <el-button type="primary" @click="submitForm('Form')" class="btn btn-link btn-simple md" ><i class="fas fa-save"></i></el-button>
                      <el-button @click="resetForm('Form')" class="btn btn-link btn-simple md" ><i class="fas fa-sync"></i></el-button>
                      <el-button  class="btn btn-link btn-simple md" data-dismiss="modal"><i class="fas fa-times"></i></el-button>                                    
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
        id: "",
        descripcion: "",
        fecha_apertura: "",
        fecha_cierre: "",
        monto: ""
      },
      rules2: {
        descripcion: [{ validator: checktext, trigger: "blur" }],
        monto: [{ validator: checktext, trigger: "blur" }],
        direccion: [{ validator: checktext, trigger: "blur" }]
      }
    };
  },
  methods: {
    veringresos(index, rows){
      this.$router.push('/GestionRegistro/caja/' + index)
    },
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
      var url = "/api/caja";
      axios
        .post(url, {
          descripcion: this.Form.descripcion,
          fecha_apertura: this.Form.fecha_apertura,
          fecha_cierre: this.Form.fecha_cierre,
          monto: this.Form.monto
        })
        .then(response => {
          console.log(response);
          if (response.data == "Registrado") {
            this.mensajeSucces("Se registro correctamente :)");
            this.getData();
            this.loadingTabla = false;
            this.resetForm("Form");
          } else {
            if (response.data == "caja abierta") {
              this.mensajeSucces("Hay una caja abierta. Cierre la caja para crear otra");
              this.getData();
              this.loadingTabla = false;
              this.resetForm("Form");
            } else {
              this.mensajeWarning();
              this.loadingTabla = false;
              this.resetForm("Form");
            }
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
      var url = "/api/proveedor/" + id;
      axios
        .put(url, {
          ruc: this.Form.ruc,
          razon_social: this.Form.razon_social,
          direccion: this.Form.direccion
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
      var url = "/api/caja/" + id;
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
      var url = "/api/caja";
      axios
        .get(url)
        .then(response => {
          this.tabledata = response.data;
          this.loadingTabla = false;
        })
        .catch(error => {});
    },
    getItem(id) {
      var url = "/api/proveedor/" + id + "/edit";
      axios
        .get(url)
        .then(response => {
          this.Form.id = response.data.id;
          this.Form.ruc = response.data.ruc;
          this.Form.razon_social = response.data.razon_social;
          this.Form.direccion = response.data.direccion;
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