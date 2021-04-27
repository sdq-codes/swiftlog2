<template>
  <div id="everything">
    <div v-if="modalVisible" class="flex items-center justify-center fixed z-50 left-0 bottom-0 w-full h-full bg-gray-800">
      <div class="bg-white rounded-lg w-1/2"  style="max-width: 600px">
        <div class="flex flex-col items-start p-4 justify-center">
          <div class="flex items-center w-full">
            <div class=" w-full font-medium text-lg text-center"
              style="font-style: normal;
              font-weight: 500;
              font-size: 21px;
              line-height: 24px;
              /* identical to box height, or 114% */

              letter-spacing: 0.12px;

              color: #4E5365;"
            >Cancel ride with {{newOrderDetails.order.order_rider.rider.user.name}}</div>
          </div>
          <hr>
          <div class="w-full mt-2 text-center"
            style="font-style: normal;
              font-weight: normal;
              font-size: 16px;
              line-height: 18px;
              /* identical to box height, or 112% */


              color: #4E5365;

              opacity: 0.7;"
          >
            You might have to wait longer if you cancel
          </div>
          <div class="w-full flex justify-center mt-8">
            <div class="px-5">
              <button
                  class="hover:bg-red-700 text-white font-bold py-4 px-16 rounded"
                  style="background-color: white;
                  font-weight: 500;
                  font-size: 12px;
                  line-height: 18px;
                  display: flex;
                  align-items: center;
                  text-align: center;
                  letter-spacing: 0.4px;
                  color: #4E5365;
                  border: 1px solid #DADBDF;
                  border-radius: 8px;
                "
                  @click="modalVisible = false"
              >
                Cancel
              </button>
            </div>
            <div class="px-5">
              <button
                  class="hover:bg-red-700 text-white font-bold py-4 px-16 rounded"
                  style="background-color: #F03737;
                  font-weight: 500;
                  font-size: 12px;
                  line-height: 18px;
                  display: flex;
                  align-items: center;
                  text-align: center;
                  letter-spacing: 0.4px;
                  color: #FFFFFF;
                  border: 1px solid #DADBDF;
                  border-radius: 8px;
                "
                  @click="cancelOrder"
              >
                Confirm
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Header :name="name" />
    <div v-if="settings.accepting_orders === true && nownowtime" class="address mt-16 flex justify-center">
      <div @click="step = step - 1" v-if="step > 0 & step < 6" class="arrow-back flex justify-content-center px-5">
        <img src="../assets/images/arrow-back-outline.svg" alt="">
      </div>
      <div @click="rerendet" v-else-if="step === 6" class="arrow-back flex justify-content-center px-5">
        <img src="../assets/images/arrow-back-outline.svg" alt="">
      </div>
      <div @click="$router.go(-1)" v-else class="arrow-back flex justify-content-center px-5">
        <img src="../assets/images/arrow-back-outline.svg" alt="">
      </div>
      <div class="lg:w-custom md:w-2/6 lg:w-2/10 px-0" style="overflow-y: scroll; max-width: 600px;">
        <article
            class="text-white text-left rounded-lg p-0 pb-8"
            style="background-color: white; color: black; cursor: default"
        >
          <div v-show="step === 0" class="p-4">
            <h6 class="text-center pt-5">Select Option</h6>
            <h6 class="text-center text-sm mt-1 mb-5 font-light">I am the</h6>
            <div class="block inline-flex w-full bg-gray-100 p-4 rounded-b" style="border-radius: 15px">
              <img src="../assets/images/sender.svg" width="32px" height="32px" alt="">
              <div class="block w-full">
                <div  class="flex w-full space-between p-2 rounded-b pb-0" >
                  <h6 class="mr-auto text-lg font-normal" style="color: #353B50">Sender</h6>
                  <input type="radio" v-model="deliveryType" value="sender" class="ml-auto">
                </div>
                <div  class="flex w-full space-between mb-4 p-2 rounded-b">
                  <h6 class="mr-auto text-sm font-normal" style="color: #353B50">
                    The dispatch rider will be picking up package from me
                  </h6>
                </div>
              </div>
            </div>
            <div class="block inline-flex w-full bg-gray-100 p-4 rounded-b mt-5"  style="border-radius: 15px">
              <img src="../assets/images/receiver.svg"  width="32px" height="32px"  alt="">
              <div class="block w-full">
                <div  class="flex w-full space-between p-2 rounded-b pb-0" >
                  <h6 class="mr-auto text-lg font-normal" style="color: #353B50">Receiver</h6>
                  <input type="radio" v-model="deliveryType" value="receiver" class="ml-auto">
                </div>
                <div  class="flex w-full space-between mb-4 p-2 rounded-b">
                  <h6 class="mr-auto text-sm font-normal" style="color: #353B50">
                    The dispatch rider will be delivering package from me
                  </h6>
                </div>
              </div>
            </div>
            <div class="block inline-flex w-full bg-gray-100 p-4 rounded-b mt-5"  style="border-radius: 15px">
              <img src="../assets/images/third.svg"  width="32px" height="32px"  alt="">
              <div class="block w-full">
                <div  class="flex w-full space-between p-2 rounded-b pb-0" >
                  <h6 class="mr-auto text-lg font-normal" style="color: #353B50">Third Party</h6>
                  <input type="radio" v-model="deliveryType" value="third" class="ml-auto">
                </div>
                <div  class="flex w-full space-between mb-4 p-2 rounded-b">
                  <h6 class="mr-auto text-sm font-normal" style="color: #353B50">
                    I am placing the order on someone’s behalf
                  </h6>
                </div>
              </div>
            </div>
            <button
                class="btn-secondary py-3 w-full mt-5 font-medium"
                style="background-color: #64245C; color: white; border-radius: 10px"
                @click="deliveryTypeChoose"
            >
              Next
            </button>
          </div>
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
                <svg v-if="numberOfOrders === 0" @click="changeNumberOfOrders" class="ml-auto mt-4" width="28" height="28" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20.5 8.54175V32.4584" stroke="#606470" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M8.54166 20.5H32.4583" stroke="#606470" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div  v-for="index in numberOfOrders" :key="index">
                <div class="flex">
                  <img src="../assets/images/talllink.svg" style="height: 80px" class="pl-3" alt="">
                </div>
                <div class="flex">
                  <img src="../assets/images/purpleRectangle.svg" height="23" class="pl-1 mb-0" width="22" alt="">
                  <GMap @changeInValue="addDestination($event, index)" gmap-class-map="pt-1 pl-3 pr-4" />
                  <svg v-if="numberOfOrders === index" @click="changeNumberOfOrders" class="ml-auto mt-4" width="28" height="28" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5 8.54175V32.4584" stroke="#606470" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.54166 20.5H32.4583" stroke="#606470" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
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
              <div v-for="(singleOtherDestination, index) in otherDestinations" :key="index">
                <div class="flex mt-2" v-if="typeof singleOtherDestination === 'object'">
                  <img src="../assets/images/Oval.svg" class="mt-2" alt="" style="height: 17px">
                  <div class="w-10/12">
                    <div class="w-12/12 px-3">
                      <small
                          style="font-family: 'Airbnb Cereal App Light'; font-size: 0.9rem; font-style: normal; font-weight: 400; letter-spacing: 0px;"
                          class=" ml-auto text-muted" >
                        {{ singleOtherDestination['formatted_address'] }}
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
              <input id="s2" type="checkbox" class="switch ml-auto mb-5" style="float: right" v-model="fragile">
              <textarea
                  placeholder="Additional Note"
                  name="" id="" rows="7" v-model="addNote" style="width: 100%; margin-top: 0.7rem; padding: 1rem" class="">

              </textarea>
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
              <h5
                  style="font-family: 'Airbnb Cereal App Bold'; font-size: 1.3rem; line-height: 44px;"
                  class="text-center mt-3 mb-6">Searching for dispatch</h5>
              <img src="../assets/images/cancelRide.svg" alt="" width="64px" class="ml-auto mr-auto">
              <h6
                  style="font-family: 'Airbnb Cereal App Medium'; font-size: 18px; font-weight: 500; cursor: pointer"
                  class="text-center mt-10"
                @click="rerendet"
              >
                Cancel search
              </h6>
            </article>
          </div>
          <div v-if="step === 7" class="px-10">
            <h5 class="w-max text-center pt-5 text-lg pb-3" style="font-weight: 500; border-bottom-color: rgba(131,135,147,0.3); border-bottom-width: 1px">
              Rider would soon arrive
            </h5>
            <div class="flex grid grid-cols-6 pt-5">
              <div class="col-span-5"
                style="font-weight: 500;
                  font-size: 1rem;
                  line-height: 18px;
                  color: #4E5365;
                  opacity: 0.7;
                "
              >
                Bike information not available
              </div>
              <div class="col-span-1 flex justify-end relative"
                style="font-weight: 500;
                  font-size: 1rem;
                  line-height: 18px;
                  color: #4E5365;
                  opacity: 0.7;
                "
              >
                <img :src="newOrderDetails.order.order_rider.rider.profile_pic"
                     height="64px" style="width: 64px" alt="">
                <div class="star-things py-1 px-2 flex justify-content-center w-full" >
                  <h2 class="font-bold flex w-max">
                    <svg style="margin-top: 0.1rem" class="mr-3" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.77939 10.5001C8.69943 10.5004 8.62056 10.4816 8.54939 10.4451L5.99939 9.1101L3.44939 10.4451C3.36659 10.4886 3.27323 10.5081 3.17993 10.5012C3.08663 10.4943 2.99713 10.4614 2.92161 10.4062C2.84608 10.351 2.78756 10.2757 2.7527 10.1889C2.71784 10.1021 2.70803 10.0072 2.72439 9.9151L3.22439 7.1001L1.16439 5.1001C1.10012 5.03596 1.05453 4.95554 1.03251 4.86745C1.01048 4.77936 1.01287 4.68694 1.03939 4.6001C1.06837 4.51124 1.12168 4.43228 1.19327 4.37218C1.26486 4.31208 1.35185 4.27326 1.44439 4.2601L4.29439 3.8451L5.54939 1.2801C5.59034 1.19557 5.65426 1.12427 5.73385 1.07439C5.81344 1.0245 5.90546 0.998047 5.99939 0.998047C6.09332 0.998047 6.18535 1.0245 6.26494 1.07439C6.34452 1.12427 6.40845 1.19557 6.44939 1.2801L7.71939 3.8401L10.5694 4.2551C10.6619 4.26826 10.7489 4.30708 10.8205 4.36718C10.8921 4.42728 10.9454 4.50624 10.9744 4.5951C11.0009 4.68194 11.0033 4.77436 10.9813 4.86245C10.9593 4.95054 10.9137 5.03096 10.8494 5.0951L8.78939 7.0951L9.28939 9.9101C9.30724 10.0038 9.2979 10.1007 9.26246 10.1893C9.22702 10.2779 9.16697 10.3545 9.08939 10.4101C8.99885 10.4736 8.88983 10.5052 8.77939 10.5001Z" fill="#7C9A32"/>
                  </svg>
                  null
                  </h2>
                </div>
              </div>
            </div>
            <div class="flex grid grid-cols-6 pt-2 pb-5" style="border-bottom-color: rgba(131,135,147,0.3); border-bottom-width: 1px">
              <div class="col-span-6"
              >
                <h6
                    style="font-weight: 500;
                  font-size: 1rem;
                  line-height: 18px;
                  color: #4E5365;
                  opacity: 0.7;
                "
                    class="w-full"
                >
                  {{ newOrderDetails.order.order_rider.rider.user.name }}
                </h6>
                <h6
                    style="font-style: normal;
                      font-weight: normal;
                      font-size: 16px;
                      line-height: 24px;
                      color: #4E5365;
                   "
                    class="w-full"
                >
                  {{newOrderDetails.order.order_rider.rider.order_rider.length}} deliveries
                </h6>
              </div>
            </div>
            <div class="flex grid grid-cols-6 pt-5 pb-5" style="border-bottom-color: rgba(131,135,147,0.3); border-bottom-width: 1px">
              <div class="col-span-5 flex">
                <svg class="mr-3 mt-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0)">
                    <path d="M14 6.66675C14 11.3334 8 15.3334 8 15.3334C8 15.3334 2 11.3334 2 6.66675C2 5.07545 2.63214 3.54933 3.75736 2.42411C4.88258 1.29889 6.4087 0.666748 8 0.666748C9.5913 0.666748 11.1174 1.29889 12.2426 2.42411C13.3679 3.54933 14 5.07545 14 6.66675Z" stroke="#4E5365" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 8.66675C9.10457 8.66675 10 7.77132 10 6.66675C10 5.56218 9.10457 4.66675 8 4.66675C6.89543 4.66675 6 5.56218 6 6.66675C6 7.77132 6.89543 8.66675 8 8.66675Z" stroke="#4E5365" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </g>
                  <defs>
                    <clipPath id="clip0">
                      <rect width="16" height="16" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>
                <div class="">
                  <h6
                      style="
                    font-style: normal;
                    font-weight: normal;
                    font-size: 16px;
                    line-height: 16px;
                    /* identical to box height, or 100% */

                    letter-spacing: 0.12px;

                    color: #4E5365;
                  "
                  >
                    {{newOrderDetails.order.destinations[0].address_text}}
                  </h6>
                  <h6
                      style="
                    font-style: normal;
                    font-weight: normal;
                    font-size: 12px;
                    line-height: 16px;
                    letter-spacing: 0.12px;
                    color: #4E5365;
                  "
                  >
                    Change destination
                  </h6>
                </div>
              </div>
              <svg class="ml-auto mt-2 col-span-1" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 13L7 7L1 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div class="flex grid grid-cols-6 pt-5 pb-5" style="border-bottom-color: rgba(131,135,147,0.3); border-bottom-width: 1px">
              <div class="col-span-5 flex">
                <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6 11C5.80222 11 5.60888 11.0586 5.44443 11.1685C5.27998 11.2784 5.15181 11.4346 5.07612 11.6173C5.00043 11.8 4.98063 12.0011 5.01921 12.1951C5.0578 12.3891 5.15304 12.5673 5.29289 12.7071C5.43275 12.847 5.61093 12.9422 5.80491 12.9808C5.99889 13.0194 6.19996 12.9996 6.38268 12.9239C6.56541 12.8482 6.72159 12.72 6.83147 12.5556C6.94135 12.3911 7 12.1978 7 12C7 11.7348 6.89464 11.4804 6.70711 11.2929C6.51957 11.1054 6.26522 11 6 11ZM18 11C17.8022 11 17.6089 11.0586 17.4444 11.1685C17.28 11.2784 17.1518 11.4346 17.0761 11.6173C17.0004 11.8 16.9806 12.0011 17.0192 12.1951C17.0578 12.3891 17.153 12.5673 17.2929 12.7071C17.4327 12.847 17.6109 12.9422 17.8049 12.9808C17.9989 13.0194 18.2 12.9996 18.3827 12.9239C18.5654 12.8482 18.7216 12.72 18.8315 12.5556C18.9414 12.3911 19 12.1978 19 12C19 11.7348 18.8946 11.4804 18.7071 11.2929C18.5196 11.1054 18.2652 11 18 11ZM20 5H4C3.20435 5 2.44129 5.31607 1.87868 5.87868C1.31607 6.44129 1 7.20435 1 8V16C1 16.7956 1.31607 17.5587 1.87868 18.1213C2.44129 18.6839 3.20435 19 4 19H20C20.7956 19 21.5587 18.6839 22.1213 18.1213C22.6839 17.5587 23 16.7956 23 16V8C23 7.20435 22.6839 6.44129 22.1213 5.87868C21.5587 5.31607 20.7956 5 20 5ZM21 16C21 16.2652 20.8946 16.5196 20.7071 16.7071C20.5196 16.8946 20.2652 17 20 17H4C3.73478 17 3.48043 16.8946 3.29289 16.7071C3.10536 16.5196 3 16.2652 3 16V8C3 7.73478 3.10536 7.48043 3.29289 7.29289C3.48043 7.10536 3.73478 7 4 7H20C20.2652 7 20.5196 7.10536 20.7071 7.29289C20.8946 7.48043 21 7.73478 21 8V16ZM12 9C11.4067 9 10.8266 9.17595 10.3333 9.50559C9.83994 9.83524 9.45542 10.3038 9.22836 10.8519C9.0013 11.4001 8.94189 12.0033 9.05764 12.5853C9.1734 13.1672 9.45912 13.7018 9.87868 14.1213C10.2982 14.5409 10.8328 14.8266 11.4147 14.9424C11.9967 15.0581 12.5999 14.9987 13.1481 14.7716C13.6962 14.5446 14.1648 14.1601 14.4944 13.6667C14.8241 13.1734 15 12.5933 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9ZM12 13C11.8022 13 11.6089 12.9414 11.4444 12.8315C11.28 12.7216 11.1518 12.5654 11.0761 12.3827C11.0004 12.2 10.9806 11.9989 11.0192 11.8049C11.0578 11.6109 11.153 11.4327 11.2929 11.2929C11.4327 11.153 11.6109 11.0578 11.8049 11.0192C11.9989 10.9806 12.2 11.0004 12.3827 11.0761C12.5654 11.1518 12.7216 11.28 12.8315 11.4444C12.9414 11.6089 13 11.8022 13 12C13 12.2652 12.8946 12.5196 12.7071 12.7071C12.5196 12.8946 12.2652 13 12 13Z" fill="#4E5365"/>
                </svg>
                <div class="pt-1">
                  <h6
                      style="
                    font-style: normal;
                    font-weight: normal;
                    font-size: 12px;
                    line-height: 16px;
                    letter-spacing: 0.12px;
                    color: #4E5365;
                  "
                  >
                    {{newOrderDetails.order.payment_method.slice(0, 4).toUpperCase()}}
                  </h6>
                </div>
              </div>
              <h6 class="ml-auto mt-2 col-span-1"
                style="font-style: normal;
                  font-weight: 500;
                  font-size: 21px;
                  line-height: 24px;
                  color: #4E5365;"
              >
                &#8358;{{ newOrderDetails.order.price}}
              </h6>
            </div>
            <div class="flex justify-center pt-4 mt-5">
              <div class="mx-8" >
                <svg @click="showContact = !showContact" width="48" class="mx-auto" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="24" cy="24" r="23.5" stroke="#EAEAEA"/>
                  <path d="M27.7134 24.7093C28.6986 23.9384 29.4178 22.8813 29.7708 21.685C30.1237 20.4887 30.093 19.2128 29.6829 18.0346C29.2727 16.8565 28.5036 15.8348 27.4823 15.1117C26.4611 14.3886 25.2387 14 23.9851 14C22.7315 14 21.509 14.3886 20.4878 15.1117C19.4666 15.8348 18.6975 16.8565 18.2873 18.0346C17.8772 19.2128 17.8464 20.4887 18.1994 21.685C18.5524 22.8813 19.2715 23.9384 20.2568 24.7093C18.5686 25.382 17.0955 26.4976 15.9947 27.9374C14.8939 29.3771 14.2066 31.0869 14.0061 32.8846C13.9915 33.0159 14.0032 33.1487 14.0403 33.2754C14.0773 33.4022 14.1392 33.5205 14.2222 33.6235C14.39 33.8316 14.6339 33.9648 14.9005 33.994C15.167 34.0231 15.4342 33.9458 15.6434 33.779C15.8526 33.6122 15.9866 33.3695 16.0159 33.1045C16.2366 31.1508 17.1733 29.3465 18.6471 28.0362C20.1209 26.7259 22.0284 26.0016 24.0052 26.0016C25.982 26.0016 27.8895 26.7259 29.3633 28.0362C30.8371 29.3465 31.7738 31.1508 31.9944 33.1045C32.0218 33.3501 32.1396 33.5769 32.3252 33.7411C32.5108 33.9054 32.751 33.9955 32.9994 33.994H33.1099C33.3734 33.9638 33.6141 33.8314 33.7798 33.6254C33.9454 33.4195 34.0225 33.1568 33.9943 32.8946C33.7928 31.0918 33.1018 29.3776 31.9953 27.9357C30.8888 26.4937 29.4087 25.3784 27.7134 24.7093ZM23.9851 23.9997C23.1901 23.9997 22.4129 23.7653 21.7518 23.326C21.0908 22.8867 20.5756 22.2624 20.2713 21.5319C19.9671 20.8014 19.8875 19.9976 20.0426 19.2221C20.1977 18.4466 20.5805 17.7343 21.1427 17.1752C21.7049 16.6161 22.4211 16.2354 23.2009 16.0812C23.9806 15.9269 24.7889 16.0061 25.5234 16.3086C26.2579 16.6112 26.8857 17.1236 27.3274 17.781C27.7691 18.4385 28.0048 19.2114 28.0048 20.002C28.0048 21.0623 27.5813 22.0791 26.8275 22.8288C26.0736 23.5785 25.0512 23.9997 23.9851 23.9997Z" fill="#4E5365"/>
                </svg>
                <h6
                    @click="showContact = !showContact"
                    style="font-style: normal;
                      font-weight: normal;
                      font-size: 12px;
                      line-height: 16px;
                      letter-spacing: 0.12px;
                      text-align: center;
                      color: #4E5365;"
                class="mb-3">Contact</h6>
                <small @click.prevent class="bg-white mt-8 py-1 px-5 contact-tel" v-if="showContact">{{newOrderDetails.order.order_rider.rider.user.telephone}}</small>
              </div>
              <div class="mx-8 cursor-pointer" @click="modalVisible = true"
                   >
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="24" cy="24" r="23.5" stroke="#EAEAEA"/>
                  <path d="M30.5625 18.7594L29.2406 17.4375L24 22.6781L18.7594 17.4375L17.4375 18.7594L22.6781 24L17.4375 29.2406L18.7594 30.5625L24 25.3219L29.2406 30.5625L30.5625 29.2406L25.3219 24L30.5625 18.7594Z" fill="#4E5365"/>
                </svg>

                <h6
                    style="font-style: normal;
                    font-weight: normal;
                    font-size: 12px;
                    line-height: 16px;
                    /* identical to box height, or 133% */

                    letter-spacing: 0.12px;
                    text-align: center;
                    color: #4E5365;"
                >Cancel</h6>
              </div>
            </div>
          </div>
          <div v-if="step === 8" class="px-10">
            <div class="w-max flex-col py-8 justify-center">
              <div class="w-max">
                <img
                    :src="newOrderDetails.order.order_rider.rider.profile_pic"
                    style="height: 120px; width: 120px; border-radius: 50%" class="mx-auto" alt="">
              </div>
              <h5 class="w-max text-center mt-8 text-lg font-semibold">
                How was your experience with {{ newOrderDetails.order.order_rider.rider.user.name }}
              </h5>
              <h5 class="w-max text-center mt-4 text-lg">
                {{newOrderDetails.order.address_text}} to {{newOrderDetails.order.destinations[0].address_text}}
              </h5>
              <h5 class="w-max text-center mt-4 text-lg">
                <div>
                  <div class="flex justify-center">
                    <svg @click="rateOrder(1)" width="32" class="" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M29.334 12.8933C29.2498 12.6494 29.0966 12.4352 28.8931 12.2766C28.6895 12.1181 28.4444 12.0219 28.1873 11.9999L20.6006 10.8933L17.2006 3.99995C17.0914 3.77452 16.921 3.58441 16.7087 3.45138C16.4965 3.31836 16.2511 3.2478 16.0006 3.2478C15.7501 3.2478 15.5047 3.31836 15.2925 3.45138C15.0803 3.58441 14.9098 3.77452 14.8006 3.99995L11.4006 10.8799L3.81395 11.9999C3.56718 12.035 3.33519 12.1386 3.14429 12.2988C2.95339 12.4591 2.81123 12.6696 2.73395 12.9066C2.66321 13.1382 2.65687 13.3846 2.71559 13.6195C2.77432 13.8544 2.8959 14.0689 3.06729 14.24L8.57395 19.5733L7.24062 27.1466C7.19302 27.3966 7.21795 27.655 7.31245 27.8912C7.40695 28.1275 7.56709 28.3318 7.77395 28.4799C7.97558 28.6241 8.21339 28.7092 8.46068 28.7257C8.70798 28.7422 8.95498 28.6894 9.17395 28.5733L16.0006 25.0133L22.8006 28.5866C22.9878 28.6922 23.1991 28.7473 23.414 28.7466C23.6964 28.7476 23.9718 28.6589 24.2006 28.4933C24.4075 28.3451 24.5676 28.1408 24.6621 27.9046C24.7566 27.6683 24.7816 27.4099 24.734 27.16L23.4006 19.5866L28.9073 14.2533C29.0998 14.0902 29.2421 13.8758 29.3176 13.6351C29.3931 13.3943 29.3988 13.1371 29.334 12.8933ZM21.134 18.2266C20.9776 18.3779 20.8606 18.5651 20.7932 18.7719C20.7258 18.9788 20.71 19.1989 20.7473 19.4133L21.7073 25L16.694 22.3333C16.501 22.2306 16.2858 22.1768 16.0673 22.1768C15.8487 22.1768 15.6335 22.2306 15.4406 22.3333L10.4273 25L11.3873 19.4133C11.4245 19.1989 11.4088 18.9788 11.3414 18.7719C11.274 18.5651 11.157 18.3779 11.0006 18.2266L7.00062 14.2266L12.614 13.4133C12.83 13.3832 13.0353 13.3007 13.212 13.1728C13.3886 13.045 13.5312 12.8757 13.6273 12.6799L16.0006 7.59995L18.5073 12.6933C18.6033 12.8891 18.746 13.0583 18.9226 13.1862C19.0993 13.314 19.3046 13.3966 19.5206 13.4266L25.134 14.24L21.134 18.2266Z" fill="#4E5365"/>
                    </svg>
                    <svg @click="rateOrder(2)" width="32" class="" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M29.334 12.8933C29.2498 12.6494 29.0966 12.4352 28.8931 12.2766C28.6895 12.1181 28.4444 12.0219 28.1873 11.9999L20.6006 10.8933L17.2006 3.99995C17.0914 3.77452 16.921 3.58441 16.7087 3.45138C16.4965 3.31836 16.2511 3.2478 16.0006 3.2478C15.7501 3.2478 15.5047 3.31836 15.2925 3.45138C15.0803 3.58441 14.9098 3.77452 14.8006 3.99995L11.4006 10.8799L3.81395 11.9999C3.56718 12.035 3.33519 12.1386 3.14429 12.2988C2.95339 12.4591 2.81123 12.6696 2.73395 12.9066C2.66321 13.1382 2.65687 13.3846 2.71559 13.6195C2.77432 13.8544 2.8959 14.0689 3.06729 14.24L8.57395 19.5733L7.24062 27.1466C7.19302 27.3966 7.21795 27.655 7.31245 27.8912C7.40695 28.1275 7.56709 28.3318 7.77395 28.4799C7.97558 28.6241 8.21339 28.7092 8.46068 28.7257C8.70798 28.7422 8.95498 28.6894 9.17395 28.5733L16.0006 25.0133L22.8006 28.5866C22.9878 28.6922 23.1991 28.7473 23.414 28.7466C23.6964 28.7476 23.9718 28.6589 24.2006 28.4933C24.4075 28.3451 24.5676 28.1408 24.6621 27.9046C24.7566 27.6683 24.7816 27.4099 24.734 27.16L23.4006 19.5866L28.9073 14.2533C29.0998 14.0902 29.2421 13.8758 29.3176 13.6351C29.3931 13.3943 29.3988 13.1371 29.334 12.8933ZM21.134 18.2266C20.9776 18.3779 20.8606 18.5651 20.7932 18.7719C20.7258 18.9788 20.71 19.1989 20.7473 19.4133L21.7073 25L16.694 22.3333C16.501 22.2306 16.2858 22.1768 16.0673 22.1768C15.8487 22.1768 15.6335 22.2306 15.4406 22.3333L10.4273 25L11.3873 19.4133C11.4245 19.1989 11.4088 18.9788 11.3414 18.7719C11.274 18.5651 11.157 18.3779 11.0006 18.2266L7.00062 14.2266L12.614 13.4133C12.83 13.3832 13.0353 13.3007 13.212 13.1728C13.3886 13.045 13.5312 12.8757 13.6273 12.6799L16.0006 7.59995L18.5073 12.6933C18.6033 12.8891 18.746 13.0583 18.9226 13.1862C19.0993 13.314 19.3046 13.3966 19.5206 13.4266L25.134 14.24L21.134 18.2266Z" fill="#4E5365"/>
                    </svg>
                    <svg @click="rateOrder(3)" width="32" class="" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M29.334 12.8933C29.2498 12.6494 29.0966 12.4352 28.8931 12.2766C28.6895 12.1181 28.4444 12.0219 28.1873 11.9999L20.6006 10.8933L17.2006 3.99995C17.0914 3.77452 16.921 3.58441 16.7087 3.45138C16.4965 3.31836 16.2511 3.2478 16.0006 3.2478C15.7501 3.2478 15.5047 3.31836 15.2925 3.45138C15.0803 3.58441 14.9098 3.77452 14.8006 3.99995L11.4006 10.8799L3.81395 11.9999C3.56718 12.035 3.33519 12.1386 3.14429 12.2988C2.95339 12.4591 2.81123 12.6696 2.73395 12.9066C2.66321 13.1382 2.65687 13.3846 2.71559 13.6195C2.77432 13.8544 2.8959 14.0689 3.06729 14.24L8.57395 19.5733L7.24062 27.1466C7.19302 27.3966 7.21795 27.655 7.31245 27.8912C7.40695 28.1275 7.56709 28.3318 7.77395 28.4799C7.97558 28.6241 8.21339 28.7092 8.46068 28.7257C8.70798 28.7422 8.95498 28.6894 9.17395 28.5733L16.0006 25.0133L22.8006 28.5866C22.9878 28.6922 23.1991 28.7473 23.414 28.7466C23.6964 28.7476 23.9718 28.6589 24.2006 28.4933C24.4075 28.3451 24.5676 28.1408 24.6621 27.9046C24.7566 27.6683 24.7816 27.4099 24.734 27.16L23.4006 19.5866L28.9073 14.2533C29.0998 14.0902 29.2421 13.8758 29.3176 13.6351C29.3931 13.3943 29.3988 13.1371 29.334 12.8933ZM21.134 18.2266C20.9776 18.3779 20.8606 18.5651 20.7932 18.7719C20.7258 18.9788 20.71 19.1989 20.7473 19.4133L21.7073 25L16.694 22.3333C16.501 22.2306 16.2858 22.1768 16.0673 22.1768C15.8487 22.1768 15.6335 22.2306 15.4406 22.3333L10.4273 25L11.3873 19.4133C11.4245 19.1989 11.4088 18.9788 11.3414 18.7719C11.274 18.5651 11.157 18.3779 11.0006 18.2266L7.00062 14.2266L12.614 13.4133C12.83 13.3832 13.0353 13.3007 13.212 13.1728C13.3886 13.045 13.5312 12.8757 13.6273 12.6799L16.0006 7.59995L18.5073 12.6933C18.6033 12.8891 18.746 13.0583 18.9226 13.1862C19.0993 13.314 19.3046 13.3966 19.5206 13.4266L25.134 14.24L21.134 18.2266Z" fill="#4E5365"/>
                    </svg>
                    <svg @click="rateOrder(4)" width="32" class="" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M29.334 12.8933C29.2498 12.6494 29.0966 12.4352 28.8931 12.2766C28.6895 12.1181 28.4444 12.0219 28.1873 11.9999L20.6006 10.8933L17.2006 3.99995C17.0914 3.77452 16.921 3.58441 16.7087 3.45138C16.4965 3.31836 16.2511 3.2478 16.0006 3.2478C15.7501 3.2478 15.5047 3.31836 15.2925 3.45138C15.0803 3.58441 14.9098 3.77452 14.8006 3.99995L11.4006 10.8799L3.81395 11.9999C3.56718 12.035 3.33519 12.1386 3.14429 12.2988C2.95339 12.4591 2.81123 12.6696 2.73395 12.9066C2.66321 13.1382 2.65687 13.3846 2.71559 13.6195C2.77432 13.8544 2.8959 14.0689 3.06729 14.24L8.57395 19.5733L7.24062 27.1466C7.19302 27.3966 7.21795 27.655 7.31245 27.8912C7.40695 28.1275 7.56709 28.3318 7.77395 28.4799C7.97558 28.6241 8.21339 28.7092 8.46068 28.7257C8.70798 28.7422 8.95498 28.6894 9.17395 28.5733L16.0006 25.0133L22.8006 28.5866C22.9878 28.6922 23.1991 28.7473 23.414 28.7466C23.6964 28.7476 23.9718 28.6589 24.2006 28.4933C24.4075 28.3451 24.5676 28.1408 24.6621 27.9046C24.7566 27.6683 24.7816 27.4099 24.734 27.16L23.4006 19.5866L28.9073 14.2533C29.0998 14.0902 29.2421 13.8758 29.3176 13.6351C29.3931 13.3943 29.3988 13.1371 29.334 12.8933ZM21.134 18.2266C20.9776 18.3779 20.8606 18.5651 20.7932 18.7719C20.7258 18.9788 20.71 19.1989 20.7473 19.4133L21.7073 25L16.694 22.3333C16.501 22.2306 16.2858 22.1768 16.0673 22.1768C15.8487 22.1768 15.6335 22.2306 15.4406 22.3333L10.4273 25L11.3873 19.4133C11.4245 19.1989 11.4088 18.9788 11.3414 18.7719C11.274 18.5651 11.157 18.3779 11.0006 18.2266L7.00062 14.2266L12.614 13.4133C12.83 13.3832 13.0353 13.3007 13.212 13.1728C13.3886 13.045 13.5312 12.8757 13.6273 12.6799L16.0006 7.59995L18.5073 12.6933C18.6033 12.8891 18.746 13.0583 18.9226 13.1862C19.0993 13.314 19.3046 13.3966 19.5206 13.4266L25.134 14.24L21.134 18.2266Z" fill="#4E5365"/>
                    </svg>
                    <svg @click="rateOrder(5)" width="32" class="" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M29.334 12.8933C29.2498 12.6494 29.0966 12.4352 28.8931 12.2766C28.6895 12.1181 28.4444 12.0219 28.1873 11.9999L20.6006 10.8933L17.2006 3.99995C17.0914 3.77452 16.921 3.58441 16.7087 3.45138C16.4965 3.31836 16.2511 3.2478 16.0006 3.2478C15.7501 3.2478 15.5047 3.31836 15.2925 3.45138C15.0803 3.58441 14.9098 3.77452 14.8006 3.99995L11.4006 10.8799L3.81395 11.9999C3.56718 12.035 3.33519 12.1386 3.14429 12.2988C2.95339 12.4591 2.81123 12.6696 2.73395 12.9066C2.66321 13.1382 2.65687 13.3846 2.71559 13.6195C2.77432 13.8544 2.8959 14.0689 3.06729 14.24L8.57395 19.5733L7.24062 27.1466C7.19302 27.3966 7.21795 27.655 7.31245 27.8912C7.40695 28.1275 7.56709 28.3318 7.77395 28.4799C7.97558 28.6241 8.21339 28.7092 8.46068 28.7257C8.70798 28.7422 8.95498 28.6894 9.17395 28.5733L16.0006 25.0133L22.8006 28.5866C22.9878 28.6922 23.1991 28.7473 23.414 28.7466C23.6964 28.7476 23.9718 28.6589 24.2006 28.4933C24.4075 28.3451 24.5676 28.1408 24.6621 27.9046C24.7566 27.6683 24.7816 27.4099 24.734 27.16L23.4006 19.5866L28.9073 14.2533C29.0998 14.0902 29.2421 13.8758 29.3176 13.6351C29.3931 13.3943 29.3988 13.1371 29.334 12.8933ZM21.134 18.2266C20.9776 18.3779 20.8606 18.5651 20.7932 18.7719C20.7258 18.9788 20.71 19.1989 20.7473 19.4133L21.7073 25L16.694 22.3333C16.501 22.2306 16.2858 22.1768 16.0673 22.1768C15.8487 22.1768 15.6335 22.2306 15.4406 22.3333L10.4273 25L11.3873 19.4133C11.4245 19.1989 11.4088 18.9788 11.3414 18.7719C11.274 18.5651 11.157 18.3779 11.0006 18.2266L7.00062 14.2266L12.614 13.4133C12.83 13.3832 13.0353 13.3007 13.212 13.1728C13.3886 13.045 13.5312 12.8757 13.6273 12.6799L16.0006 7.59995L18.5073 12.6933C18.6033 12.8891 18.746 13.0583 18.9226 13.1862C19.0993 13.314 19.3046 13.3966 19.5206 13.4266L25.134 14.24L21.134 18.2266Z" fill="#4E5365"/>
                    </svg>
                  </div>
                </div>
              </h5>
            </div>
          </div>
          <div v-if="step === 9" class="px-10">
            <div class="pt-8">
              <div class="flex justify-center">
                <h5 class="flex">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M25 23.3334L33.3333 15.0001L25 6.66675" stroke="#4E5365" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M6.66699 33.3333V21.6667C6.66699 19.8986 7.36937 18.2029 8.61961 16.9526C9.86986 15.7024 11.5655 15 13.3337 15H33.3337" stroke="#4E5365" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                  <span class="pl-4 font-semibold"
                    style="font-style: normal;
                    font-size: 32px;
                    line-height: 40px;
                    letter-spacing: 0.12px;
                    color: #4E5365;"
                  >{{newOrderDetails.order.destinations[0].address_text.split(" ")[0]}} {{newOrderDetails.order.destinations[0].address_text.split(" ")[1]}}</span>
                </h5>
              </div>
            </div>
          </div>
        </article>
        <div class="flex mt-16 justify-center">
          <button
              style="background: #FFFFFF;
                border: 1px solid #DADBDF;
                border-radius: 8px;
                width: 60%;
                max-width: 360px;
              "
              v-if="step === 8"
              class="mx-auto py-4" @click="rerendet">Skip</button>
        </div>
        <div
            style="background: #FFFFFF;
                border-radius: 8px;
                width: 100%;
              "
            v-if="step === 9"
            class="flex mt-4 py-10 justify-center">
          <div class="flex-col">
            <h6
              style="font-style: normal;
                font-weight: normal;
                font-size: 1rem;
                line-height: 24px;
                text-align: center;
                color: #4E5365;
                opacity: 0.7;"
            >
              Ongoing Order
            </h6>
            <h6
              style="font-style: normal;
              font-weight: bold;
              font-size: 22px;
              line-height: 24px;
              text-align: center;
              color: #4E5365;
              "
              class="mt-4"
            >
              Time Not Available
            </h6>
            <div class="flex justify-center pt-4 mt-5">
              <div class="mx-8" >
                <svg @click="showContact = !showContact" width="48" class="mx-auto" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="24" cy="24" r="23.5" stroke="#EAEAEA"/>
                  <path d="M27.7134 24.7093C28.6986 23.9384 29.4178 22.8813 29.7708 21.685C30.1237 20.4887 30.093 19.2128 29.6829 18.0346C29.2727 16.8565 28.5036 15.8348 27.4823 15.1117C26.4611 14.3886 25.2387 14 23.9851 14C22.7315 14 21.509 14.3886 20.4878 15.1117C19.4666 15.8348 18.6975 16.8565 18.2873 18.0346C17.8772 19.2128 17.8464 20.4887 18.1994 21.685C18.5524 22.8813 19.2715 23.9384 20.2568 24.7093C18.5686 25.382 17.0955 26.4976 15.9947 27.9374C14.8939 29.3771 14.2066 31.0869 14.0061 32.8846C13.9915 33.0159 14.0032 33.1487 14.0403 33.2754C14.0773 33.4022 14.1392 33.5205 14.2222 33.6235C14.39 33.8316 14.6339 33.9648 14.9005 33.994C15.167 34.0231 15.4342 33.9458 15.6434 33.779C15.8526 33.6122 15.9866 33.3695 16.0159 33.1045C16.2366 31.1508 17.1733 29.3465 18.6471 28.0362C20.1209 26.7259 22.0284 26.0016 24.0052 26.0016C25.982 26.0016 27.8895 26.7259 29.3633 28.0362C30.8371 29.3465 31.7738 31.1508 31.9944 33.1045C32.0218 33.3501 32.1396 33.5769 32.3252 33.7411C32.5108 33.9054 32.751 33.9955 32.9994 33.994H33.1099C33.3734 33.9638 33.6141 33.8314 33.7798 33.6254C33.9454 33.4195 34.0225 33.1568 33.9943 32.8946C33.7928 31.0918 33.1018 29.3776 31.9953 27.9357C30.8888 26.4937 29.4087 25.3784 27.7134 24.7093ZM23.9851 23.9997C23.1901 23.9997 22.4129 23.7653 21.7518 23.326C21.0908 22.8867 20.5756 22.2624 20.2713 21.5319C19.9671 20.8014 19.8875 19.9976 20.0426 19.2221C20.1977 18.4466 20.5805 17.7343 21.1427 17.1752C21.7049 16.6161 22.4211 16.2354 23.2009 16.0812C23.9806 15.9269 24.7889 16.0061 25.5234 16.3086C26.2579 16.6112 26.8857 17.1236 27.3274 17.781C27.7691 18.4385 28.0048 19.2114 28.0048 20.002C28.0048 21.0623 27.5813 22.0791 26.8275 22.8288C26.0736 23.5785 25.0512 23.9997 23.9851 23.9997Z" fill="#4E5365"/>
                </svg>
                <h6
                    @click="showContact = !showContact"
                    style="font-style: normal;
                      font-weight: normal;
                      font-size: 12px;
                      line-height: 16px;
                      letter-spacing: 0.12px;
                      text-align: center;
                      color: #4E5365;"
                    class="mb-3">Contact</h6>
                <small @click.prevent class="bg-white mt-8 py-1 px-5 contact-tel" v-if="showContact">{{newOrderDetails.order.order_rider.rider.user.telephone}}</small>
              </div>
            </div>
          </div>
        </div>
        <div class="flex mt-4 lg:mt-10" v-if="step === 1">
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
    <div class="address" v-else-if="nownowtime">
      <h4 CLASS="w-full text-center mt-56 text-3xl font-extrabold bg-white py-12 text-red-600">
        WE ARE CURRENTLY NOT ACCEPTING ORDERS
      </h4>
    </div><div class="address" v-else>
      <h4 CLASS="w-full text-center mt-56 text-3xl font-extrabold bg-white py-12 text-red-600">
        WE ARE CURRENTLY NOT ACCEPTING ORDERS
      </h4>
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
      settings: [],
      name: "",
      refFinal: "",
      startLocation: {
        lat: null,
        lng: null
      },
      step: 0,
      deliveryType: "",
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
      order: [],
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
      addNote: "",
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
      newOrderDetails: null,
      modalVisible: false,
      showContact: false,
      nownowtime: "",
      maxOrders: 3,
      numberOfOrders: 0,
      otherDestinations: []
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
  mounted() {
    this.settings = JSON.parse(localStorage.getItem('settings'));
    let currentDate = new Date()

    let startDate = new Date(currentDate.getTime());
    startDate.setHours(this.settings.bike_availability_time.open.split(":")[0]);
    startDate.setMinutes(this.settings.bike_availability_time.open.split(":")[1]);

    let endDate = new Date(currentDate.getTime());
    endDate.setHours(this.settings.bike_availability_time.close.split(":")[0]);
    endDate.setMinutes(this.settings.bike_availability_time.close.split(":")[1]);
    console.log(startDate)
    console.log(currentDate)
    console.log(endDate)

    let valid = startDate < currentDate && endDate > currentDate
    console.log(valid)
    this.nownowtime = valid;
  },
  methods: {
    changeNumberOfOrders() {
      if (this.numberOfOrders < this.maxOrders) {
        this.numberOfOrders = this.numberOfOrders + 1;
      }
    },
    addDestination(event, index) {
      console.log(event)
      console.log(index)
      this.otherDestinations[index] = event
      console.log(this.otherDestinations)
    },
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
    deliveryTypeChoose() {
      if (this.deliveryType === "") {
        this.$swal(
            "You have to choose a delivery type",
            "",
            "error"
        )
      } else {
        console.log(this.deliveryType)
        if (this.deliveryType === "sender") {
          this.started();
          this.editPickUp = false;
          this.editPrevioudDestination = false;
          this.destination = {};
        } else if (this.deliveryType === "receiver") {
          this.changeEdit();
          const addressText = JSON.parse(localStorage.getItem('user')).address_text.split(",");
          this.destination = {};
          this.destination.vicinity = addressText[1].trim();
          this.destination.geometry = {};
          this.destination.geometry.location = [];
          this.destination.geometry.location.lat = 2.4343;
          this.destination.geometry.location.lng = 2.4343;
          this.destination.formatted_address = JSON.parse(localStorage.getItem('user')).address_text;
          this.destination.formatted_address = JSON.parse(localStorage.getItem('user')).address_text;
          this.editPrevioudDestination = true;
        } else if (this.deliveryType === "third") {
          this.started();
          this.editPickUp = false;
          this.editPrevioudDestination = false;
          this.destination = {};
          this.changeEdit();
        }
        this.step = 1;
      }
    },
    changePreviousDestinationEdit() {
      if (this.editPrevioudDestination) {
        this.destination = []
      }
      this.editPrevioudDestination = !this.editPrevioudDestination;
    },
    rerendet() {
      if (this.step === 6) {
        httpClient.put(`orders/${this.order.id}`, {
          status: "cancelled"
        })
      }
      this.name= ""
      this.deliveryType = ""
      this.startLocation= {
        lat: null,
        lng: null
      },
      this.step= 0;
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
      console.log(this.destination);
      let secondArray = [];
      secondArray = [{
        destination: this.destination,
        recipient_name: this.receipientName,
        recipient_telephone: this.receipientTel,
        category: this.category,
        fragile: this.fragile,
        address_lat: this.addNote,
      }];
      if (this.numberOfOrders > 0) {
        console.log("ash")
        for (let i = 0; i < this.otherDestinations.length; i++) {
          console.log(this.otherDestinations[i], "ojhjkhjhj")
          if (typeof this.otherDestinations[i] === 'object') {
            console.log(this.otherDestinations[i], "ojhjkhjhj")
            secondArray.push(
                {
                  destination: this.otherDestinations[i],
                  recipient_name: this.receipientName,
                  recipient_telephone: this.receipientTel,
                  category: this.category,
                  fragile: this.fragile,
                  address_lat: this.addNote,
                }
            )
          }
        }
        console.log(secondArray, "ddddd");
        dataForm['order_destinations'] = secondArray;
      } else {
        dataForm['order_destinations'] = [{
          destination: this.destination,
          recipient_name: this.receipientName,
          recipient_telephone: this.receipientTel,
          category: this.category,
          fragile: this.fragile,
          address_lat: this.addNote,
        }];
      }
      httpClient.post('orders', dataForm)
      .then((response) => {
        this.order = response.data.data.order;
        this.step = 6;
        let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for( let i=0; i < 10; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));
        this.refFinal = text;
        window.Echo.channel('orders-' + response.data.data.order.id)
            .listen('.orders', (e) => {
              console.log(e)
              if (e.order.order_rider === null) {
                this.notify(
                    "Your order status is now " + e.order.status,
                    "warning"
                )
                this.rerendet()
                this.step = 0;
              } else {
                this.newOrderDetails = e;
                if (this.newOrderDetails.order.status === 'delivered') {
                  this.step = 8;
                } else if (
                    this.newOrderDetails.order.status === 'picked_up'
                ) {
                  this.step = 9;
                } else {
                  this.step = 7;
                }
              }
            });
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
        if (this.numberOfOrders > 0) {
          const finalUrl = `https://maps.googleapis.com/maps/api/distancematrix/json?origins=${this.finalPickUp}&destinations=${this.otherDestinations[1]['formatted_address']}&key=AIzaSyCNL1Mzob3HzKiPtt9nB4su5XXxr_JqGik`;
          let firstResponse = response;
          httpClient.post("orders/calculate/distance", {
            url: finalUrl
          })
            .then(response => {
              console.log(response);
              this.distanceTotal = response.data['rows'][0]['elements']['0']['distance']['value'];
              let distanceTotalSecond = firstResponse.data['rows'][0]['elements']['0']['distance']['value'];
              console.log(this.distanceTotal, distanceTotalSecond);
              console.log((this.distanceTotal + distanceTotalSecond) / 100);
              if (this.settings.delivery_price_rate.kilometers.use === true) {
                this.amount = ((this.distanceTotal / 100) * this.settings.delivery_price_rate.kilometers.rate).toFixed(2)
                this.amount = this.amount + ((distanceTotalSecond / 100) * this.settings.delivery_price_rate.kilometers.rate).toFixed(2)
              } else {
                this.amount = ((this.distanceTotal / 100) * 85).toFixed(2)
                this.amount = this.amount +  ((distanceTotalSecond / 100) * this.settings.delivery_price_rate.kilometers.rate).toFixed(2)
              }
              if (this.settings.delivery_price_rate.time.use === true) {
                this.amount = ((this.distanceTotal / 100) * this.settings.delivery_price_rate.time.rate).toFixed(2)
                this.amount = this.amount +  ((distanceTotalSecond / 100) * this.settings.delivery_price_rate.time.rate).toFixed(2)
              } else {
                this.amount = (((this.distanceTotal + distanceTotalSecond) / 100) * 85).toFixed(2)
                this.amount = this.amount +  ((distanceTotalSecond / 100) * this.settings.delivery_price_rate.time.rate).toFixed(2)
              }
            })
        } else {
          this.distanceTotal = response.data['rows'][0]['elements']['0']['distance']['value'];
          console.log("dfsafskdj");
          if (this.settings.delivery_price_rate.kilometers.use === true) {
            this.amount = ((this.distanceTotal / 100) * this.settings.delivery_price_rate.kilometers.rate).toFixed(2)
          } else {
            this.amount = ((this.distanceTotal / 100) * 85).toFixed(2)
          }
          if (this.settings.delivery_price_rate.time.use === true) {
            this.amount = ((this.distanceTotal / 100) * this.settings.delivery_price_rate.time.rate).toFixed(2)
          } else {
            this.amount = ((this.distanceTotal / 100) * 85).toFixed(2)
          }
        }
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
      if (this.otherDestinations.length < this.numberOfOrders) {
        this.notify("Kindly set all destination addresses", "error", 'bottom')
        return false
      }
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
    },
    cancelOrder() {
      httpClient.post(`orders/${this.newOrderDetails.order['id']}`, {
        status: 'cancelled'
      }).then(() => {
        this.notify("Order cancelled", "success");
        this.$router.push({name: 'cancelled'})
      })
    },
    rateOrder(rate) {
      httpClient.post(`rate-order`, {
        id: this.newOrderDetails.order.id,
        rate: rate
      }).then(() => {
        this.notify("Order rated", "success");
        this.rerendet();
        this.step = 0
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.swal2-styled.swal2-deny {
  background: #F03737 !important;
  border-radius: 8px !important;
}
//@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap");

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

@font-face {
  font-family: 'AirbnbCereal';
  font-weight: 300;
  src: url("../assets/fonts/AirbnbCerealLight.woff");
}

@font-face {
  font-family: 'AirbnbCereal';
  font-weight: 400;
  src: url("../assets/fonts/AirbnbCerealBook.woff");
}

@font-face {
  font-family: 'AirbnbCereal';
  font-weight: 500;
  src: url("../assets/fonts/AirbnbCerealMedium.woff");
}

@font-face {
  font-family: 'AirbnbCereal';
  font-weight: 600;
  src: url("../assets/fonts/AirbnbCerealBold.woff");
}

@font-face {
  font-family: 'AirbnbCereal';
  font-weight: 700;
  src: url("../assets/fonts/AirbnbCerealExtraBold.woff");
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
  font-family: AirbnbCereal, sans-serif;
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
  font-family: AirbnbCereal, sans-serif;
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

.arrow-back {
  position: relative;
  left: -5rem;
  background-color: white;
  height: 72px;
  border-radius: 50%;
  box-shadow: 0px 6.27323px 25.0929px rgba(96, 100, 112, 0.1);
}

.star-things {
  position: absolute !important;
  bottom: 0;
  width: 64px;
  background-color: #E1ECC5;
  border-radius: 5.25px;
  color: rgba(124,154,50,1);
}

.contact-tel {
  box-shadow: 0px 6.46667px 25.8667px rgba(96, 100, 112, 0.1);
  border-radius: 8px;
}
</style>
