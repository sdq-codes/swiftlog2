<template>
  <div>
    <main class=" font-body w-full lg:text-sm overflow-hidden">
      <div data-aos="fade-up" class="grid grid-cols-1 md:grid-cols-2 py-24">
        <div class="">
          <div class="ml-auto h-full w-5/6 flex flex-col justify-center items-start mr-6 pr-32 pl-">
            <div class="h-1 w-20 bg-primary-purple"></div>
            <h4 class="text-xl md:text-3xl font-normal mt-5">About Us</h4>
            <h1 class="text-2xl md:text-4xl xl:text-5xl opacity-50 mt-4 mb-8">Company Slogans</h1>
            <p class="text-xl opacity-75 mt-4">
              lorem ipsum Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. <br>
              Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. <br>
              lorem ipsum Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.
            </p>
          </div>
        </div>
        <div data-aos="fade-left">
          <img src="../../assets/images/User-Rider.png" alt="Swift Logistics Rider" class="hidden md:block ml-auto"/>
        </div>
      </div>
    </main>

  </div>
</template>

<script>
export default {
  name: "About"
}
</script>

<style scoped>
 main {
   background-color: white !important;
 }
</style>