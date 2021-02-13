<template>
  <div id="everything">
    <Header :name="name" />
    <div class="address mt-16 flex justify-center">
      <div class="lg:w-custom md:w-2/6 lg:w-2/10 px-0" style="overflow-y: scroll">
        <article
            class="text-white text-left rounded-lg p-0 pb-8"
            style="background-color: white; color: black; cursor: default"
        >
          <div v-show="step === 1 ">
            <article
                class="text-white text-left pb-5 rounded-lg px-8 pb-6 pt-6"
                style="background-color: white; color: black; cursor: default; box-shadow: rgba(96, 100, 112, 0.4) 0 0 35.0956px;"
            >
              <h6 class="text-center text-base mb-6">Pick-Up  details</h6>
              <div class="flex">
                <img src="../assets/images/greenRectangle.svg" class=" pl-1 mb-0" width="22" height="23" alt="">
                <GMap
                    @changeInValue="setPickUp"
                    gmap-class-map="mb-auto pt-0 pl-3 pr-4"
                    v-if="editPickUp"
                    :vicinity="placeVicinity"
                />
                <h6 class="mb-auto w-9/12 pt-1 pl-3 pr-4 " v-else>{{ addressText }}</h6>
                <div v-if="!editPickUp" class=" ml-auto mt-1" @click="changeEdit">
                  <button class="text-right" style="color: #64245C" @click="changeEdit">Edit</button>
                </div>
              </div>
              <div class="flex">
                <img src="../assets/images/talllink.svg" style="height: 80px" class="pl-3" alt="">
              </div>
              <div class="flex">
                <img src="../assets/images/purpleRectangle.svg" height="23" class="pl-1 mb-0" width="22" alt="">
                <GMap v-if="!editPrevioudDestination" @changeInValue="setDestination" gmap-class-map="pt-1 pl-3 pr-4" />
                <div v-else>
                  <h5 class="mb-auto w-9/12 pt-1 pl-3 pr-4">
                    <span
                        style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;text-align: left;"
                        v-if="'vicinity' in this.destination" class="ml-auto" >
                    {{ this.destination.vicinity }}
                    </span>
                      <span
                          style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;text-align: left;"
                          v-else class="w-12/12 ml-auto" >
                      {{ this.destination.formatted_address }}
                    </span>
                  </h5>
                  <div v-if="'vicinity' in this.destination" class="w-12/12 px-3">
                    <small
                        style="font-family: 'Airbnb Cereal App Light'; font-size: 0.9rem; font-style: normal; font-weight: 400; letter-spacing: 0px;"
                        class=" ml-auto text-muted" >
                      {{ this.destination.formatted_address }}
                    </small>
                  </div>
                </div>
                <div v-if="editPrevioudDestination" class=" ml-auto mt-1">
                  <button class="text-right" style="color: #64245C" @click="changePreviousDestinationEdit">Edit</button>
                </div>
              </div>
            </article>
            <div class="pt-12 px-8">
              <h6 class="font-bold text-muted mb-4" style="font-family: 'Airbnb Cereal App Bold', sans-serif">Previous dropoffs</h6>
              <div class="mb-4 cursor-pointer"  @click="setDestinationRecent(recentItem)" v-for="(recentItem, index) in recent" :key="index">
                <h6 class="flex">
                  <img src="../assets/images/Oval.svg"  alt="" height="16" width="16">
                  <span v-if="'vicinity' in recentItem" class="w-11/12 ml-auto" style="font-family: 'Airbnb Cereal App Medium', sans-serif">
                    {{ recentItem.vicinity }}
                  </span>
                  <span v-else class="w-11/12 ml-auto" style="font-family: 'Airbnb Cereal App Medium', sans-serif">
                    {{ recentItem.formatted_address }}
                  </span>
                </h6>
                <div v-if="'vicinity' in recentItem" class="flex">
                  <small  class="w-11/12 ml-auto text-muted" style="font-family: 'Airbnb Cereal App Medium'">
                    {{ recentItem.formatted_address }}
                  </small>
                </div>
              </div>
            </div>

          </div>
          <div v-if="step === 2">
            <article
                class="text-white text-left rounded-lg px-4 pt-5"
                style="background-color: white; color: black; cursor: default"
                v-if="!loading"
            >
              <h5 class="text-center text-base mb-3">Estimate</h5>
              <div class="flex px-1 py-2"
                style="background-color: #F9F9F9;
