<template>
    <div id="app" class="container">
        <div id="nav">
            <router-link to="/">Find secret</router-link> |
            <router-link to="/create-secret">Create new secret</router-link> |
            <a href="/api/documentation">Documentation</a>
        </div>
        <router-view />
    </div>
</template>

<script>
export default {
    name: "App.vue"
}
</script>
