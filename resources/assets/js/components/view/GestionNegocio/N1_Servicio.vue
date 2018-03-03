<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 ">
                                <h4 class="title">Datos de Envio

                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Seleccione Cliente</h5>
                                <el-select v-model="cliente" filterable placeholder="Select" @change="agregarDireccion" >
                                            <el-option v-for="item in clientes" :key="item.value" :label="item.text" :value="item.value">
                                            </el-option>
                                </el-select>
                            </div>
                            <div class="col-md-6">
                                <h5>Seleccione Tipo de Factura</h5>
                                <el-select v-model="tipo_factura" filterable placeholder="Select">
                                            <el-option v-for="item in tipo_facturas" :key="item.value" :label="item.text" :value="item.value">
                                            </el-option>
                                        </el-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>seleccione Producto</label>
                                <basic-select class="form-control" :options="productos" :selected-option="item" v-model="item" placeholder="select item"
                                    @select="onSelect">
                                </basic-select>
                                <div v-if="this.mostrar">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Codigo</label>
                                            <input class="form-control" type="text" placeholder="Ingrese descripción" v-model="product.codigo" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Descripción</label>
                                            <input class="form-control" type="text" placeholder="Ingrese descripción" v-model="product.descripcion" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cantidad</label>
                                            <input class="form-control" type="text" placeholder="Ingrese cantidad" v-model="product.cantidad">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Costo por unidad</label>
                                            <input class="form-control" type="text" placeholder="Ingrese costo por unidad" v-model="product.costo">

                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <button class="btn btn-info btn-fill" @click="addproduct()">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <el-table class="table-shopping" :summary-method="getSummaries" show-summary style="width: 100%" :data="productsTable">
                                                <el-table-column class="td-price" min-width="50" label="Id">
                                                    <template slot-scope="props">
                                                        <strong>{{props.row.codigo}}</strong>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column class="td-price" min-width="120" label="Descripción">
                                                    <template slot-scope="props">
                                                        <strong>{{props.row.descripcion}}</strong>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column class="td-price" min-width="100" label="Precio">
                                                    <template slot-scope="props">
                                                        <small>S/.</small> {{props.row.costo}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column class="td-number td-quantity text-center" min-width="100" label="Cantidad">
                                                    <template slot-scope="props">
                                                        {{props.row.cantidad}}
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm" @click="props.row.cantidad > 0 ? props.row.cantidad-- : 0">
                                                                <i class="nc-icon nc-simple-delete"></i>
                                                            </button>
                                                            <button class="btn btn-sm" @click="props.row.cantidad++">
                                                                <i class="nc-icon nc-simple-add"></i>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column class="td-number td-quantity" min-width="120" label="Impuesto">
                                                    <template slot-scope="props">
                                                        <el-radio-group v-model="props.row.tip_afe_igv">
                                                            <el-radio :label="10">C</el-radio>
                                                            <el-radio :label="20">S</el-radio>
                                                        </el-radio-group>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column class="td-number td-quantity" min-width="100" label="Oper.">
                                                    <template slot-scope="props">
                                                        <el-button type="text" @click.native.prevent="deleteRow(props.$index, productsTable)" size="small">
                                                            <i class="fas fa-times"></i>
                                                        </el-button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="Total" min-width="100">
                                                    <template slot-scope="props">
                                                        <strong>
                                                            <small>S/.</small> {{props.row.total = props.row.cantidad * props.row.costo}}
                                                        </strong>
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 ">
                                <h4 class="title">Datos adicionales </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Modalidad de Traslado</h5>
                                        <el-select v-model="ModalidadTraslado" filterable placeholder="Select">
                                            <el-option v-for="item in ModalidadTraslados" :key="item.value" :label="item.text" :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Seleccione Proveedor</h5>
                                        <el-select v-model="proveedor" filterable placeholder="Select" @change="changedValue" @selected="changedLabel">
                                            <el-option v-for="item in proveedores" :key="item.value" :label="item.text" :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Seleccione Conductor</h5>
                                        <el-select v-model="conductor" filterable placeholder="Select" @change="changedValue" @selected="changedLabel">
                                            <el-option v-for="item in conductores" :key="item.value" :label="item.text" :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Seleccione Vehiculo</h5>
                                        <el-select v-model="vehiculo" filterable placeholder="Select" @change="changedValue" @selected="changedLabel">
                                            <el-option v-for="item in vehiculos" :key="item.value" :label="item.text" :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Monto</h5>
                                        <input class="form-control" type="text" placeholder="Ingrese Monto" v-model="transporte.ingreso">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Fecha de Envio</h5>
                                        <el-date-picker type="date" v-model="transporte.fechaEnvio" placeholder="Fecha de Embarque">
                                        </el-date-picker>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Punto de Partida</h5>
                                        <input class="form-control" type="text" placeholder="Ingrese Monto" v-model="transporte.partida">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Punto de llegada </h5>
                                        <input class="form-control" type="text" placeholder="Ingrese Monto" v-model="transporte.llegada">
                                        
                                    
                                        </div>
                                </div>
                            </div>
                         <button class="btn btn-info btn-fill btn-wd" @click="env_factura()">
                         Guardar
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { BasicSelect } from "vue-search-select";
import { Table, TableColumn } from "element-ui";
import { ModelSelect } from "vue-search-select";
export default {
  created: function() {
    this.getProducto();
    this.getCliente();
    this.getProveedor();
    this.getVehiculo();
    this.getConductor();
  },
  components: {
    BasicSelect,
    ModelSelect
  },
  data() {
    return {
      mostrar: false,
      tipo_facturas: [
          {
              value: "1", text:"Serie F001"
          },
          {
              value: "2", text:"Serie F002"
          }
      ],
      options: [
        { value: "1", text: "aa" + " - " + "1" },
        { value: "2", text: "ab" + " - " + "2" },
        { value: "3", text: "bc" + " - " + "3" },
        { value: "4", text: "cd" + " - " + "4" },
        { value: "5", text: "de" + " - " + "5" }
      ],
      item: {
        value: "",
        text: ""
      },
      cliente: {
        value: "",
        text: ""
      },
      proveedor: {
        value: "",
        text: ""
      },
      vehiculo: {
        value: "",
        text: ""
      },
      conductor: {
        value: "",
        text: ""
      },
      ModalidadTraslado: {
        value: "",
        text: ""
      },
      tipo_factura: {
        value: "",
        text: ""
      },
      productos: [],
      clientes: [],
      proveedores: [],
      conductores: [],
      vehiculos: [],
      ModalidadTraslados: [
        {
          text: "Transporte Público",
          value: "01"
        },
        {
          text: "Transporte Privado",
          value: "02"
        }
      ],
      product: {
        codigo: "",
        descripcion: "",
        cantidad: "",
        costo: ""
      },
      transporte: {
        ingreso: "",
        fechaEnvio: "",
        partida: "",
        llegada: ""
      },
      productsTable: [],

      total_general: "",
      gravado: "",
      igv: ""
    };
  },
  methods: {
    changedValue: function(value) {
      console.log(value);
      this.proveedores.filter(proveedor => {
        if ((proveedor.value = value)) {
          this.transporte.llegada = proveedor.direccion;
        }
      });
      console.log("cambiando");
      //receive the value selected (return an array if is multiple)
    },
    agregarDireccion: function(value) {
      this.clientes.filter(cliente => {
        if (cliente.value == value) {
          console.log(cliente.direccion);

          this.transporte.partida = cliente.direccion;
        }
      });
    },
    changedLabel: function(label) {
      //receive the label of the value selected (the label shown in the select, or an empty string)
      console.log("data");
    },
    onSelectCliente: function(cliente) {
      this.llegada = "ACA";
    },
    deleteRow(index, rows) {
      rows.splice(index, 1);
    },
    onSelect(item) {
      this.item = item;
      this.product.codigo = item.value;
      this.product.descripcion = item.text;
      this.mostrar = true
    },
    reset() {
      this.item = {};
    },
    selectOption() {
      // select option from parent component
      this.item = this.options[0];
    },
    getProducto() {
      var url = "/api/getproducto";
      axios
        .get(url)
        .then(response => {
          this.productos = response.data;
          console.log(this.productos);
        })
        .catch(error => {
          console.log(error);
        });
    },
    getCliente() {
      var url = "/api/getcliente";
      axios
        .get(url)
        .then(response => {
          this.clientes = response.data;
          console.log(this.productos);
        })
        .catch(error => {
          console.log(error);
        });
    },
    getProveedor() {
      var url = "/api/getproveedor";
      axios
        .get(url)
        .then(response => {
          this.proveedores = response.data;
          console.log(this.productos);
        })
        .catch(error => {
          console.log(error);
        });
    },
    getConductor() {
      var url = "/api/getconductor";
      axios
        .get(url)
        .then(response => {
          this.conductores = response.data;
          console.log(this.productos);
        })
        .catch(error => {
          console.log(error);
        });
    },
    getVehiculo() {
      var url = "/api/getvehiculo";
      axios
        .get(url)
        .then(response => {
          this.vehiculos = response.data;
          console.log(this.productos);
        })
        .catch(error => {
          console.log(error);
        });
    },
    addproduct: function() {
      this.productsTable.push({
        codigo: this.product.codigo,
        descripcion: this.product.descripcion,
        cantidad: this.product.cantidad,
        costo: this.product.costo,
        total: this.product.cantidad * this.product.costo,
        tip_afe_igv: 10,
        igv: 18
      });
      this.product.codigo = "";
      this.product.descripcion = "";
      this.product.cantidad = "";
      this.product.costo = "";
      this.mostrar = false
    },
    getSummaries(param) {
      const { columns } = param;
      const sums = [];
      columns.forEach((column, index) => {
        if (index === 0) {
          sums[index] = "Total";
        } else if (index < columns.length - 1) {
          sums[index] = "";
        } else {
          let sum = 0;
          this.productsTable.forEach(obj => {
            sum += obj.cantidad * obj.costo;
          });
          sums[index] = `S/. ${sum}`;
          this.total_general = sum;
          this.gravado = this.total_general * 100 / 118;
          this.igv = this.gravado * 18 / 100;
        }
      });
      return sums;
    },
    getGravado(param) {
      const { columns } = param;
      const sums = [];
      columns.forEach((column, index) => {
        if (index === 0) {
          sums[index] = "Total";
        } else if (index < columns.length - 1) {
          sums[index] = "";
        } else {
          let sum = 0;
          this.productsTable.forEach(obj => {
            sum += obj.cantidad * obj.costo;
          });
          sums[index] = `S/. ${sum}`;
          this.total_general = sum;
        }
      });
      return sums;
    },
    env_factura: function() {
      this.mensajeInfo();
      var url = "/api/factura";
      axios
        .post(url, {
          num_doc: this.cliente,
          productos: this.productsTable,
          total: this.total_general,
          gravada: this.gravado,
          igv: this.igv,
          usuario_id: this.$cookie.get("id"),
          conductor: this.conductor,
          vehiculo: this.vehiculo,
          proveedor: this.proveedor,
          ModalidadTraslado: this.ModalidadTraslado,
          transporte: this.transporte,
          tipo_factura: this.tipo_factura
        })
        .then(response => {
          console.log(response.data[2]);
          this.mensajeSucces("Se Genero correctamente la factura");
          this.$router.push("/GestionServicio/facturas");
        })
        .catch(error => {
            this.mensajeWarning();
          console.log(error);
        });
    },
    mensajeSucces(mensaje) {
      this.$notify({
        title: "Success",
        message: mensaje,
        type: "success"
      });
    },
    mensajeInfo() {
      this.$notify.info({
        title: "Info",
        message: "Procesando su petición"
      });
    },
    mensajeWarning() {
      this.$notify({
        title: "Error",
        message: "Oh no! ah ocurrido un error :(",
        type: "warning"
      });
    },
  }
};
</script>