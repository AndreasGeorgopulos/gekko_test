<template>
    <div>
        <hr />
        <h2>Response</h2>
        <pre>{{response_data}}</pre>
    </div>
</template>

<script>
export default {
    name: "ServerResponse.vue",
    props: {
        response_data: String
    }
}
</script>
