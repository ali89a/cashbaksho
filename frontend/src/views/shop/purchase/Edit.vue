<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">purchase Information</span>
        </div>
        <div class="card-body">
          <validation-observer ref="createpurchase">
            <b-form>
              <b-row>
                <b-col md="6">
                  <b-form-group label="Supplier name">
                    <select
                      v-model="form.supplier_id"
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
                        v-for="supplier in suppliers"
                        :value="supplier.id"
                        :selected="supplier.id == form.supplier_id"
                        :key="supplier.id"
                      >
                        {{ supplier.name }}
                      </option>
                    </select>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Product name">
                    <select
                      v-model="form.product_id"
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
                        v-for="product in products"
                        :key="product.id"
                        :value="product.id"
                        :selected="product.id == form.product_id"
                      >
                        {{ product.name }}
                      </option>
                    </select>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Amount">
                    <validation-provider
                      #default="{ errors }"
                      name="Amount"
                      rules="required"
                    >
                      <b-form-input
                        v-model="form.amount"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="amount"
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
                <b-col md="6">
                  <b-form-group label="Description">
                    <validation-provider
                      #default="{ errors }"
                      name="Description"
                    >
                      <b-form-textarea
                        v-model="form.description"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Description"
                        rows="3"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col cols="12">
                  <b-button
                    variant="primary"
                    type="submit"
                    @click.prevent="validationForm"
                  >
                    Update
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
  BFormInput, BFormGroup, BForm, BRow, BCol, BButton, BFormDatepicker,
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
    BFormDatepicker,
  },
  data() {
    return {
      form: {
        product_id: '',
        supplier_id: '',
        amount: '',
        date: '',
        description: '',
      },
      suppliers: [],
      products: [],
      required,
    }
  },
  created() {
    this.getpurchaseInfo()
    this.getsupplierData()
    this.getProducts()
  },
  methods: {
    getsupplierData() {
      axiosIns.get('api/v1/shop/supplier').then(response => {
        // console.log(response.data)
        this.suppliers = response.data
      })
    },
    getProducts() {
      axiosIns.get('api/v1/shop/product').then(response => {
        // console.log(response.data)
        this.products = response.data
      })
    },
    validationForm() {
      this.$refs.createpurchase.validate().then(success => {
        if (success) {
          axiosIns.put(`api/v1/shop/purchase/${this.$route.params.id}`, this.form).then(response => {
            // console.log(response)
            this.$nextTick(() => this.$refs.createpurchase.reset())
            this.$bvToast.toast(response.data.message, {
              title: 'Success',
              variant: 'success',
              solid: true,
            })
          })
        }
      })
    },
    getpurchaseInfo() {
      axiosIns.get(`api/v1/shop/purchase/${this.$route.params.id}`).then(response => {
        console.log(response.data)
        this.form.product_id = response.data.purchase_info.product_id
        this.form.supplier_id = response.data.purchase_info.supplier_id
        this.form.amount = response.data.purchase_info.amount
        this.form.date = response.data.purchase_info.date
        this.form.description = response.data.purchase_info.description
        console.log(this.form)
      })
    },
  },
}
</script>
