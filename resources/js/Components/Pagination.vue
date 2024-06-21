<template>
  <div class="overflow-auto">
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="my-table"
    ></b-pagination>

    <p class="mt-3">Pages: <a href="http://127.0.0.1:8000/students?page=1" class="text-decoration-none">1</a>  <a href="http://127.0.0.1:8000/students?page=2" class="text-decoration-none">2</a>  <a href="http://127.0.0.1:8000/students?page=3" class="text-decoration-none">3</a>  <a href="http://127.0.0.1:8000/students?page=4" class="text-decoration-none">4</a>  <a href="http://127.0.0.1:8000/students?page=5" class="text-decoration-none">5</a>  <a href="http://127.0.0.1:8000/students?page=6" class="text-decoration-none">6</a> <a href="http://127.0.0.1:8000/students?page=7" class="text-decoration-none">7</a> <a href="http://127.0.0.1:8000/students?page=8" class="text-decoration-none">8</a> <a href="http://127.0.0.1:8000/students?page=9" class="text-decoration-none">9</a> <a href="http://127.0.0.1:8000/students?page=10" class="text-decoration-none">10</a> <a href="http://127.0.0.1:8000/students?page=11" class="text-decoration-none">11</a></p>

    <b-table
      id="my-table"
      :items="items"
      :per-page="perPage"
      :current-page="currentPage"
      small
    ></b-table>
  </div>
</template>

<script setup>
  import { router } from "@inertiajs/vue3";

  defineProps({
    data: {
        type: Object,
    },
    pageNumberUpdated: {
        type: Function,
        required: true,
    },
  });

  const current_page = '/students?&page=${pageNumber}'
   
</script>
