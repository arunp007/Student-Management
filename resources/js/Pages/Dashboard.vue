<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student Management System</h2>
            
        </template>

        

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Welcome To Student Management System...</div>
                    <a class="btn btn-link" :href="'/students'">View Students</a><br>
                    <a class="btn btn-link" :href="'/students/create'">Add Students</a><br><br>
                </div>
            </div>
        </div>

        
    </AuthenticatedLayout>
</template>

<style>
.btn-link{
    margin-left: 50px !important;
    font-weight: bolder;
    margin-bottom: 30px !important;
}
</style>
