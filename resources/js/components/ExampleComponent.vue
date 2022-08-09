<template>
    <div class="news-container">
        <div v-for="(item, remote_id) in news" class="news">
            <router-link :to="{ name: 'news', params: { id: item.id, news: JSON.stringify(item) }}">
                <div>{{item.id}}</div>
                <div>{{item.title}}</div>
                <div>{{item.link}}</div>
                <div>{{item.description}}</div>
                <div>{{item.rbc_date}}</div>
                <div>{{item.rbc_time}}</div>
            </router-link>
        </div>
    </div>
</template>

<script>
import { onMounted, defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'ExampleComponent',
  setup () {
    const news = ref(null)
    onMounted(() => {
        axios
        .get('http://localhost/back/api/rbk-parser')
        .then((response) => {
            news.value = response.data;
        })
    })
    return {
      news
    }
  }
})
</script>

<style>
.news {
    background-color: rgb(167, 229, 233);
    margin-top: 50px;
    margin-right: 20px;
    margin-left: 20x;
    border-radius: 10px;
    width: 600px;
    cursor: pointer;
}

.news-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
}
</style>
