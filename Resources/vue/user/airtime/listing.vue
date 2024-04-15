<template>
    <div class="p-2">

        <h1 class="text-xl font-bold text-gray-900 dark:text-gray-50 lg:text-3xl lg:leading-[36.4px]">
            Airtime History
        </h1>
       
        <table class="table">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Mobile Number</th>
                    <th>Network</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="history in airtimeHistory" :key="history.id">
                    <td>{{ history.amount }}</td>
                    <td>{{ history.mobile_number }}</td>
                    <td>{{ history.network }}</td>
                    <td>{{ history.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    computed: {
        airtimeHistory() {
            return this.$store.getters.airtimeHistory
        }
    },
    created() {
        this.$store.dispatch('fetchAirtimeHistory')
    }
}
</script>

