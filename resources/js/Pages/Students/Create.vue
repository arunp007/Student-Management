<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";


defineProps({
  classes: {
    type: Object,
    required: true,
  },
});

let sections = ref([]);


const form = useForm({
  name: "",
  email: "",
  class_id: "",
  section_id: "",
});

watch(
  () => form.class_id, 
  (newValue) => {
  getSections(newValue);
  }
);

const getSections = (classId) => {
  axios.get('/api/sections?class_id=' + classId).then((response) => {
    sections.value = response.data;
  });
  
};

const submit = () => {
    form.post(route("students.store"), {
        preserveScroll: true,
    });
};


</script>
<template>
    <div class="form-wrapper"> <!-- Single root element wrapping the entire content -->
      <div class="form-container">
        <h1>Create Student</h1>
        <form @submit.prevent="submit" :method="post">
          <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" v-model="form.name" placeholder="Name"  :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.name, }" required />
          
            <InputError :message="form.errors.name" class="mt-2"/> 
          
          </div>
          
  
          <div class="form-group">
            <label for="email">Email Id:</label>
            <input type="email" id="email" name="email" v-model="form.email" placeholder="Email" :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.email, }" required />
          
            <InputError :message="form.errors.email" class="mt-2"/> 

          </div>
  
          <div class="form-group">
            <label for="class">Class:</label>
            <select id="class" name="class" v-model="form.class_id" :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.class_id, }" required>
                <option value="">Select Class</option>
                <option v-for="item in classes.data" :key="item.id" :value="item.id">{{ item.name }}</option>
                
            </select>
            
            <InputError :message="form.errors.class_id" class="mt-2"/> 

          </div>

          <div class="form-group">
            <label for="section">Section:</label>
            <select id="section" name="section" v-model="form.section_id" :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.name, }" required>
                <option value="">Select Section</option>
                <option v-for="section in sections.data" :key="section.id" :value ="section.id">{{ section.name }}</option>
                
            </select>

            <InputError :message="form.errors.session_id" class="mt-2"/> 
            
          </div>
  
          <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </template>
  
  
  
  <style scoped>
    h1{
      font-size: 25px;
      margin-bottom: 20px;
      text-align: center;
    }
  .form-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  
  .form-container {
    width: 500px !important;
    height: 500px !important;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
   
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input, textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: auto;
    margin-right: auto;
    display: block;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>