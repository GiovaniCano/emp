<template>
    <Header v-if="userService.user" />
    <RouterView />
</template>

<script setup>
    import Header from './components/header.vue'
    import userService from './services/userService'
</script>
