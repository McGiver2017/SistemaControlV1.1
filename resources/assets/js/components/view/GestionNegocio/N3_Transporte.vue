<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <h4 class="title">Lista de Facturas</h4>               
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
          prop="conductor"
          label="Conductor"
          width="150">
        </el-table-column>        
        <el-table-column
          prop="vehiculo"
          label="Vehiculo"
          width="150">
        </el-table-column>
        <el-table-column
          prop="fecha_envio"
          label="F. de Envio"
          width="120">
        </el-table-column>
        <el-table-column
          prop="ingresos"
          label="Monto Inicial"
          width="150">
        </el-table-column>      
        <el-table-column
          prop="egresos"
          label="Egresos"
          width="150">
        </el-table-column>
        <el-table-column
          prop="estado"
          label="Estado"
          width="150">
        </el-table-column>
        <el-table-column
          fixed="right"
          label="Operaciones"
          width="200">
          <template slot-scope="scope">
            <el-button
              @click.native.prevent="veringresos(scope.row.id, tabledata)"
              type="text"
              size="small"
              class="btn btn-sm">
              Ver Ingresos
            </el-button>
          </template>
        </el-table-column>
      </el-table>
        </div>
    </div>
    

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
        cod_producto: "",
        descripcion: "",
        unidad: ""
      },
      rules2: {
        cod_producto: [{ validator: checktext, trigger: "blur" }],
        descripcion: [{ validator: checktext, trigger: "blur" }]
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
    generar(index, rows) {
      location.target = "_blank";
      location.href = "/factura/" + index;
    },
    veringresos(index, rows){
      this.$router.push('/GestionServicio/transporte/' + index)
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
      var url = "/api/transporte";
      axios
        .get(url)
        .then(response => {
          console.log(response.data)
          this.tabledata = response.data;
          this.loadingTabla = false;
        })
        .catch(error => {});
    },
    envfactura(index) {
      this.mensajeInfo();
      var url = "/api/envfactura/" + index;
      axios
        .get(url)
        .then(response => {
          var msj = response.data
          if (msj) {
            var mensaje =  msj.description +" ( Code: "+msj.code+")"
            this.$notify({
              title: "Success",
              message: mensaje,
              type: "success"
            });
          }
        })
        .catch(error => {});
    },
    getItem(id) {
      var url = "/api/producto/" + id + "/edit";
      axios
        .get(url)
        .then(response => {
          this.Form.id = response.data.id;
          this.Form.cod_producto = response.data.cod_producto;
          this.Form.descripcion = response.data.descripcion;
          this.Form.unidad = response.data.unidad;
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