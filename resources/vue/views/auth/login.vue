<template>
    <h1>Login</h1>

    <form @submit.prevent="login">
        <input type="email" name="email" placeholder="email" required>

        <input type="password" name="password" placeholder="password" required>

        <input type="submit" value="Login">
    </form>
</template>

<script setup>
    import userService from '../../services/userService'

    function login(e) {
        userService.login({
            email: e.target.email.value,
            password: e.target.password.value,
        })
    }
</script>