"
              >
                <img src="../assets/images/bike.svg" style="height: 50px" class="px-2 mb-auto" alt="">
                <img src="../assets/images/directionlogo.svg" width="60" class="px-2 mb-auto pt-5" alt="">
                <img src="../assets/images/directionname.svg" width="60" class="px-2 mb-auto pt-8" alt="">
                <h4 class="ml-auto px-3 pt-6"
                    style="color: #64245C; font-size: 1.2rem"
                >&#8358;{{ ((distanceTotal / 100) * 85).toFixed(2)}}</h4>
              </div>
              <h5
                  class="font-bold text-center text-base mb-3 btn-secondary mt-6 ml-auto w-12/12 py-3 font-medium"
                  style="background-color: #64245C; color: white; border-radius: 10px; cursor: pointer"
                  @click="changeStep('next')"
              >Enter Details</h5>
            </article>
            <div class="loader" v-if="loading"></div>
          </div>
          <div v-if="step === 3">
            <article
                class="text-white text-left pb-0 rounded-lg px-8 pt-8"
                style="background-color: white; color: black; cursor: default;"
            >
              <h5 class="text-center text-base mb-1" style="font-family: 'Airbnb Cereal App Medium', serif ;color: #353B50;">Pick-Up details</h5>
              <div class="flex">
                <img src="../assets/images/greenRectangle.svg" v-if="'vicinity' in this.place" class="mt-4" alt="" style="height: 17px">
                <img src="../assets/images/greenRectangle.svg" v-else class="mt-2" alt="" style="height: 17px">
                <div class="w-10/12">
                  <h5
                      style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;"
                      class=" pt-1 pl-3 pr-4 " v-if="!this.editPickUp">{{ addressText }}
                  </h5>
                  <h5 class="mb-auto pt-1 pl-3 pr-4" v-else>
                  <span
                      style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;text-align: left;"
                      v-if="'vicinity' in this.place" class="ml-auto" >
                  {{ this.place.vicinity }}
                  </span>
                    <span
                        style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;text-align: left;"
                        v-else class="w-12/12 ml-auto" >
                    {{ this.place.formatted_address }}
                  </span>
                  </h5>
                  <div v-if="'vicinity' in this.place" class="w-12/12 px-3">
                    <small
                        style="font-family: 'Airbnb Cereal App Light'; font-size: 0.9rem; font-style: normal; font-weight: 400; letter-spacing: 0px;"
                        class=" ml-auto text-muted" >
                      {{ this.place.formatted_address }}
                    </small>
                  </div>
                </div>
                <div @click="step = 1">
                  <button
                      style="font-family: 'Airbnb Cereal App Light'; font-size: 15px; font-style: normal; font-weight: 400; letter-spacing: 0px; text-align: left; color: #606470;
"
                      class="ml-auto text-right pt-2" @click="step = 1">Edit</button>
                </div>
              </div>
              <h5 class=" text-center text-base mt-10 mb-1" style="font-family: 'Airbnb Cereal App Medium', serif ;color: #353B50;">Drop off details</h5>
              <div class="flex">
                <img src="../assets/images/Oval.svg" v-if="'vicinity' in this.destination" class="mt-4" alt="" style="height: 17px">
                <img src="../assets/images/Oval.svg" v-else class="mt-2" alt="" style="height: 17px">
                <div class="w-10/12">
                  <h5 class="mb-auto pt-1 pl-3 pr-4">
                  <span
                      style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;text-align: left;"
                      v-if="'vicinity' in this.destination" class="ml-auto" >
                  {{ this.destination.vicinity }}
                  </span>
                    <span
                        style="font-family: 'Airbnb Cereal App Light'; font-size: 1rem; font-style: normal; font-weight: 400; letter-spacing: 0px;text-align: left;"
                        v-else class="w-12/12 ml-auto" >
                    {{ this.destination.formatted_address }}
                  </span>
                  </h5>
                  <div v-if="'vicinity' in this.destination" class="w-12/12 px-3">
                    <small
                        style="font-family: 'Airbnb Cereal App Light'; font-size: 0.9rem; font-style: normal; font-weight: 400; letter-spacing: 0px;"
                        class=" ml-auto text-muted" >
                      {{ this.destination.formatted_address }}
                    </small>
                  </div>
                </div>
                <div @click="step =1">
                  <button
                      style="font-family: 'Airbnb Cereal App Light'; font-size: 0.9rem; font-style: normal; font-weight: 400; letter-spacing: 0px; text-align: left; color: #606470;
