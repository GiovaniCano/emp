<template>
    <header>
        <nav>
            <router-link :to="{name:'admin.index'}" v-if="userHasRole(userService.user, 'super admin')">Admins</router-link>
            <router-link :to="{name:'pass.index'}" v-if="userHasPermission(userService.user, 'manage site')">Passes</router-link>
            <router-link :to="{name:'article.index'}" v-if="userHasPermission(userService.user, 'edit articles')">Articles</router-link>
            <button type="button" @click="userService.logout">Logout</button>
        </nav>
    </header>
</template>

<script setup>
    import userService from '../services/userService'
    import { userHasPermission, userHasRole } from '../helpers'
</script>
