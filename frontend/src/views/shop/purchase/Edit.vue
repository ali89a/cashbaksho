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
                  <b-form-group label="Item Name">
                    <validation-provider
                        #default="{ errors }"
                        name="Item Name"
                        rules="required"
                    >
                      <b-form-input
                          v-model="form.item_name"
                          :state="errors.length > 0 ? false:null"
                          placeholder="Item Name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
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
        item_name: '',
        amount: '',
        date: '',
        description: '',
      },
      required,
    }
  },
  created() {
    this.getpurchaseInfo()
  },
  methods: {
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
        this.form.item_name = response.data.purchase_info.item_name
        this.form.amount = response.data.purchase_info.amount
        this.form.date = response.data.purchase_info.date
        this.form.description = response.data.purchase_info.description
        console.log(this.form)
      })
    },
  },
}
</script>