"
                      class="ml-auto text-right pt-2" @click="step =1">Edit</button>
                </div>
              </div>
              <input
                  type="text"
                  name="firstname"
                  id="First Name"
                  placeholder="Receipient Name"
                  v-model="receipientName"
                  style="font-family: 'Airbnb Cereal App Medium', serif"
                  class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full px-4 py-3 mt-8 mb-6 focus:outline-none"

              />
              <vue-tel-input
                  defaultCountry="NG"
                  :disabledFetchingCountry="true"
                  v-model="receipientTel"
                  class="no-outline placeholder-gray-500 border-gray-500 border-2 w-full px-4 py-2 mt-0 mb-4 bg-white focus:outline-none"
              >
              </vue-tel-input>
              <h5 class=" text-center text-base mt-6 mb-3" style="font-family: 'Airbnb Cereal App Medium', serif;color: #353B50;">Category</h5>
              <v-select :options="selectOptions" v-model="category" className="" />
              <h5 class=" text-left text-base mt-4 mb-2" style="font-family: 'Airbnb Cereal App Medium', serif;color: #353B50;">Schedule Order</h5>
              <div class="flex mb-4">
                <div class="w-6/12">
                  <input v-model="schedule" id="r1" type="radio" name="radio" :value="false">
                  <label for="r1">Instant</label>
                </div>
                <div class="w-6/12">
                  <input v-model="schedule" id="r2" type="radio" name="radio" :value="true">
                  <label for="r2">Schedule for later</label>
                </div>
              </div>
              <input
                  type="datetime-local"
                  name="firstname"
                  id="First "
                  v-if="schedule"
                  v-model="calender"
                  placeholder="Scheduled Date"
                  class="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full px-4 py-2 mb-5 focus:outline-none"
              />
              <label for="s2"
                     style="font-family: 'Airbnb Cereal App Light'; font-size: 20px;"
                     class="mr-auto">Is the item fragile?</label>
              <input id="s2" type="checkbox" class="switch ml-auto" style="float: right" v-model="fragile">
              <h5
                  class="font-bold text-center text-base mb-3 btn-secondary mt-6 ml-auto w-12/12 py-3 font-medium"
                  style="background-color: #80C050; color: white; border-radius: 10px; cursor: pointer"
                  @click="changeStep('next')"
                  v-if="!this.loading"
              >Proceed to pay</h5>
            </article>
          </div>
          <div v-if="step === 4">
            <article
                class="text-white text-left rounded-lg px-4 pt-5"
                style="background-color: white; color: black; cursor: default"
                v-if="!loading"
            >
              <h5 class="text-center text-base mb-3">Estimate</h5>
              <div class="flex px-1 py-2"
                   style="background-color: #F9F9F9;
