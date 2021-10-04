<template>
    <div class="container">
        <h1>{{title}}</h1>

        <div class="form-group">
            <label>Hash:</label>
            <input type="text" class="form-control" v-model="input_hash" v-on:keyup.enter="findSecret" maxlength="255">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" @click="findSecret">Find</button>
        </div>

        <ServerResponse v-bind:response_data="response_data" v-if="hasResponse" />
    </div>
</template>

<script>
import ServerResponse from "./../components/ServerResponse"

export default {
    name: "Find.vue",
    components: {ServerResponse},
    data() {
        return {
            title: 'Find secret',
            api_url: 'http://127.0.0.1:8000/api/secret/',
            input_hash: '',
            response_data: null
        }
    },
    computed: {
        apiUrl() {
            return this.api_url + this.input_hash
        },
        hasResponse() {
            return this.response_data != null
        }
    },
    methods: {
        findSecret() {
            if (this.input_hash === '') {
                return
            }

            this.response_data = null
            axios.get(this.apiUrl)
                .then(response => (this.response_data = response.data))
                .catch(error => (this.response_data = error.response.data))
        }
    }
}
</script>
