<template>
    <div class="container">
        <h1>{{title}}</h1>

        <div v-if="!hasResponse || hasError">
            <div class="form-group">
                <label>Secret:</label>
                <input type="text" class="form-control" v-model="input_data.secret" maxlength="255">
            </div>

            <div class="form-group">
                <label>expireAfterViews:</label>
                <input type="number" class="form-control" v-model="input_data.expireAfterViews">
            </div>

            <div class="form-group">
                <label>expireAfter:</label>
                <input type="number" class="form-control" v-model="input_data.expireAfter">
            </div>

            <button class="btn btn-primary" @click="createSecret">Create</button>
        </div>

        <ServerResponse v-bind:response_data="response_data" v-if="hasResponse" />
    </div>
</template>

<script>
import ServerResponse from "./../components/ServerResponse"

export default {
    name: "Find",
    components: {ServerResponse},
    data() {
        return {
            title: 'Create new secret',
            api_url: 'http://127.0.0.1:8000/api/secret',
            input_data: {
                secret: '',
                expireAfterViews: 0,
                expireAfter: 0
            },
            response_data: null,
        }
    },
    computed: {
        hasResponse() {
            return this.response_data != null
        },
        hasError() {
            return this.response_data != null && typeof this.response_data !== 'object'
        }
    },
    methods: {
        createSecret() {
            axios.post(this.api_url, this.input_data)
                .then(response => (this.response_data = response.data))
                .catch(error => (this.response_data = error.response.data))
        }
    }
};
</script>
