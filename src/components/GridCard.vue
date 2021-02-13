<template>
  <div className="flex flex-col justify-center items-center md:items-start lg:w-4/5 xl:5/5 mr">
    <img src={props.image} alt={props.image} className="object-cover"/>
    <p className="mt-4 font-bold text-base">{props.title}</p>
    <p className="mt-4 text-base w-5/6">{props.text}</p>
  </div>
</template>

<script>
export default {
  name: "GridCard",

}
</script>

<style scoped>

</style>