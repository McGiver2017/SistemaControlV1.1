<template>
  <div>
    <div class="row">
      <div class="col-md-6">
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
                <div class="col-md-12">
                    <label>seleccione Producto</label>
                    <basic-select class="form-control" :options="productos" :selected-option="item" v-model="item" placeholder="select item"
                        @select="onSelect">
                    </basic-select>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <el-table class="table-shopping" :summary-method="getSummaries" show-summary style="width: 100%" :data="productsTable">
                                    <el-table-column class="td-price" min-width="50" label="Id">
                                        <template slot-scope="props">
                                            <strong>{{props.row.codigo}}</strong>
                                        </template>
                                    </el-table-column>

                                    <el-table-column class="td-price" min-width="100" label="Descripción">
                                        <template slot-scope="props">
                                            <strong>{{props.row.descripcion}}</strong>
                                        </template>
                                    </el-table-column>
                                    <el-table-column class="td-price" min-width="100" label="Precio">
                                        <template slot-scope="props">
                                            <small>&euro;</small> {{props.row.costo}}
                                        </template>
                                    </el-table-column>
                                    <el-table-column class="td-number td-quantity" min-width="100" label="Cantidad">
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
                                    <el-table-column class="td-number td-quantity" min-width="100" label="operaciones">
                                        <template slot-scope="props">
                                                
                                                 <el-button
                                                    @click.native.prevent="deleteRow(props.$index, productsTable)"
                                                    type="text"
                                                    size="small">
                                                    <i class="fas fa-times"></i>
                                                    </el-button>
                                            
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Total" min-width="100">
                                        <template slot-scope="props">
                                            <strong>
                                                <small>&euro;</small> {{props.row.total = props.row.cantidad * props.row.costo}}
                                                </strong>
                                        </template>
                                    </el-table-column>
                                </el-table>
                                <div class="container">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label>Gravado: {{ this.gravado}}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-left">IGV: {{ this.igv }}</label>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-info btn-fill btn-wd" @click="env_factura()">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
      </div>
      <div class="col-md-6">
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
                        <div class="col-md-12">
                            <h5>Seleccione Cliente</h5>
                            <model-select :options="clientes"
                                v-model="cliente"
                                placeholder="seleccione cliente">
                            </model-select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Seleccione Proveedor</h5>
                            <model-select :options="proveedores"
                                v-model="proveedor"
                                placeholder="seleccione Proveedor">
                            </model-select>
                        </div>
                    </div>
                    <hr>                    
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Seleccione Conductor</h5>
                            <model-select :options="conductores"
                                v-model="conductor"
                                placeholder="select Conductor">
                            </model-select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Seleccione Vehiculo</h5>
                            <model-select :options="vehiculos"
                                v-model="vehiculo"
                                placeholder="seleccione Vehiculo">
                            </model-select>
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
      productos: [],
      clientes: [],
      proveedores: [],
      conductores: [],
      vehiculos: [],
      product: {
        codigo: "",
        descripcion: "",
        cantidad: "",
        costo: ""
      },
      productsTable: [],

      total_general: "",
      gravado: "",
      igv: ""
    };
  },
  methods: {
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
        total: this.product.cantidad * this.product.costo
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
    env_factura: function () {
        var url = '/api/factura'
        axios.post(url,
          {
            num_doc: this.cliente.value,
            productos: this.productsTable,
            total: this.total_general,
            gravada: this.gravado,
            igv: this.igv,
            usuario_id: 1
          }).then(response => {
            console.log(response.data[2])
            this.$router.push('/GestionServicio/facturas')
          }).catch(
            error => {
              console.log(error)
            }
          )
      },
  }
};
</script>