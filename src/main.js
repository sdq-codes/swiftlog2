import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faStar,  } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import AOS from 'aos';
import 'aos/dist/aos.css';
import VueTelInput from 'vue-tel-input'
import 'vue-loaders/dist/vue-loaders.css';
import VueLoaders from 'vue-loaders';
import GooglePlacesAutocompletePlugin from 'vue-better-google-places-autocomplete'
import VuePhoneNumberInput from 'vue-phone-number-input';
import 'vue-phone-number-input/dist/vue-phone-number-input.css';
import * as VueGoogleMaps from 'vue2-google-maps'
import vSelect from "vue-select";
import "./styles/vue-select-custom.css";
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.component("v-select", vSelect);
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCNL1Mzob3HzKiPtt9nB4su5XXxr_JqGik',
    libraries: 'places',
  },

})

Vue.use(VueSweetalert2);

Vue.component('vue-phone-number-input', VuePhoneNumberInput);

Vue.use(GooglePlacesAutocompletePlugin)

Vue.use(VueLoaders);

Vue.use(VueTelInput)

Vue.use(require("moment"));

library.add(faUserSecret, faStar)

Vue.component('font-awesome-icon', FontAwesomeIcon)
AOS.init();

Vue.config.productionTip = false
Vue.use(VueAxios, axios)
Vue.use(VueToast);

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
