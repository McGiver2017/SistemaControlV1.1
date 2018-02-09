<template>
     <div v-loading="loading">
       <div class="card">
        <div class="card-body">
          <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="120px" class="demo-ruleForm">        
            <el-form-item label="Email" prop="email">
              <el-input v-model="ruleForm2.email"></el-input>
            </el-form-item>
            <el-form-item label="Password" prop="pass">
              <el-input type="password" v-model="ruleForm2.pass" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="Confirm" prop="checkPass">
              <el-input type="password" v-model="ruleForm2.checkPass" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="Age" prop="age">
              <el-input v-model.number="ruleForm2.age"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="submitForm('ruleForm2')" >Submit</el-button>
              <el-button @click="resetForm('ruleForm2')" >Reset</el-button>
            </el-form-item>
          </el-form>
        </div>
      </div>
     </div>
</template>
<script>
  export default {
    beforeCreate: function () {
        this.loading = true;
        console.log("cargando");
    },
    created: function () {
        this.loading = false;
        console.log("finalizo de cargar");
    },
    data() {
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
          if (this.ruleForm2.checkPass !== '') {
            this.$refs.ruleForm2.validateField('checkPass');
          }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password again'));
        } else if (value !== this.ruleForm2.pass) {
          callback(new Error('Two inputs don\'t match!'));
        } else {
          callback();
        }
      };
      return {
        loading: '',
        ruleForm2: {
          pass: '',
          checkPass: '',
          age: '',          
          email: ''
        },
        rules2: {
          text: [
            { validator: checkEmail, trigger: 'blur' },
            {  type: 'text', message: 'Please input correct email address', trigger: 'blur,change' }
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
      };
    },
     beforeRouteUpdate (to, from, next) {
    const toDepth = to.path.split('/').length
    const fromDepth = from.path.split('/').length
    this.transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left'
    next()
  },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            alert('submit!');
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
        var dominio = this.$root.host.dominio
        var url = dominio + '/api/register'
        axios.post(url,
          {
            firstname: this.model.firstname,
            lastname: this.model.lastname,
            alias: this.model.alias,
            email: this.model.email,
            password: this.model.confirmPassword,
            ruc: this.sunat.ruc,
            razon_social: this.sunat.razon_social,
            direccion: this.sunat.direccion,
            nombre_comercial: this.sunat.nombre_comercial
          }).then(response => {
            this.login_in()
          }).catch(
            error => {
              console.log(error)
            }
          )
      },
    }
  }
</script>