<template>
    <div class="bg-white m-3">
        <h1 class="text-xl font-bold text-gray-900 dark:text-gray-50 lg:text-3xl lg:leading-[36.4px] p-3">
            Buy Airtime
        </h1>

        <form @submit.prevent="buyAirtime">

            <div class="flex">
                <div class="flex-none w-full md:w-1/2 px-3">
                    <div class="form-group py-3">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" v-model="mobile" required>
                    </div>

                    <div class="form-group py-3">

                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="tmp_amount in amounts" :key="tmp_amount"
                                :class="(tmp_amount == amount) ? 'bg-blue-500 text-white' : 'border border-blue-700'"
                                class="p-2 rounded-md text-center cursor-pointer" @click="changeShow(tmp_amount)">
                                {{ tmp_amount }}
                            </div>
                            <div @click="show_amount = true"
                                :class="(amount in amounts) ? 'bg-blue-500 text-white' : 'border border-blue-700'"
                                class="p-2 rounded-md text-center cursor-pointer">Other</div>


                        </div>

                        <div v-if="show_amount">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" v-model="amount" required>
                        </div>
                    </div>
                </div>

                <div class="flex-auto px-3">

                    <div class="form-group py-3">

                        <h4>Country</h4>

                        <div class="grid grid-cols-4 gap-1">
                            <div v-for="tmp_country in countries" :key="tmp_country.code"
                                class="text-center cursor-pointer" @click="selectCountry(tmp_country)">

                                <div :class="(tmp_country.code === country) ? 'border-2 border-green-400' : 'border border-gray-50'"
                                    class="w-14 h-14 rounded-full overflow-hidden inline-block">
                                    <img :src="'http://purecatamphetamine.github.io/country-flag-icons/3x2/' + tmp_country.code + '.svg'"
                                        :alt="tmp_country.code" class="w-full">
                                </div>

                                <div class="text-xs" style="margin-top: -4px;">{{ tmp_country.name }}</div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn bg-green-600 uppercase text-white font-semibold text-lg py-2 px-4">Buy
                Airtime</button>

            <div> 
                <div class="" style="font-size: 96px;">{{ amount }}</div>
                <div class=" inline-block w-24">
                    {{ country }}
                    <div class="text-center cursor-pointer">

                        <div class="w-14 h-14 rounded-full border-2 border-green-400 overflow-hidden inline-block">
                            <img :src="'http://purecatamphetamine.github.io/country-flag-icons/3x2/' + country + '.svg'"
                                :alt="country" class="w-full">
                        </div>

                        <div class="text-xs" style="margin-top: -4px;">{{ country }}</div>

                    </div>
                </div>

                <div class=" inline-block" style="font-size: 72px;">{{ mobile }}</div>
            </div>


        </form>


    </div>
</template>

<script>
export default {
    data() {
        return {
            amount: 100,
            mobile: '',
            show_amount: false,
            country: 'KE',
            amounts: [10, 20, 50, 100, 200, 500, 1000],
            countries: [
                { code: 'KE', name: 'Kenya' },
                { code: 'UG', name: 'Uganda' },
                { code: 'TZ', name: 'Tanzania' },
                { code: 'RW', name: 'Rwanda' },
                { code: 'MW', name: 'Malawi' },
                //{ code: 'CD', name: 'Congo' },
                { code: 'NG', name: 'Nigeria' },
                //{ code: 'GH', name: 'Ghana' },
                { code: 'ZA', name: 'South Africa' },
                //{ code: 'ZM', name: 'Zambia' },
                //{ code: 'ZW', name: 'Zimbabwe' },
                { code: 'SN', name: 'Senegal' },
            ]
        }
    },
    methods: {
        confirmForm() {
            var hasError = false;

            if (this.mobile == '') {
                alert('Mobile number is required');
                hasError = true;
            }

            if (this.country == '') {
                alert('Country is required');
                hasError = true;
            }

            if (this.amount == '') {
                alert('Amount is required');
                hasError = true;
            }

            if (hasError) {
                return false;
            }

        },
        selectCountry(tmp_country) {
            this.country = tmp_country.code;
        },
        changeShow(tmp_amount) {
            this.amount = tmp_amount;
            this.show_amount = false;
        },
        buyAirtime() {
            if (this.amount < 10) {
                this.$notification('Minimum amount is 10');
                return false;
            }

            return false;
        }
    }
}

</script>