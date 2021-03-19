<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">EMI Information</span>
        </div>
        <div class="card-body">
          <validation-observer ref="createemi">
            <b-form>
              <b-row>
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
                        :value="product.id"
                      >
                        {{ product.name }}
                      </option>
                    </select>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Customer Name">
                    <validation-provider
                      #default="{ errors }"
                      name="Customer Name"
                    >
                      <b-form-input
                        v-model="form.customer_name"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="Customer Name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Total amount">
                    <validation-provider
                      #default="{ errors }"
                      name="Total amount"
                    >
                      <b-form-input
                        v-model="form.total_amount"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="Total amount"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Total Installment">
                    <validation-provider
                      #default="{ errors }"
                      name="Total Installment"
                    >
                      <b-form-input
                        v-model="form.total_installment"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="Total Installment"
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
        product_id: '',
        customer_name: '',
        total_amount: '',
        total_installment: '',
      },
      products: '',
      required,
    }
  },
  mounted() {
    this.getproducts()
  },
  methods: {
    validationForm() {
      this.$refs.createemi.validate().then(success => {
        if (success) {
          axiosIns.post('api/v1/shop/emi', this.form).then(response => {
            // console.log(response)
            // first reset your form values
            for (const key in this.form) {
              this.form[key] = ''
            }
            // then do this to reset your ValidationObserver
            this.$nextTick(() => this.$refs.createemi.reset())
            this.$bvToast.toast('emi created successfully.', {
              title: 'Success',
              variant: 'success',
              solid: true,
            })
          })
        }
      })
    },
    getproducts() {
      axiosIns.get('api/v1/shop/product').then(response => {
        this.products = response.data
      })
    },
  },
}
</script>
