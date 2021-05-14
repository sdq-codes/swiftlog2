<template>
  <div id="everything">
    <Header :name="name" />
    <div class="address mt-16 flex justify-center">
      <div @click="$router.go(-1)" class="arrow-back flex justify-content-center px-5">
        <img src="../assets/images/arrow-back-outline.svg" alt="">
      </div>
      <div class="sm:w-11/12 lg:w-custom md:w-2/6 lg:w-2/10 px-0" style="overflow-y: scroll">
        <article
            class="text-white text-left rounded-lg p-5 pb-8"
            style="background-color: white; color: black; cursor: default"
        >
          <h5 class="text-center mb-5">
            Delivery History
          </h5>

          <div class="order-item p-4 mb-6" v-for="order in orders" :key="order.id">
            <div class="block md:flex">
              <div class="flex">
                <img src="../assets/images/green.svg" class="" alt="">
                <h6 class=" pl-3">{{ order.address_text.split(',')[1] }}</h6>
              </div>
              <h6 class=" pl-3 ml-auto">{{order.destinations[0]['recipient_name']}}</h6>
            </div>
            <div class="block md:flex mt-4">
              <div class="flex">
                <img src="../assets/images/red.svg" alt="">
                <h6 class=" pl-3">{{ order.destinations[0].address_text.split(',')[1] }}</h6>
              </div>
            </div>
            <div class="block md:flex mt-3">
              <small class="font-light ">{{ getFormatted(order.created_at) }}</small>
            </div>
            <div class="block md:flex">
              <small class="font-light text-green-600 uppercase" style="">{{ order.status }}</small>
              <h6 class="font-light font-semibold lg:text-xl ml-auto">&#8358;{{order.price}}</h6>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "@/components/Header";
import httpClient from "@/utils/api/httpClient";
import * as moment from "moment/moment";

export default {
name: "OrderHistory",
  components: {Header},
  data() {
    return {
      orders: []
    }
  },
  mounted() {
    httpClient.get("orders/user").then(response => {
      this.orders = response.data.data.order;
    })
  },
  methods: {
    getFormatted(timeStamp) {
      return moment(timeStamp).format("MMM Do YYYY h:mm a");
    }
  }
}
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap");

@import "../assets/style/tailwind.css";

@font-face {
  font-family: 'Airbnb Cereal App Black';
  src: url(../assets/fonts/AirbnbCerealBlack.woff)
}
@font-face {
  font-family: 'Airbnb Cereal App Bold';
  src: url(../assets/fonts/AirbnbCerealBold.woff)
}
@font-face {
  font-family: 'Airbnb Cereal App Book';
  src: url(../assets/fonts/AirbnbCerealBook.woff)
}
@font-face {
  font-family: 'Airbnb Cereal App Extra Bold';
  src: url(../assets/fonts/AirbnbCerealExtraBold.woff)
}
@font-face {
  font-family: 'Airbnb Cereal App Light';
  src: url(../assets/fonts/AirbnbCerealLight.woff)
}
@font-face {
  font-family: 'Airbnb Cereal App Medium';
  src: url(../assets/fonts/AirbnbCerealMedium.woff)
}

.vs__dropdown-menu, #vs1__listbox {
  background: red !important;
  z-index: 99999999999;
}

.back-green {
  background-color: #80C050 !important;
  color: white;
}

.payButton {
  color: white;
  background-color: rgb(100, 36, 92);
  border-radius: 10px;
  cursor: pointer;
  width: 100%;
  margin-top: 2rem;
  font-family: Poppins, sans-serif;
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1rem;
  font-weight: 700;
}

.home-landing {
  @media screen and (min-width: 768px){
    padding-right: 6rem;
    padding-left: 6rem;
  }
}

button {
  outline: none !important;
}

#everything {
  background-image: url("../assets/images/maps.png") !important;
}

.loader {
  border: 16px solid #64245C;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

* {
  font-family: Poppins, sans-serif;
}

ol, ul {
  background-color: white !important;
  padding: 0 20px 30px;
  cursor: pointer;
  border-radius: 10px;
}

#everything {
}
header {
  height: 10vh;
}

.gmapper {
  cursor: default;
  @media screen and (min-height: 600px){
    min-height: 90vh;
  }
}

.vs__search, .vs__search:focus {
  padding-top: 0.3rem !important;
  padding-bottom: 0.3rem !important;
}


.my-4 {
  margin: 0;
}

.text-muted {
  color: #979797;
}

.address {
  width: 100%;
  height: 90vh;
  cursor: pointer;
}

