<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <h4 class="title">Lista de Facturas</h4> 
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
          fixed
          prop="serie"
          label="Serie"
          width="100">
        </el-table-column>
        <el-table-column
          prop="tipo_doc"
          label="Cod Doc"
          width="100">
        </el-table-column>
        <el-table-column
          prop="correlativo"
          label="Correlativo"
          width="120">
        </el-table-column>
        <el-table-column
          prop="fecha_emision"
          label="Fecha de Emisión"
          width="120">
        </el-table-column>  
        <el-table-column
          prop="tipo_moneda"
          label="Tipo de Moneda"
          width="120">
        </el-table-column>
        <el-table-column
          prop="monto_total_venta"
          label="Monto Total"
          width="120">
        </el-table-column>       
        <el-table-column
          prop="estado_factura"
          label="Estado"
          width="150">
        </el-table-column>
        <el-table-column
          fixed="right"
          label="Operaciones"
          width="120">
          <template slot-scope="scope">
            <el-button
              @click.native.prevent="generar(scope.row.id, tabledata)"
              type="text"
              size="small">
              Factura
            </el-button>
            <el-button
              @click.native.prevent="envgenerar(scope.row.id, tabledata)"
              type="text"
              size="small">
              Enviar
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
      alert("voy a generar xml y pdf");
      location.target = "_blank";
      location.href = "/factura/" + index;
    },
    envgenerar(index, rows) {
      this.envfactura(index)
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
      var url = "/api/factura";
      axios
        .get(url)
        .then(response => {
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