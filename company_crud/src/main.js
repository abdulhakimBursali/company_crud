import Vue from 'vue'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false


Vue.mixin({
    data: function() {
        return {
            baseURL : "http://localhost:8000/api",
        }
    }
})



new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
