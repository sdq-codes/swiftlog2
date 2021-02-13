<template>
  <div>

    <main class=" font-body w-full lg:text-sm overflow-hidden">
      <form class="my-16 grid grid-cols-1 place-items-center ">

        <div class="mt-8 px-8 sm:px-12 lg:px-0 lg:w-3/6 xl:w-2/6 mx-auto">
          <div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-left">
              Contact Us
            </h2>
          </div>
          <div>
            <p class="text-base opacity-50 mt-4 text-left w-4/5 lg:w-4/5">
              Feel like contacting us? Submit your queries here and we will get back to you as
              soon as possible.
            </p>
          </div>

          <h3 class=" text-lg md:text-xl font-bold opacity-50 mt-16">Send us a message</h3>

          <div class="mt-8 ">
            <input
                type="text"
                id="First Name"
                placeholder="First Name"
                class=" placeholder-gray-500 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"/>

            <input
                type="text"
                id="lastname"
                placeholder="Last Name"
                class=" placeholder-gray5600 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"/>

            <input
                type="email"
                id="Email Address"
                placeholder="Email Address"
                class=" placeholder-gray-500 border-gray-500 border-2 w-full p-4 my-4 focus:outline-none"/>

            <vue-tel-input class="no-outline placeholder-gray-500 border-gray-500 border-2 w-full p-4 my-4 bg-white focus:outline-none" v-model="phone"></vue-tel-input>

            <textarea
                placeholder="Message"
                rows="7"
                cols="5"
                class="  transition-all duration-500 w-full pl-2 my-4 md:pl-8 py-4 border-2 border-gray-500 focus:outline-none focus:shadow-lg focus:border-white"/>

            <input
                type="submit"
                id="submit"
                value="Submit"
                class="my-4  w-full md:w-5/5 mx-auto sm:mx-0  bg-primary-green p-4 text-white font-normal rounded cursor-pointer btn-secondary lg:ml-0"/>

          </div>
        </div>
      </form>
    </main>

  </div>
</template>

<script>
export default {
  name: "Contact",
  data() {
    return {
      phone: 90909989
    }
  }
}
</script>

<style scoped>
  main {
    background-color: white !important;
  }

  input, .no-outline {
    outline: none !important;
  }
</style>