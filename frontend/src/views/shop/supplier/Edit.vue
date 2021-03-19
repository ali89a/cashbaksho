<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Supplier Information</span>
        </div>
        <div class="card-body">
          <validation-observer ref="createsupplier">
            <b-form>
              <b-row>
                <b-col md="6">
                  <b-form-group label="Full name">
                    <validation-provider
                      #default="{ errors }"
                      name="name"
                      rules="required"
                    >
                      <b-form-input
                        v-model="form.name"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Full Name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Phone number">
                    <validation-provider
                      #default="{ errors }"
                      name="phone_number"
                    >
                      <b-form-input
                        v-model="form.phone_number"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="Phone number"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group label="Description">
                    <validation-provider
                      #default="{ errors }"
                      name="description"
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
        name: '',
        phone_number: '',
        description: '',
      },
      required,
    }
  },
  created() {
    this.getsupplierInfo()
  },
  methods: {
    validationForm() {
      this.$refs.createsupplier.validate().then(success => {
        if (success) {
          axiosIns.put(`api/v1/shop/supplier/${this.$route.params.id}`, this.form).then(response => {
            // console.log(response)
            this.$nextTick(() => this.$refs.createsupplier.reset())
            this.$bvToast.toast(response.data.message, {
              title: 'Success',
              variant: 'success',
              solid: true,
            })
          }).catch(error => {
            this.$refs.createsupplier.setErrors(error.response.data.errors)
          })
        }
      })
    },
    getsupplierInfo() {
      axiosIns.get(`api/v1/shop/supplier/${this.$route.params.id}`).then(response => {
        this.form.name = response.data.supplier_info.name
        this.form.phone_number = response.data.supplier_info.phone_number
        this.form.description = response.data.supplier_info.description
      })
    },
  },
}
</script>
