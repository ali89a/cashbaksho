<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">transaction Information</span>
        </div>
        <div class="card-body">
          <validation-observer ref="createtransaction">
            <b-form>
              <b-row>
                <b-col md="6">
                  <b-form-group label="Given">
                    <validation-provider
                        #default="{ errors }"
                        name="Given"
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
                        name="Taken"
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
        given: '',
        taken: '',
        date: '',
      },
      required,
    }
  },
  created() {
    this.gettransactionInfo()
  },
  methods: {
    validationForm() {
      this.$refs.createtransaction.validate().then(success => {
        if (success) {
          axiosIns.put(`api/v1/shop/transaction/${this.$route.params.id}`, this.form).then(response => {
            // console.log(response)
            this.$nextTick(() => this.$refs.createtransaction.reset())
            this.$bvToast.toast(response.data.message, {
              title: 'Success',
              variant: 'success',
              solid: true,
            })
          })
        }
      })
    },
    gettransactionInfo() {
      axiosIns.get(`api/v1/shop/transaction/${this.$route.params.id}`).then(response => {
        this.form.given = response.data.transaction_info.given
        this.form.taken = response.data.transaction_info.taken
        this.form.date = response.data.transaction_info.date
      })
    },
  },
}
</script>
