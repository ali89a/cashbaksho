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
                      name="Full Name"
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
                      name="Phone number"
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
                  <b-form-group label="Previous Due">
                    <validation-provider
                      #default="{ errors }"
                      name="Previous Due"
                    >
                      <b-form-input
                        v-model="form.previous_due"
                        :state="errors.length > 0 ? false:null"
                        type="text"
                        placeholder="Previous due"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
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
        previous_due: '',
        description: '',
      },
      required,
    }
  },
  methods: {
    validationForm() {
      this.$refs.createsupplier.validate().then(success => {
        if (success) {
          axiosIns.post('api/v1/shop/supplier', this.form).then(response => {
            // console.log(response)
            // first reset your form values
            for (let key in this.form ) {
              this.form[key] = ''
            }
            // then do this to reset your ValidationObserver
            this.$nextTick(() => this.$refs.createsupplier.reset())
            this.$bvToast.toast('supplier created successfully.', {
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
