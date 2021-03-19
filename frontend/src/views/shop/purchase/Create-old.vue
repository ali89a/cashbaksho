<template>
  <section>
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
                      <v-select
                        dir="ltr"
                        :options="suppliers"
                        label="name"
                        :reduce="supplier => supplier.id"
                        :clearable="false"
                      >
                        <template #list-header>
                          <li
                            v-b-toggle.sidebar-add-new-suplier
                            class="add-new-client-header d-flex align-items-center my-50"
                          >
                            <feather-icon
                              icon="PlusIcon"
                              size="16"
                            />
                            <span class="align-middle ml-25">Add New Supplier</span>
                          </li>
                        </template>
                      </v-select>
                    </b-form-group>
                  </b-col>
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
    <b-sidebar
      id="sidebar-add-new-suplier"
      sidebar-class="sidebar-lg"
      bg-variant="white"
      shadow
      backdrop
      no-header
      right
    >
      <template #default="{ hide }">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center content-sidebar-header px-2 py-1">
          <h5 class="mb-0">
            Add Supplier
          </h5>

          <feather-icon
            class="ml-1 cursor-pointer"
            icon="XIcon"
            size="16"
            @click="hide"
          />

        </div>

        <b-form
          class="p-2"
          @submit.prevent
        >

          <!-- Customer Name -->
          <b-form-group
            label="Customer Name"
            label-for="customer-name"
          >
            <b-form-input
              id="customer-name"
              trim
              placeholder="John Doe"
            />
          </b-form-group>
        </b-form>
      </template>
    </b-sidebar>
  </section>
</template>

<script>

import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BFormInput, BFormGroup, BForm, BRow, BCol, BButton, BFormDatepicker,
} from 'bootstrap-vue'
import vSelect from 'vue-select'
import { required } from '@validations'
import axiosIns from '@/libs/axios'
import 'vue-select/src/scss/vue-select.scss'

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
    vSelect,
  },
  data() {
    return {
      form: {
        item_name: '',
        supplier_id: '',
        amount: '',
        date: '',
        description: '',
      },
      suppliers: [],
      required,
    }
  },
  mounted() {
    this.getsupplierData()
  },
  methods: {
    getsupplierData() {
      axiosIns.get('api/v1/shop/supplier').then(response => {
        // console.log(response.data)
        this.suppliers = response.data
      })
    },
    validationForm() {
      this.$refs.createpurchase.validate().then(success => {
        if (success) {
          axiosIns.post('api/v1/shop/purchase', this.form).then(response => {
            console.log(response)
            // first reset your form values
            for (const key in this.form) {
              this.form[key] = ''
            }
            // then do this to reset your ValidationObserver
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
  },
}
</script>