"
              >
                <img src="../assets/images/bike.svg" style="height: 60px" class="px-2 mb-auto" alt="">
                <img src="../assets/images/directionname.svg" width="60" class="px-2 mb-auto pt-8" alt="">
                <h2 class="ml-auto px-3 pt-6"
                    style="color: #64245C; font-size: 1.2rem"
                >&#8358;{{ ((distanceTotal / 100) * 85).toFixed(2) }}</h2>
              </div>
              <div>
                <label for="s2"
                       style="font-family: 'Airbnb Cereal App Medium', serif; font-size: 1rem; font-style: normal; font-weight: 500; line-height: 41px; letter-spacing: 0px; text-align: left;"
                       class="mr-auto"
                >Pay with card</label>
                <div  style="float: right" class="mt-3">
                  <input  id="r2" type="radio" name="radio" value="card" v-model="payment_method">
                </div>
              </div>
              <div class="mt-3">
                <label for="s2"
                       style="font-family: 'Airbnb Cereal App Light', serif; font-size: 1rem; font-style: normal; font-weight: 400; line-height: 41px; letter-spacing: 0px; text-align: left;"
                       class="mr-auto"
                >Cash on Pick-up </label>
                <div  style="float: right" class="mt-3">
                  <input id="r2" type="radio" name="radio" value="cash pickup" v-model="payment_method">
                </div>
              </div>
              <div class="mt-3">
                <label for="s2"
                       style="font-family: 'Airbnb Cereal App Light', serif; font-size: 1rem; font-style: normal; font-weight: 400; line-height: 41px; letter-spacing: 0px; text-align: left;"
                       class="mr-auto"
                >Cash on Delivery  </label>
                <div  style="float: right" class="mt-3">
                  <input id="r2" type="radio" name="radio" value="cash delivery" v-model="payment_method">
                </div>
              </div>
              <h5
                  v-if="payment_method !== 'card'"
                  class="font-bold text-center text-base mb-3 btn-secondary mt-6 ml-auto w-12/12 py-3 font-medium"
                  style="background-color: #64245C; color: white; border-radius: 10px; cursor: pointer"
                  @click="checkForCardPayment"
              >Proceed</h5>
              <paystack
                  v-else
                  :amount="Math.ceil(amount * 100)"
                  ref="payCardButton"
                  :email="email"
                  :paystackkey="paystackKey"
                  :callback="callback"
                  :close="close"
                  :firstname="name"
                  :lastname="name"
                  :reference="refFinal"
                  :embed="false"
              >
                Proceed
              </paystack>
            </article>
            <div class="loader" v-if="loading"></div>
          </div>
          <div v-if="step === 6">
            <article
                class="text-white text-left pb-5 rounded-lg px-8 pb-0 pt-2 justify-center"
                style="background-color: white; color: black; cursor: default;"
            >
              <h2
                  style="font-family: 'Airbnb Cereal App Bold'; font-size: 34px; line-height: 44px;"
                  class="font-bold text-center mt-3 mb-6">Success</h2>
              <img src="../assets/images/success.svg" alt="" width="80%" class="ml-auto mr-auto">
              <h6
                  style="font-family: 'Airbnb Cereal App Medium'; font-size: 18px; font-weight: 500; cursor: pointer"
                  class="text-center mt-10"
                @click="rerendet"
              >
                Tap here to continue
              </h6>
            </article>
          </div>
        </article>
        <div class="flex mt-4 lg:mt-10" v-if="!loading && step === 1">
          <button class="btn-primary w-5/12 lg:w-12/12 "
            style="background-color: white; color: #64245C; border-radius: 10px"
            @click="estimation"
          >
            Estimate
          </button>
          <button
              class="btn-secondary ml-auto py-3 w-6/12 lg:w-12/12 font-medium"
              style="background-color: #64245C; color: white; border-radius: 10px"
              @click="checkDetails"
          >
            Enter Details
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "@/components/Header";
import GMap from "@/components/GMap";
import {notifications} from "@/mixins/notifications";
import httpClient from "@/utils/api/httpClient";
import {validations} from "@/mixins/validations";
import paystack from 'vue-paystack';

