<template>
  <div>
    <section class='body-white font-body w-full lg:text-sm overflow-hidden'>
      <form
          class="md:my-16 my-8 mt-2 md:mt-8 grid grid-cols-1 place-items-center">
        
        <router-link :to="{ name: 'landing' }">
          <img src="../assets/images/swift-logo-auth.svg" alt="swift-logo-auth" class="w-48 mb-4 md:mb-12 object-contain"/>
        </router-link>

        <div v-if="!resetComplete" class="mt-2 lg:mt-8 sm:px-4 lg:px-0 w-5/6 md:w-4/6 lg:w-3/6 xl:w-2/6 mx-auto">

          <div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-left">Reset  Password</h2>
          </div>
          <div>
            <p class="text-sm md:text-base opacity-50 text-left w-4/5 lg:w-4/5">
              Please enter your registered  email,  we will send you a reset password link
            </p>
          </div>

          <div class="mt-8 ">

            <div>
              <input
                  type="email"
                  name="email"
                  id="Email Address"
                  placeholder="Email Address"
                  class=" text-sm md:text-base placeholder-gray-600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"
                  v-model="email"
                  />
              <div v-if="'email' in error">
                <p class="text-red-700 text-xs lg:text-sm">{{error.email[0]}}</p>
              </div>
            </div>

            <input
                type="submit"
                @click.prevent="login"
                v-if="loading === false"
                id="submit"
                value="RECOVER"
                class="my-4  w-full md:w-5/5 mx-auto sm:mx-0  bg-primary-green p-4 text-white font-normal rounded cursor-pointer lg:ml-0 active:border-green-800 active:border-2"
            />
            <div class="loader" v-if="loading === true"></div>
          </div>
          <p v-if="loading === false" class="text-sm md:text-base text-center opacity-50 hover:opacity-100">
            <router-link :to="{ name: 'login'}"><span class="text-primary-green">Back to Sign In</span></router-link></p>
        </div>

        <div v-else class="mt-2 lg:mt-8 sm:px-4 lg:px-0 w-5/6 md:w-4/6 lg:w-3/6 xl:w-2/6 mx-auto">

          <div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-left">Check your email</h2>
          </div>
          <div>
            <p class="text-sm md:text-base opacity-50 text-left w-4/5 lg:w-4/5">
              We have sent you a reset email link on your registered email.
            </p>
          </div>
        </div>
      </form>
    </section>
  </div>
</template>

<script>
import {validations} from '../mixins/validations';
import {notifications} from '../mixins/notifications';
import httpClient from "../utils/api/httpClient";
export default {
name: "Login",
  mixins: [validations, notifications],
  data() {
    return {
      email: "",
      password: "",
      error: [],
      loading: false,
      resetComplete: false
    }
  },
  created() {
    if(localStorage.getItem("userToken")) {
      this.$router.push({ name: 'dashboard'})
    }
  },
  methods: {
    login() {
      this.loading = true
      const validatior = [
        this.isEmail(this.email)
      ];
      if (!validatior.includes(false)) {
        httpClient.post("authentication/password/reset/mail", {
          email: this.email
        }).then(response => {
          console.log(response)
          this.resetComplete =  true
        }).catch(() => {
          this.notify("Incorrect email address", "error")
        })
        .finally(() => this.loading = false)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
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

/*.ml-auto {
  @media screen and (min-width: 768px){
    margin-left: auto;
  }
}*/

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