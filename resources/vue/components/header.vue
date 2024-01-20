<template>
    <header>
        <button v-if="userService.user" type="button" @click="userService.logout">Logout</button>
    </header>
</template>

<script setup>
    import userService from '../services/userService'
</script>
