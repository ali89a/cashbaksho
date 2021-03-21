<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Transaction Information</span>
        </div>
        <div class="card-body">
          <validation-observer ref="createtransaction">
            <b-form>
              <b-row>
                <b-col md="6">
                  <b-form-group label="Type">
                    <select
                      v-model="form.type"
                      class="form-control"
                      @change="getUser"
                    >
                      <option value="customer">
                        Customer
                      </option>
                      <option value="supplier">
                        Supplier
                      </option>
                    </select>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Name">
                    <select
                      v-model="form.id"
                      class="form-control"
                      required
                    >
                      <option
                        value=""
                        selected
                      >
                        Choose one
                      </option>
                      <option
                        v-for="user in typeUsers"
                        :value="user.id"
                        :key="user.id"
                      >
                        {{ user.name }}
                      </option>
                    </select>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Given">
                    <validation-provider
                      #default="{ errors }"
                      name="given"
                    >
                      <b-form-input
                        v-model="form.given"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Given amount"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Taken">
                    <validation-provider
                      #default="{ errors }"
                      name="taken"
                    >
                      <b-form-input
                        v-model="form.taken"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="Taken amount"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <label for="example-datepicker">Choose a date</label>
                  <b-form-datepicker
                    id="example-datepicker"
                    v-model="form.date"
                    class="mb-1"
                  />
                </b-col>
                <b-col cols="12">
                  <b-button
                    variant="primary"
                    type="submit"
                    @click.prevent="validationForm"
                  >
                    Submit
                  </b-button>
                </b-col>
              </b-row>
            </b-form>
          </validation-observer>
        </div>
      </div>
      <!-- form -->
    </b-col>
  </b-row>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BFormInput, BFormGroup, BForm, BRow, BCol, BButton,
} from 'bootstrap-vue'
import { required } from '@validations'
import axiosIns from '@/libs/axios'

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    BFormInput,
    BFormGroup,
    BForm,
    BRow,
    BCol,
    BButton,
  },
  data() {
    return {
      form: {
        type: 'customer',
        id: '',
        given: '',
        taken: '',
        date: '',
      },
      typeUsers: [],
      required,
    }
  },
  mounted() {
    this.getCustomerData()
  },
  methods: {
    validationForm() {
      this.$refs.createtransaction.validate().then(success => {
        if (success) {
          axiosIns.post('api/v1/shop/transaction', this.form).then(response => {
            // console.log(response)
            // first reset your form values
            for (const key in this.form) {
              this.form[key] = ''
            }
            // then do this to reset your ValidationObserver
            this.$nextTick(() => this.$refs.createtransaction.reset())
            this.$bvToast.toast('transaction created successfully.', {
              title: 'Success',
              variant: 'success',
              solid: true,
            })
          }).catch(error => {
            this.$refs.createtransaction.setErrors(error.response.data.errors)
          })
        }
      })
    },
    getUser() {
      if (this.form.type == 'customer') {
        this.getCustomerData()
      } else {
        this.getSupplierData()
      }
    },
    getCustomerData() {
      axiosIns.get('api/v1/shop/customer').then(response => {
        // console.log(response.data)
        this.typeUsers = response.data
      })
    },
    getSupplierData() {
      axiosIns.get('api/v1/shop/supplier').then(response => {
        // console.log(response.data)
        this.typeUsers = response.data
      })
    },
  },
}
</script>
