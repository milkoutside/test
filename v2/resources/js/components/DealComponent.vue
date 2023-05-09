<template>
    <div class="w-25 mx-auto text-center">
        <div class="mb-3">
            <input type="text" class="form-control" v-model="dealName" v-model.lazy="$v.dealName.$model" id="dealName" placeholder="Enter dealName">
            <p v-if="$v.dealName.$error" class="text-danger">
                *Entered dealName is too short or incorrect
            </p>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" v-model="dealStage" v-model.lazy="$v.dealStage.$model" id="dealStage" placeholder="Enter dealStage">
            <p v-if="$v.dealStage.$error" class="text-danger">
                *Entered dealStage is too short or incorrect
            </p>
        </div>
        <button @click.prevent="checkForm" class="btn-primary w-25 mx-auto">Create</button>
    </div>
</template>


<script>

import {required, minLength,url} from 'vuelidate/lib/validators'

export default {
    name: "DealComponent",
    data() {
        return {
            accessToken: null,
            dealName: null,
            dealStage: null,
        }
    },
    validations: {
        dealName: {required, minLength:minLength(3)},
        dealStage: {required, minLength:minLength(3)},
    },
    async mounted() {


    },
    methods:{
        addDeal() {
            axios
                .post("api/createDeal", {
                    dealName: this.dealName,
                    dealStage: this.dealStage,
                }, {
                    headers: {
                        'Cookie': document.cookie
                    }
                })
                .then((response) => {
                    alert('Deal has been created')
                })
                .catch((error) => {
                    alert('Error: ' + error)
                });
        },

        checkForm() {

            if (this.$v.$invalid) {
                alert('Error: Please fix validation errors.');
                return false;
            }

            this.addDeal()
        }
    },
};
</script>

<style scoped>

</style>
