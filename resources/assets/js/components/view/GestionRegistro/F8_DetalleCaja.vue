<template>
  <div v-loading="loading">
      <div class="card">
        <div class="card-header">
            <div class="row">
              <div class="col-md-12 ">
                <h4 class="title">Transporte</h4>            
              </div>
              <div class="col-md-6">
                <h5>Descripcion: {{ this.datos.descripcion }}</h5>
                <h5>Fecha de apertura: {{ this.datos.fecha_apertura }}</h5>
                <h5>Fecha de cierre: {{ this.datos.fecha_cierre }}</h5>
              </div>
              <div class="col-md-6">                
                <h5>Monto en Caja: S/. {{ this.datos.monto }}</h5>
                <h5>Estado: {{ this.datos.estado }}</h5>
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
              prop="monto_declarado"
              label="Declarado"
              width="100">
            </el-table-column>
            <el-table-column
              prop="estado"
              label="Estado"
              width="180">
            </el-table-column>
            <el-table-column
              prop="tipo_documento"
              label="Categoria"
              width="90">
            </el-table-column> 
            <el-table-column
              prop="numero_documento"
              label="Documento"
              width="170">
            </el-table-column> 
            <el-table-column
              prop="tipo_responsable"
              label="Reponsable"
              width="100">
            </el-table-column> 
            <el-table-column
              prop="responsable"
              label="Placa/DNI"
              width="100">
            </el-table-column> 
            <el-table-column
              prop="tipo"
              label="Movimiento"
              width="100">
            </el-table-column>        
            <el-table-column
              prop="monto"
              label="Monto"
              width="80">
            </el-table-column>
            <el-table-column
              prop="saldo_caja"
              label="Saldo de caja"
              width="120">
            </el-table-column>
            <el-table-column
              prop="saldo_final"
              label="Saldo Final de caja"
              width="150">
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
    this.getDatos();
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
      datos: [],
      Form: {
        id: "",
        num_doc: "",
        descripcion: "",
        monto: ""
      },
      rules2: {
        cod_producto: [{ validator: checktext, trigger: "blur" }],
        descripcion: [{ validator: checktext, trigger: "blur" }]
      }
    };
  },
  methods: {
    deleteRow(index, rows) {
      this.mensajeInfo();
      this.delete(index);
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
    generar(index, rows) {
      location.target = "_blank";
      location.href = "/factura/" + index;
    },
    generarguia(index, rows) {
      location.target = "_blank";
      location.href = "/guia/" + index;
    },
    envgenerar(index, rows) {
      this.envfactura(index);
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
    register() {
      this.mensajeInfo();
      var url = "/api/detalletransporte";
      axios
        .post(url, {
          transporte_id: 1,
          num_doc: this.Form.num_doc,
          descripcion: this.Form.descripcion,
          monto: this.Form.monto
        })
        .then(response => {
          if (response.data == "Registrado") {
            this.mensajeSucces("Se registro correctamente :)");
            (this.Form.num_doc = ""),
              (this.Form.descripcion = ""),
              (this.Form.monto = "");
            this.getData();
            this.loadingTabla = false;
          } else {
            this.mensajeWarning();
            this.loadingTabla = false;
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
      var url = "/api/detalletransporte/" + id;
      axios
        .delete(url)
        .then(response => {
          if (response.data == "Eliminado") {
            this.mensajeSucces("Se elimino satisfactoriamente el elemento :(");
            this.getData();
            this.loadingTabla = false;
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
    getDatos() {
      var index = this.$route.params.id;
      var url = "/api/caja/" + index;
      axios
        .get(url)
        .then(response => {
          console.log(response.data);
          this.datos = response.data;
        })
        .catch(error => {});
    },
    getData() {
      var index = this.$route.params.id;
      var url = "/api/detallecaja/" + index;
      axios
        .get(url)
        .then(response => {
          console.log(response.data);
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
          var msj = response.data;
          if (msj) {
            var mensaje = msj.description + " ( Code: " + msj.code + ")";
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