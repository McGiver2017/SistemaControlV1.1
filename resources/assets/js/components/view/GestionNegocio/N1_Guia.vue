<template>
    <div>
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
                                        <h5>Seleccione Cliente</h5>
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
                                        <h5>Punto de llegada <button class="btn btn-round btn-sm" v-on:click="usardefecto" >Dirección de Cliente</button></h5>
                                        <input class="form-control" type="text" placeholder="Ingrese Monto" v-model="transporte.llegada">
                                        
                                    
                                        </div>
                                </div>
                            </div>


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
    usardefecto: function(event) {
      this.clientes.filter(cliente => {
        if ((cliente.value == this.$route.params.id)) {
            console.log(cliente.direccion)

          this.transporte.llegada = cliente.direccion;
        }
      });
    },
    changedValue: function(value) {
      console.log(value);
      this.proveedores.filter(proveedor => {
        if ((proveedor.value = value)) {
          this.transporte.partida = proveedor.direccion;
        }
      });
      console.log("cambiando");
      //receive the value selected (return an array if is multiple)
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
          sums[index] = `€ ${sum}`;
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
          sums[index] = `€ ${sum}`;
          this.total_general = sum;
        }
      });
      return sums;
    },
    env_factura: function() {
      var url = "/api/factura";
      axios
        .post(url, {
          num_doc: this.cliente.value,
          productos: this.productsTable,
          total: this.total_general,
          gravada: this.gravado,
          igv: this.igv,
          usuario_id: 1
        })
        .then(response => {
          console.log(response.data[2]);
          this.$router.push("/GestionServicio/facturas");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>