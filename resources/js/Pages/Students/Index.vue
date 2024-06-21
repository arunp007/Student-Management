<script setup>

import 'bootstrap/dist/css/bootstrap.min.css';
import pagination from "@/Components/Pagination.vue";
import { Link, usePage, useForm, router } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons'; 

library.add(fas);



defineProps({
    students: {
        type: Object,
        required: true,
    },
    
});

let search = ref(""), pageNumber = ref(1);

let studentsUrl = computed(() => {
    let url = new URL(route("students.index"));
    url.searchParams.append('page', pageNumber.value)

    if(search.value){
        url.searchParams.append("search", search.value)
    }

    return url;

});

watch(() => studentsUrl.value,
(updatedStudentUrl) => {
    router.visit('updatedStudentUrl'),{
        preserveScroll: true,
        preserveState: true,
        replace: true,
    }

})

const deleteForm = useForm([]);

const deleteStudent = (studentId) => {
    if(confirm('Are you sure you want to delete this student ?')){
        deleteForm.delete(route('students.destroy', studentId));
    }

}

console.log(usePage().props.students);
</script>



<template>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" :href="'/dashboard'">STUDENT MANAGEMENT SYSTEM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>

    <div class="bg-grey-100 py-10">
        <div class="mx-auto max-w-7xl">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-grey-900">
                            Students
                        </h1>

                        <p class="mt-2 text-sm text-grey-700">
                            A list of all the Students.
                        </p>

                        <input v-model="search" class="search" type="text" name="" id="" placeholder="Search student data.."> <button class="search-button"><font-awesome-icon icon="search"></font-awesome-icon></button>

                    </div>
                    <Link as="link" :href="route('students.create')" class="btn btn-primary">Add Students</Link>
                </div>
                <table class="table table-light border-2">
                        <tr class="border-2">
                            <th>Id</th>
                            <th>Class Name</th>
                            <th>Session Name</th>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Created at</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>

                        <tr v-for="student in students.data" :key="student.id">
                            <td>{{ student.id }}</td>
                            <td>{{ student.class.name }}</td>
                            <td>{{ student.section.name }}</td>
                            <td>{{ student.name }}</td>
                            <td>{{ student.email }}</td>
                            <td>{{ student.created_at }}</td>
                            <td><button @click="deleteStudent(student.id)">Delete</button></td>
                            <td><Link as="link" class="btn btn-link" :href="route('students.edit', student.id)">Edit</Link></td>
                        </tr>
                </table>
            </div>
            <pagination></pagination>
        </div>
    </div>
</template>

<style scoped>
    .btn-primary{
        margin-bottom: 100px !important; 
    }

    table{
        width: 1000px !important;
    }

    .navbar-brand{
        margin-left: 20px !important;
    }

    .search{
        border-radius: 100px;
        margin-top: 10px !important;
        margin-bottom: 30px !important;
        width: 250px;
    }

    .search-button{
        position: flex;
        margin-left: -40px !important;
       
    }
</style>
