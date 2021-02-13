<template>
  <header
      class=" bg-primary-purple px-5 md:px-12 lg:px-16 pb-2  md:pb-6 pt-2 md:pt-6 flex justify-between items-center text-grey-body font-body lg:text-sm xl:text-base ">

    <div class="header__logo  flex justify-start items-center">
      <router-link :to="{ name: 'dashboard' }">
        <img src="../assets/images/swift-logo.png" alt="Lernen Logo" class="object-contain w-32"/>
      </router-link>

    </div>

    <div class="header__nav hidden lg:block ml-auto">
      <ul class="list-none">
        <li class="inline-block mr-10">
          <router-link :to="{ name: 'profile' }" class="text-xl md:text-xl lg:text-xl font-bold text-left pt-5" style="color: white">
            Hello {{firstName}}
          </router-link>
        </li>
        <li class="inline-block">
          <h5 @click="logout" class="text-xl md:text-xl lg:text-xl font-bold text-left pt-5" style="color: white; cursor: pointer">
            Logout
          </h5>
        </li>
      </ul>

    </div>

    <nav  className="block md:hidden">
          <span className="text-xl text-white z-100 md:hidden"  @click.prevent="nav = !nav">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                v-if="nav === false"
                class="md:hidden"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="32" height="32" x="0" y="0" viewBox="0 0 384 384" style="enable-background:new 0 0 512 512" xml:space="preserve"
            >
              <g>
              <path
                  xmlns="http://www.w3.org/2000/svg" d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" fill="#ffffff" data-original="#000000" style=""
              />
              <path
                  xmlns="http://www.w3.org/2000/svg" d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" fill="#ffffff" data-original="#000000" style=""
              />
              <path
                  xmlns="http://www.w3.org/2000/svg" d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" fill="#ffffff" data-original="#000000" style=""
              />
            </g>
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="32" height="32" x="0" y="0" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512 512" xml:space="preserve" class="md:hidden">
              <g>
              <g xmlns="http://www.w3.org/2000/svg">
                <g>
                  <path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285    L284.286,256.002z" fill="#ffffff" data-original="#000000" style="" class=""/>
                </g>
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
              <g xmlns="http://www.w3.org/2000/svg">
              </g>
            </g>
            </svg>
          </span>
      <div v-if="nav"  class="fixed bg-white top-0 left-0 w-4/5 h-full md:hidden z-50 shadow p-3" style="opacity: 1; transform: translateX(0%);">
        <div class="relative h-screen w-5/5">
          <div class="absolute flex place-items-center justify-center flex-col nav-position">
            <div class="header__logo flex justify-start items-center py-4">
              <img src="data:image/png;base64,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" alt="Swift logistics Logo">
            </div>
            <ul>
              <li class="inline-block mr-10">
                <router-link :to="{ name: 'profile' }" class="hover:bg-nav-link px-6 py-3 w-48 flex justify-center items-center mt-2 rounded text-black hover:text-primary-green text-center text-xl md:text-xl lg:text-xl font-bold ">
                  Hello {{firstName}}
                </router-link>
              </li>
              <li class="inline-block">
                <h5 @click="logout" class="hover:bg-nav-link px-6 py-3 w-48 flex justify-center items-center mt-2 rounded text-black hover:text-primary-green text-center text-xl md:text-xl lg:text-xl " style="cursor: pointer">
                  Logout
                </h5>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
name: "Header",
  props: [
      'name'
  ],
  data() {
    return {
      telephone: "",
      loading: false,
      firstName: "",
      lastName: "",
      email: "",
      nav: false
    }
  },
  created() {
    this.formatName()
  },
  watch: {
    name() {
      this.formatName();
    }
  },
  methods: {
    formatName() {
      let nameList = this.name.split(" ")
      this.firstName = nameList[0]
      const remainingName = nameList.slice(1)
      this.lastName = remainingName.join()
    },
    logout() {
      localStorage.clear();
      this.$router.push({ name: 'landing' })
    }
  }
}
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap");

@import "../assets/style/tailwind.css";

.home-landing {
  @media screen and (min-width: 768px){
    padding-right: 6rem;
    padding-left: 6rem;
  }
}

ul, ol {
  background-color: transparent !important;
}

#everything {
  min-height: 100vh;
  overflow-y: hidden;
}
header {
  height: 10vh;
}

.gmapper {
  @media screen and (min-height: 600px){
    min-height: 90vh;
  }
}

.mapper-overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 10vh;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.1);
  z-index: 2;
  cursor: pointer;
  @media screen and (min-height: 600px){
    min-height: 90vh;
  }
}

.address {
  position: fixed;
  top: 15vh;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  z-index: 2;
  cursor: pointer;
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
header {
  height: 50%;
}
</style>