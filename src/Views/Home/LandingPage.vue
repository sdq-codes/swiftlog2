<template>
  <main
      class="font-body bg-primary-blue-light w-full lg:text-sm overflow-hidden"
  >
    <Section
        class="relative home-landing pb-32 min-h-screen w-full bg-primary-purple"

    >
      <div class="home-content grid grid-cols-1 lg:grid-cols-2 pt-16">
        <div data-aos="fade-up" class="pt-4 md:pt-12 pl-5 pr-5">
          <h1
              class="text-3xl md:text-4xl xl:text-6xl font-bold text-white "
          >
            Get your Packages
            <br />
            delivered
            <span class="text-primary-green"> swiftly.</span>
          </h1>
          <div class="ml-auto w-11/12 xl:w-10/12 mr-8 mt-4">
            <p
                class="text-lg md:text-xl xl:text-2xl text-white  capitalize "
            >
              Make deliveries easily and Quickly. The Best Logistics Service
              in Lagos
            </p>
            <div class="flex fle flex-auto justify-start items-center mt-8">
              <img
                  src="../../assets/images/appstore-new.png"
                  alt="AppStore"
                  class=" object-cover w-32 lg:w-40 mr-4 md:mr-8 lg:mr-12"
              />
              <img
                  src="../../assets/images/playstore-new.png"
                  alt="AppStore"
                  class=" object-cover w-32 lg:w-40"
              />
            </div>
          </div>
        </div>

        <div
            data-aos="fade-left"
            class="lg:flex justify-center items-center z-10 hidden"
        >
          <img
              src="../../assets/images/swift-logistics-home-iphone.png"
              alt="Swift logistics home"
          />
        </div>
      </div>
    </Section>

    <div
        class="floating__div transform lg:-translate-y-64 xl:-translate-y-48 rounded-br-sm  lg:rounded-tr-custom lg:w-11/12 xl:w-5/6 bg-white pb-40 lg:pt-24"
    >
      <div
          class="flex flex-col justify-center items-start ml-4 md:ml-12 lg:ml-16 lg:pl-40 pb-8 pt-16 lg:3/5 xl:w-4/5"
      >
        <h3 class="text-primary-purple text-lg font-light ">FEATURES</h3>
        <h1 class="text-5xl font-bold mt-8">
          The best delivery service in your hands
        </h1>
        <div
            data-aos="fade-up"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-6 mt-5"
        >
          <div class="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
            <img src='../../assets/images/swift-logistics-rider.svg' alt='rider' class="object-cover"/>
            <p class="mt-4 font-bold text-base">Verified Riders</p>
            <p class="mt-4 text-base w-5/6">All Riders have been verified for the safety of your packages</p>
          </div>
          <div class="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
            <img src='../../assets/images/track.svg' alt='rider' class="object-cover"/>
            <p class="mt-4 font-bold text-base">Track Orders</p>
            <p class="mt-4 text-base w-5/6">Track your orders using the mobile application</p>
          </div>
          <div class="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
            <img src='../../assets/images/credit-card.svg' alt='rider' class="object-cover"/>
            <p class="mt-4 font-bold text-base">Payment</p>
            <p class="mt-4 text-base w-5/6">Payments have been made easy for the users</p>
          </div>
          <div class="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
            <img src='../../assets/images/swift-logistics-rider.svg' alt='rider' class="object-cover"/>
            <p class="mt-4 font-bold text-base">Verified Riders</p>
            <p class="mt-4 text-base w-5/6">All Riders have been verified for the safety of your packages</p>
          </div>
          <div class="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
            <img src='../../assets/images/swift-logistics-rider.svg' alt='rider' class="object-cover"/>
            <p class="mt-4 font-bold text-base">Verified Riders</p>
            <p class="mt-4 text-base w-5/6">All Riders have been verified for the safety of your packages</p>
          </div>
          <div class="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
            <img src='../../assets/images/swift-logistics-rider.svg' alt='rider' class="object-cover"/>
            <p class="mt-4 font-bold text-base">Verified Riders</p>
            <p class="mt-4 text-base w-5/6">All Riders have been verified for the safety of your packages</p>
          </div>
        </div>
      </div>
    </div>

    <section
        class="offering max-h-full grid pt-16 lg:pt-0 gap-2 justify-center items-center w-full grid-cols-1 lg:grid-cols-2"
    >
      <div data-aos="fade-up" class="w-full mx-auto md:w-4/5">
        <img src="../../assets/images/macbook-air.png" alt="macbook-air" />
      </div>

      <div
          data-aos="fade-left"
          class="flex flex-col justify-center items-center md:items-start md:ml-auto mx-auto mt-8 place-self-start"
      >
        <h1
            class="text-grey-heading  text-xl font-bold md:text-2xl lg:text-3xl xl:text-4xl lg:text-left"
        >
          Did you know?
        </h1>

        <p
            class="mt-4 text-xl text-grey-body text-center lg:text-left lowercase lg:w-3/4"
        >
          You CAN ESTIMATE THE COST OF your next DELIVERy or pickup order.
        </p>

        <div class="header__buttons mt-6 flex flex-col lg:flex-row ">
          <Button
              router-router-link="/form"
              value="Estimate"
              css="text-xl font-normal "
          />
          <router-link
              :to="{ name: 'register' }"
              class='btn-primary text-white bg-primary-green border-4 p-2 px-6 border-primary-green font-semibold rounded text-xl font-normal  hover:shadow-md focus:outline-none'>
            Estimate
          </router-link>
        </div>
      </div>
    </section>


    <section
        data-aos="fade-up"
        class="my-16 md:my-12 lg:my-16 p-8 md:py-12 lg:py-16 px-4 md:px-12 "
    >
      <h4
          class="pb-8 text-sm text-center font-semibold text-primary-purple capitalize"
      >
        TESTIMONIALS
      </h4>

      <h1 class="pb-8 font-bold text-4xl text-center">
        What they say about us
      </h1>
      <VueSlickCarousel :arrows="true" :dots="true">
        <div data-aos="fade-left" class="flex flex-col justify-start items-start w-12/12 md:w-5/6 lg:4/6 xl:w-3/6 bg-white mx-auto p-2 md:p-8 rounded-lg">
          <div>
            <star-rating :rating="5" :star-size="35" />
            <!--<FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF2' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            -->
          </div>

          <p class="font-semibold text-xs md:text-base opacity-50 mt-4">
            “This is a fantastic app for sellers who intend to deliver packages. God bless who made this app, i dont want to imagine what woud have happened if i didnt use this app to deliver meals to my customers. This logistics service is quick. Highly recommended”.
          </p>

          <div class="flex justify-center items-center mt-4">
            <img src="../../assets/images/lernen-biology.png" alt="Biology" class="h-12 w-12 rounded-full object-cover mr-4"/>
            <div>
              <p class="font-bold text-xs md:text-base opacity-75">Peter Coates</p>
              <p class="opacity-50 text-xs md:text-base">Caterer</p>
            </div>
          </div>

        </div>
        <div data-aos="fade-left" class="flex flex-col justify-start items-start w-12/12 md:w-5/6 lg:4/6 xl:w-3/6 bg-white mx-auto p-2 md:p-8 rounded-lg">
          <div>
            <star-rating :rating="5" :star-size="35" />
            <!--<FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF2' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            <FontAwesomeIcon icon="star" class="text-sm md:text-base lg:text-xl mr-2 mt-1 w-6 h-6 " :style="{ color: '#FCBF29' }" />
            -->
          </div>

          <p class="font-semibold text-xs md:text-base opacity-50 mt-4">
            “This is a fantastic app for sellers who intend to deliver packages. God bless who made this app, i dont want to imagine what woud have happened if i didnt use this app to deliver meals to my customers. This logistics service is quick. Highly recommended”.
          </p>

          <div class="flex justify-center items-center mt-4">
            <img src="../../assets/images/lernen-biology.png" alt="Biology" class="h-12 w-12 rounded-full object-cover mr-4"/>
            <div>
              <p class="font-bold text-xs md:text-base opacity-75">Peter Coates</p>
              <p class="opacity-50 text-xs md:text-base">Caterer</p>
            </div>
          </div>

        </div>
      </VueSlickCarousel>
    </section>

    <Section
        class="relative home-landing mt-20 md:mt-32 lg:mt-64 w-full bg-primary-blue pl-5 pr-5"
    >
      <div
          data-aos="fade-up"
          class="home-offering max-h-full py-12 pt-2 md:pt-12"
      >
        <div class="home-content grid  lg:grid-cols-2 mt-16">
          <div class="md:pb-12 pt-8 md:pt-12 lg:ml-24">
            <h1
                class="text-2xl md:text-4xl xl:text-6xl font-bold text-white "
            >
              What are you waiting for?
              <br />
              Download now for free
            </h1>
            <div class="ml-auto w-11/12 xl:w-10/12 mr-8 mt-6 lg:mt-12">
              <p
                  class="text-base md:text-xl xl:text-2xl text-white  capitalize "
              >
                Make deliveries easily and quickly. The Best Logistics
                Service in Lagos
              </p>
              <div class="flex justify-start items-center mt-8">
                <img
                    src="../../assets/images/appstore-new.png"
                    alt="AppStore"
                    class=" object-cover w-32 lg:w-40 mr-4 md:mr-8 lg:mr-12"
                />
                <img
                    src="../../assets/images/playstore-new.png"
                    alt="AppStore"
                    class=" object-cover w-32 lg:w-40"
                />
              </div>
            </div>
          </div>

          <div
              class="lg:flex justify-center items-center z-10 transform -translate-y-56 hidden"
          >
            <img
                src="../../assets/images/iphone.png"
                alt="Swift logistics home"
            />
          </div>
        </div>
      </div>
    </Section>
  </main>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import StarRating from 'vue-star-rating'
import httpClient from "@/utils/api/httpClient";
export default {
name: "LandingPage",
  components: { VueSlickCarousel, StarRating },
  mounted() {
    this.visitors()
  },
  methods: {
    visitors() {
      this.inloadress= true
      httpClient.get("blog/post")
          .then((response => {
            this.allVisitors = response.data.data['stats'][0]
            this.returnees = response.data.data['stats'][1]
            this.blogStats = response.data.data['stats'][2]
          }))
          .finally(() => {
            this.inloadress = false
          })
    }
  }
}
</script>

<style scoped>
.vue-star-rating-rating-text{
  display: none !important;
}

</style>