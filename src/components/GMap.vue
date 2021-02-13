<template>
  <div :class="gmapClassMap">
<!--    <vue-google-autocomplete
        id="map"
        classname="text-sm md:text-base focus:bg-white placeholder-gray-600 border-gray-500 border-2 w-full py-2 pb-0 px-0 mb-0 focus:outline-none"
        placeholder="Enter Address"
        v-on:placechanged="getAddressData"
    >
    </vue-google-autocomplete>-->
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
    <small class="text-muted mb-auto w-12/12 pt-1 pr-4 text-address " v-if="addressData !== '' && 'country' in addressData">{{ `${addressData.locality}, ${addressData.country}` }}</small>
  </div>
</template>

<script>
import { GooglePlacesAutocomplete } from "vue-better-google-places-autocomplete";
// import VueGoogleAutocomplete from 'vue-google-autocomplete'
export default {
  name: "GMap",
  components: {GooglePlacesAutocomplete},
  props: [ 'gmapClassMap', 'vicinity' ],
  data() {
    return {
      place: [],
      addressData: ""
    }
  },
  watch: {
    addressData(newValue) {
      this.$emit('changeInValue', newValue)
    },
    place(newValue) {
      this.$emit('changeInValue', newValue)
    }
  },
  methods: {
    /*eslint-disable */
    getAddressData(addressData, placeResultData, id) {
      this.addressData = addressData;
    },
    /*eslint-enable */
  }
}
</script>

<style scoped>
 .my-4 {
   padding: 0;
 }

 input {
   border: none;;
 }

</style>