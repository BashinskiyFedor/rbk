<template>
    <div class="content">
        <h1>{{news.title}}</h1>
        <div>{{news.rbc_time + " " + news.rbc_date}}</div>
        <div>{{news.full_text}}</div>
        <div v-for="(image, id) in news.image" :key="id">
            <img class="image" :src="image.link"/>
        </div>
    </div>
</template>

<script>
import { onMounted, defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'NewsComponent',
  props: {
      id: Number,
      news: Object
  },
  setup () {
    // const news = ref(null)
    // onMounted(() => {
    //     axios
    //     .get('http://localhost/back/api/rbk-parser')
    //     .then((response) => {
    //         news.value = response.data;
    //     })
    // })
    return {
      // news
    }
  }
})
</script>

<style>
.content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.image {
    width: 500px;
    height: 500px;
}
</style>
