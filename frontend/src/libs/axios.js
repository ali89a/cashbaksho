import Vue from 'vue'

// axios
import axios from 'axios'

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: 'http://cashbaksho.com',
  timeout: 5000,
  headers: { Accept: 'application/json' },
})

Vue.prototype.$http = axiosIns

export default axiosIns
