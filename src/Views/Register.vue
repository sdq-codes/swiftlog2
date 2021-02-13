<template>
  <div>
      <section class='body-white font-body w-full lg:text-sm overflow-hidden'>
        <form
            class="md:my-16 my-8 mt-2 md:mt-8 grid grid-cols-1 place-items-center ">
          <router-link :to="{ name: 'landing'}">
            <img
                src="../assets/images/swift-logo-auth.svg"
                alt="swift-logo-auth"
                class="w-48 mb-4 md:mb-12 object-contain"/>
          </router-link>

          <div class="mt-2 lg:mt-8 px-4  lg:px-0 lg:w-3/6 xl:w-2/6 mx-auto">
            <div>
              <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-left">              Create your account
              </h2>
            </div>
            <div>
              <p class="text-sm md:text-base opacity-50 text-left w-4/5 lg:w-4/5">
                Sign up to get started
              </p>
            </div>
            <div class="mt-8 ">
              <div v-if="errors != []">
                <p class="text-red-700 text-xs lg:text-sm" :key="error" v-for="error in errors">{{error}}</p>
              </div>
              <div>
                <input
                    type="text"
                    name="firstname"
                    id="First Name"
                    placeholder="First Name"
                    class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"
                    v-model="fname"
                    />
              </div>

              <div>
                <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    placeholder="Last Name"
                    class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"
                    v-model="lname"
                    />
              </div>

              <div>
                <input
                    type="email"
                    name="email"
                    id="Email Address"
                    placeholder="Email Address"
                    class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"
                    v-model="email"
                    />
              </div>
                <vue-tel-input defaultCountry="NG"
                               :disabledFetchingCountry="true" class="no-outline placeholder-gray-500 border-gray-500 border-2 w-full p-4 my-4 bg-white focus:outline-none" v-model="phone"></vue-tel-input>


              <google-places-autocomplete
                  @resultChanged="placeDetail => place = placeDetail"
                  @resultCleared="() => place = null"
              >
                <div slot="input" slot-scope="{ context, events, actions }">
                  <input
                      v-model="context.input"
                      @focus="events.inputHasReceivedFocus"
                      @input="events.inputHasChanged"
                      @keydown.enter.prevent="actions.selectItemFromList"
                      @keydown.down.prevent="actions.shiftResultsSelection"
                      @keydown.up.prevent="actions.unshiftResultsSelection"
                      type="search"
                      id="locationInput"
                      class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"
                      placeholder="Enter Address"
                      autocomplete="on"
                  >
                </div>

                <span slot="item" slot-scope="{ place }" class="block p-2">
        {{ place.description }}
      </span>
                <span slot="activeItem" slot-scope="{ place }" class="block p-2 rounded bg-green-lightest font-bold">
        {{ place.description }}
      </span>
              </google-places-autocomplete>

              <div>
                <input
                    type="password"
                    name="password"
                    id="Password"
                    placeholder="Password"
                    class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"
                    v-model="password"
                    />
              </div>



              <p class="text-xs md:text-sm text-left opacity-50 hover:opacity-100">By clicking Sign up you agree to the following
                <span class="text-primary-green"> Terms of Service </span>
                without reservation</p>

              <input
                  type="submit"
                  id="submit"
                  value="Submit"
                  v-if="loading === false"
                  @click.prevent="register"
                  class="my-4  w-full md:w-5/5 mx-auto sm:mx-0  bg-primary-green p-4 text-white font-normal rounded cursor-pointer lg:ml-0 active:border-green-800 active:border-2"/>
              <div class="loader" v-if="loading === true"></div>

            </div>
            <p class="text-sm md:text-base text-center opacity-50 hover:opacity-100">Already own an account?
              <router-link :to="{ name: 'login'}">
                <span class="text-primary-green"> Sign In</span>
              </router-link>
            </p>
          </div>
        </form>
      </section>
  </div>
</template>