export default {
name: "Dashboard",
  components: {GMap, Header, paystack},
  mixins: [ notifications, validations ],
  data() {
    return {
      name: "",
      refFinal: "",
      startLocation: {
        lat: null,
        lng: null
      },
      step: 1,
      coordinates: {
        0: {
          full_name: 'Default Location',
          lat: 6.608537699999999,
          lng: 3.3215835
        }
      },
      selectOptions: [
        "Clothings",
        "Computer Accessories",
        "Documents",
        "Electronics",
        "Food",
        "Health Products",
      ],
      infoPosition: null,
      infoContent: null,
      infoOpened: false,
      infoCurrentKey: null,
      infoOptions: {
      },
      editPrevioudDestination: false,
      destination: [],
      place: [],
      placeVicinity: '',
      addressText: '',
      editPickUp: false,
      recent: [],
      finalPickUp: [],
      finaldestination: [],
      distanceTotal: 0,
      loading: false,
      receipientName: "",
      receipientTel: "",
      category: "",
      calender: null,
      schedule: false,
      fragile: false,
      amount: null,
      payment_method: "cash delivery",
      payment_status: "pending",
      full_name: JSON.parse(localStorage.getItem('user'))['name'],
      email: JSON.parse(localStorage.getItem('user'))['email'],
      paystackKey: "pk_live_e35689ac278f54c2bba8345733a64a2dc2b8cff6",
    }
  },
  watch: {
    place() {
      this.placeVicinity = this.place.vicinity;
    }
  },
  created() {
    this.started();
    let text = "";
    let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( let i=0; i < 10; i++ )
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    this.refFinal = text;
  },
  methods: {
    started() {
      this.name = JSON.parse(localStorage.getItem('user')).name
      this.addressText = JSON.parse(localStorage.getItem('user')).address_text
      this.startLocation['lat'] = parseFloat(JSON.parse(localStorage.getItem('user')).address_latitude)
      this.startLocation['lng'] = parseFloat(JSON.parse(localStorage.getItem('user')).address_longitude)
      const verify = JSON.parse(localStorage.getItem('user')).email_verified
      if (verify != 1) {
        this.$router.push({ name: 'verification'})
      }
      this.getRecent();
    },
    changePreviousDestinationEdit() {
      if (this.editPrevioudDestination) {
        this.destination = []
      }
      this.editPrevioudDestination = !this.editPrevioudDestination;
    },
    rerendet() {
      this.name= ""
      this.startLocation= {
        lat: null,
        lng: null
      },
      this.step= 1,
      this.coordinates = {
        0: {
          full_name: 'Default Location',
          lat: 6.608537699999999,
          lng: 3.3215835
        }
      }
      this.infoPosition= null
          this.infoContent= null
          this.infoOpened= false
          this.infoCurrentKey= null
          this.infoOptions= {
      }
      this.place= []
      this.placeVicinity= ''
      this.addressText= ''
      this.editPickUp= false
      this.finalPickUp= []
      this.finaldestination= []
      this.distanceTotal= 0
      this.loading= false
      this.receipientName= ""
      this.receipientTel= ""
      this.category= ""
      this.calender= null
      this.schedule= false
      this.fragile= false
      this.started();
    },
    getPosition: function(marker) {
      return {
        lat: parseFloat(marker.lat),
        lng: parseFloat(marker.lng)
      }
    },
    callback() {
      this.checkItemDetails('successful')
    },
    checkItemDetails(payment_status = 'pending') {
      this.loading = true
      const dataForm = {
        address_text: this.finalPickUp,
        price: ((this.distanceTotal / 100) * 85).toFixed(2),
        schedule: this.schedule,
        payment_status: payment_status,
        payment_method: this.payment_method,
      }
      if (this.editPickUp) {
        if (this.destination.geometry.location.lat instanceof Function) {
          dataForm['address_lat'] = this.place.geometry.viewport.Ra['i']
          dataForm['address_lng'] = this.place.geometry.viewport.Wa['i']
        } else {
          dataForm['address_lat'] = this.place.geometry.location.lat
          dataForm['address_lng'] = this.place.geometry.location.lng
        }
      }
      if (this.schedule) {
        dataForm['order_schedule'] = {
          pickup: this.calender
        }
      }
      dataForm['order_destinations'] = {
        destination: this.destination,
        recipient_name: this.receipientName,
        recipient_telephone: this.receipientTel,
        category: this.category,
        fragile: this.fragile
      };
      httpClient.post('orders', dataForm)
      .then(() => {
        this.step = 6;
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));
        this.refFinal = text;
      }).finally(() => this.loading = false)
    },
    changeStep(operation) {
      if (this.step === 3) {
        if (this.receipientName === '') {
          this.notify('Please enter recipient name', 'error', 'bottom')
          return false;
        }
        if (this.receipientTel.length < 10) {
          this.notify('Please enter recipient telephone', 'error', 'bottom')
          return false;
        }
        if (this.category.length < 1) {
          this.notify('Please enter product category', 'error', 'bottom')
          return false;
        }
        if (this.schedule) {
          if (this.calender === null) {
            this.notify('Please enter scheduled date', 'error', 'bottom')
            return false
          }
        }
      }
      if (operation === 'next') {
        this.step += 1
      } else if (operation === 'minus') {
        this.step -= 1
      }
    },
    calculate() {
      this.loading = true;
      const finalUrl = `https://maps.googleapis.com/maps/api/distancematrix/json?origins=${this.finalPickUp}&destinations=${this.finaldestination}&key=AIzaSyCNL1Mzob3HzKiPtt9nB4su5XXxr_JqGik`;

      httpClient.post("orders/calculate/distance", {
        url: finalUrl
      })
      .then(response => {
        this.distanceTotal = response.data['rows'][0]['elements']['0']['distance']['value'];
        this.amount = ((this.distanceTotal / 100) * 85).toFixed(2)
      })
      .finally(() => this.loading = false);
    },
    estimation() {
      if (this.checkForStep2()) {
        this.calculate();
        this.changeStep('next')
      }
    },
    checkDetails() {
      if (this.checkForStep2()) {
        this.calculate();
        this.changeStep('next')
      }
    },
    checkForStep2() {
      let pickUp = {};
      let finalDestination = {};
      if (this.editPickUp && ('formatted_address' in this.place)) {
        pickUp = this.place.formatted_address
      } else if (!this.editPickUp) {
        pickUp = this.addressText
      } else {
        this.notify("Kindly set pickup address", "error", 'bottom')
        return false;
      }
      if (this.destination.geometry) {
        finalDestination = this.destination.formatted_address
      } else {
        this.notify("Kindly set destination address", "error", 'bottom')
        return false;
      }
      this.finalPickUp = pickUp;
      this.finaldestination = finalDestination;
      return true;
    },
    setDestinationRecent(recentItem) {
      this.destination = recentItem;
      this.editPrevioudDestination = true
    },
    changeEdit() {
      this.editPickUp = true
    },
    getRecent() {
      this.recent = JSON.parse(localStorage.getItem('recentLocation'))
    },
    toggleInfo: function(marker, key) {
      this.infoPosition = this.getPosition(marker);
      this.infoContent = marker.full_name;
      if (this.infoCurrentKey == key) {
        this.infoOpened = !this.infoOpened;
      } else {
        this.infoOpened = true;
        this.infoCurrentKey = key;
      }
    },
    storeToLocalStorage() {
      if (this.destination !== null && this.destination !== []) {
        if (localStorage.getItem('recentLocation') === null) {
          const recent = [this.destination];
          localStorage.setItem('recentLocation', JSON.stringify(recent));
        } else {
          let recent = JSON.parse(localStorage.getItem('recentLocation'));
          // console.log(recent)
          if (recent.length > 1) {
            recent.shift()
          }
          // console.log(recent)
          recent.push(this.destination)
          // console.log(recent)
          localStorage.setItem('recentLocation', JSON.stringify(recent));
        }
        this.getRecent();
      }
    },
    setPickUp(e) {
      this.place = e;
    },
    setDestination(e) {
      this.destination = e;
      this.storeToLocalStorage();
    },
    checkForCardPayment() {
      if (this.payment_method === 'card') {
        this.step = 5;
      } else {
        this.checkItemDetails()
      }
    },
    processPayment: () => {
      window.alert("Payment recieved")
    },
    close: () => {
      console.log("You closed checkout page")
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

</style>