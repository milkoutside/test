<template>
    <div class="w-25 mx-auto text-center">
        <div class="mb-3">
            <input type="text" class="form-control" v-model="accountName" v-model.lazy="$v.accountName.$model" id="accountName" placeholder="Enter Name">
            <p v-if="$v.accountName.$error" class="text-danger">
                *Entered name is too short or incorrect
            </p>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" v-model="WebSite" v-model.lazy="$v.WebSite.$model" id="Website" placeholder="Enter WebSite">
            <p v-if="$v.WebSite.$error" class="text-danger">
                *Entered WebSite incorrect
            </p>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" v-model="Phone" id="Phone" placeholder="Enter Phone">
            <p v-if="$v.Phone.$error" class="text-danger">
                *Entered Phone incorrect
            </p>
        </div>
        <button @click.prevent="checkForm" class="btn-primary w-25 mx-auto">Create</button>
    </div>
</template>

<script>

import {required, minLength,url} from 'vuelidate/lib/validators'
export default {
    name: "CreateAccountComponent",
    data() {
        return {
            accessToken: null,
            errors: [],
            accountName: null,
            WebSite: null,
            Phone: null,
        }
    },
    validations: {
        accountName: {required, minLength:minLength(3)},

        WebSite: { required, url},

        Phone:{required,minLength:minLength(6)}
    },
    async mounted() {


    },
    methods:{
        addAccount() {
            axios
                .post("api/createAccount", {
                    accountName: this.accountName,
                    WebSite: this.WebSite,
                    Phone: this.Phone,
                })
                .then((response) => {
                    console.log("Account has been created");
                })
                .catch((error) => {
                    console.log("Error:" +error);
                });
        },
        checkForm() {
            if (this.$v.$invalid) {
                alert('Error: Please fix validation errors.');
                return false;
            }

            this.addAccount()
        }
    },
};
</script>

<style scoped></style>
