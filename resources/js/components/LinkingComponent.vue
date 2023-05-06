<template>
    <div class="w-25 mx-auto text-center">
        <div class="mb-3">
            <select v-if="deals.length" v-model="selectedDeal" class="form-select mb-2" aria-label="Default select example">
                <option v-for="deal in deals" :key="deal.id" :value="deal.id">{{ deal.Deal_Name }}</option>
            </select>
            <select v-if="accounts.length" v-model="selectedAccount" class="form-select mb-2" aria-label="Default select example">
                <option v-for="account in accounts" :key="account.id" :value="account.id">{{ account.Account_Name }}</option>
            </select>
            <button @click.prevent="linking" class="btn-primary w-25 mx-auto">Create</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "LinkingComponent",
    data(){
        return {
            deals: [],
            accounts: [],
            selectedAccount: "",
            selectedDeal:""
        }
    },
    async mounted() {
        const responseAccounts = await axios.get('api/getAccounts');
        console.log(await axios.get('api/getDeals'))
        this.accounts = responseAccounts.data;
        const responseDeals =  await axios.get('api/getDeals');
        this.deals = responseDeals.data;
        console.log(this.deals)
    },
    methods: {

        linking() {
            axios.put("api/linking", {
                id: this.selectedDeal,
                account: this.selectedAccount,
                    })
                    .then((response) => {
                        alert('Linking')
                    })
                    .catch((error) => {
                        alert('Error:'+error)
                    });

        }
    }
}
</script>

<style scoped>

</style>