<script>
import { GooglePlacesAutocomplete } from 'vue-better-google-places-autocomplete'
import httpClient from "@/utils/api/httpClient";
import {validations} from "@/mixins/validations";
import {notifications} from "@/mixins/notifications";
export default {
name: "Register",
  components: {GooglePlacesAutocomplete},
  mixins: [validations, notifications],
  data() {
    return {
      place: [],
      fname: "",
      lname: "",
      email: "",
      phone: "",
      password: "",
      errors: [],
      loading: false
    }
  },
  methods: {
    locationCheck() {
      if (this.place === []) {
        this.notify("Location is empty", "error")
        return false
      }
      return true
    },
    register() {
      const loading = true;
      this.loading = loading;
      const validatior = [
        this.isGraterThan(this.password, 8, 'Password'),
        this.isNotEmpty(this.fname,"First Name"),
        this.isNotEmpty(this.lname,"Last Name"),
        this.isEmail(this.email),
        this.locationCheck()
      ];
      if (this.phone.charAt(0) == '0') {
        this.phone = this.phone.substring(1);
      }
      if (!validatior.includes(false)) {
        // console.log(this.place.geometry.viewport.Ra['i']);
        httpClient.post("authentication/register", {
          "email": this.email,
          "password": this.password,
          "password_confirmation": this.password,
          "user_type": "customer",
          "telephone": '234' + this.phone.replace(/\s/g, ''),
          "name": `${this.fname} ${this.lname}`,
          "address_text": this.place.formatted_address,
          "address_latitude": 6.23847,
          "address_longitude": 6.23847,
        })
        .then(response => {
          localStorage.setItem("user", JSON.stringify(response.data.data.user));
          localStorage.setItem("userToken", JSON.stringify(response.data.data.user.access_token));
          // this.notify("Registeration successful", "success")
          this.$swal(
              'Registration successful',
              'You have now joined Swiftlogistics',
              'success'
          );
          this.$router.push({ name: 'verification'})
        }).catch(errors => {
          this.notify("An error occured", "error")
          this.errors = errors.response.data.errors[0].source;
          this.loading = false
        }).finally()
      } else {
        this.loading = false;
      }
    }
  }
}
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap");

@import "../assets/style/tailwind.css";

.body-white {
  background-color: white !important;
  min-height: 100vh;
}

.home-landing {
  @media screen and (min-width: 768px){
    padding-right: 6rem;
    padding-left: 6rem;
  }
}



.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/*.ml-auto {
  @media screen and (min-width: 768px){
    margin-left: auto;
  }
}*/

html {
  scroll-behavior: smooth;
}

main {
  scroll-snap-type: mandatory;
}

section {
  scroll-snap-align: start;
}

.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

.nav-primary {
  transition: all 0.4s;
}
.nav-primary::after {
  content: "";
  background-color: transparent;
  width: 80%;
  display: block;
  margin: 0 auto;
  margin-top: 0.5rem;
  height: 3px;
}

.nav-primary:hover::after {
  background-color: #fff;
}

.btn-primary:hover {
  background-color: white;
  color: #80c050;
  border-color: white;
  transform: translateY(-2px);
  transition: all 0.4s;
  box-shadow: 0 10px 20px rgba(#000000, 0.2) !important;
}

.btn-primary:active,
.btn-primary:focus {
  outline: none;
  transform: translateY(3px);
  box-shadow: 0 5px 10px rgba(#000000, 0.2) !important;
}

.btn-test:hover {
  transform: translateY(-2px);
  transition: all 0.4s;
  box-shadow: 0 10px 20px rgba(#000000, 0.2) !important;
}

.btn-test:active,
.btn-test:focus {
  outline: none;
  transform: translateY(3px);
  box-shadow: 0 5px 10px rgba(#000000, 0.2) !important;
}

.btn-secondary:hover {
  background-color: #80c050;
  border-color: #80c050;
  transform: translateY(-2px);
  transition: all 0.4s;
  color: white;
  box-shadow: 0 10px 20px rgba(#000000, 0.2) !important;
}

.btn-secondary:active,
.btn-secondary:focus {
  outline: none;
  transform: translateY(3px);
  box-shadow: 0 5px 10px rgba(#000000, 0.2) !important;
}

.course__content {
  position: relative;
  cursor: pointer;
}

.image {
  opacity: 1;
  display: block;
  transition: 0.5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: 0.5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.course__content:hover .middle {
  opacity: 1;
  background: rgba(0, 0, 0, 0.7);
}

.text {
  color: white;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}

.text-course {
  color: white;
  position: absolute;
  top: 5%;
  right: 5%;
}

.text__content {
  position: relative;
  background-image: url("../assets/images/lernen-biological-sciences.png");
}

.nav-position {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.floating__div {
  bottom: 5%;
}

img {
  filter: none;
  -webkit-filter: blur(0px);
  -moz-filter: blur(0px);
  -ms-filter: blur(0px);
  image-rendering: smooth;
}

.footer-social-icon {
  background: #fafafa;
  mix-blend-mode: normal;
  opacity: 0.5;
}

.PhoneInputInput:focus {
  outline: none !important;
}
.dashboard-header {
  position: absolute;
}
</style>