.text-address {
  height: 123px;
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






.radio {
  display: grid;
  grid-template-columns: min-content auto;
  grid-gap: 0.5em;
  font-size: 2.25rem;
  color: var(--color);

  &:focus-within {
    .radio__label {
      transform: scale(1.05);
      opacity: 1;
    }
  }
}

.radio__label {
  line-height: 1;
  transition: 180ms all ease-in-out;
  opacity: 0.8;
}

.radio__input {
  display: flex;

  input {
    opacity: 0;
    width: 0;
    height: 0;

    &:focus + .radio__control {
      box-shadow: 0 0 0 0.05em #fff, 0 0 0.15em 0.1em currentColor;
    }
  }
}

.radio-gradient input:checked + .radio__control {
  background: radial-gradient(currentcolor 50%, rgba(255, 0, 0, 0) 51%);
}

.radio-before {
  .radio__control {
    display: grid;
    place-items: center;
  }

  input + .radio__control::before {
    content: "";
    width: 0.5em;
    height: 0.5em;
    box-shadow: inset 0.5em 0.5em currentColor;
    border-radius: 50%;
    transition: 180ms transform ease-in-out;
    transform: scale(0);
  }

  input:checked + .radio__control::before {
    transform: scale(1);
  }
}

.radio__control {
  display: block;
  width: 0.5em;
  height: 0.5em;
  border-radius: 50%;
  background: rgba(119, 134, 158, 0.15);
  border: 2.30568px solid rgba(119, 134, 158, 0.15);
  box-sizing: border-box;
  transform: matrix(1, 0, 0, -1, 0, 0);
}







@supports (-webkit-appearance: none) or (-moz-appearance: none) {
  input[type=checkbox],
  input[type=radio] {
    --active: #64245C;
    --active-inner: #fff;
    --focus: 2px rgba(100, 36, 92, .3);
    --border: #BBC1E1;
    --border-hover: #64245c;
    --background: #fff;
    --disabled: #F6F8FF;
    --disabled-inner: #E1E6F9;
    -webkit-appearance: none;
    -moz-appearance: none;
    height: 21px;
    outline: none;
    display: inline-block;
    vertical-align: top;
    position: relative;
    margin: 0;
    cursor: pointer;
    border: 1px solid var(--bc, var(--border));
    background: var(--b, var(--background));
    transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
  }
  input[type=checkbox]:after,
  input[type=radio]:after {
    content: "";
    display: block;
    left: 0;
    top: 0;
    position: absolute;
    transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
  }
  input[type=checkbox]:checked,
  input[type=radio]:checked {
    --b: var(--active);
    --bc: var(--active);
    --d-o: .3s;
    --d-t: .6s;
    --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
  }
  input[type=checkbox]:disabled,
  input[type=radio]:disabled {
    --b: var(--disabled);
    cursor: not-allowed;
    opacity: 0.9;
  }
  input[type=checkbox]:disabled:checked,
  input[type=radio]:disabled:checked {
    --b: var(--disabled-inner);
    --bc: var(--border);
  }
  input[type=checkbox]:disabled + label,
  input[type=radio]:disabled + label {
    cursor: not-allowed;
  }
  input[type=checkbox]:hover:not(:checked):not(:disabled),
  input[type=radio]:hover:not(:checked):not(:disabled) {
    --bc: var(--border-hover);
  }
  input[type=checkbox]:focus,
  input[type=radio]:focus {
    box-shadow: 0 0 0 var(--focus);
  }
  input[type=checkbox]:not(.switch),
  input[type=radio]:not(.switch) {
    width: 21px;
  }
  input[type=checkbox]:not(.switch):after,
  input[type=radio]:not(.switch):after {
    opacity: var(--o, 0);
  }
  input[type=checkbox]:not(.switch):checked,
  input[type=radio]:not(.switch):checked {
    --o: 1;
  }
  input[type=checkbox] + label,
  input[type=radio] + label {
    font-size: 14px;
    line-height: 21px;
    display: inline-block;
    vertical-align: top;
    cursor: pointer;
    margin-left: 4px;
  }

  input[type=checkbox]:not(.switch) {
    border-radius: 7px;
  }
  input[type=checkbox]:not(.switch):after {
    width: 5px;
    height: 9px;
    border: 2px solid var(--active-inner);
    border-top: 0;
    border-left: 0;
    left: 7px;
    top: 4px;
    transform: rotate(var(--r, 20deg));
  }
  input[type=checkbox]:not(.switch):checked {
    --r: 43deg;
  }
  input[type=checkbox].switch {
    width: 38px;
    border-radius: 11px;
  }
  input[type=checkbox].switch:after {
    left: 2px;
    top: 2px;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    background: var(--ab, var(--border));
    transform: translateX(var(--x, 0));
  }
  input[type=checkbox].switch:checked {
    --ab: var(--active-inner);
    --x: 17px;
  }
  input[type=checkbox].switch:disabled:not(:checked):after {
    opacity: 0.6;
  }

  input[type=radio] {
    border-radius: 50%;
  }
  input[type=radio]:after {
    width: 19px;
    height: 19px;
    border-radius: 50%;
    background: var(--active-inner);
    opacity: 0;
    transform: scale(var(--s, 0.7));
  }
  input[type=radio]:checked {
    --s: .5;
  }
}

textarea {
  border: 1px solid #f3f3f3;
}

.order-item {
  border: 1px solid #EDE7ED;
  box-sizing: border-box;
  border-radius: 8px;
}

.arrow-back {
  position: relative;
  left: -5rem;
  background-color: white;
  height: 72px;
  border-radius: 50%;
  box-shadow: 0px 6.27323px 25.0929px rgba(96, 100, 112, 0.1);
}
</style>
