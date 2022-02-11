<template>
    <div class="block__box">
        <div class="bg-white border rounded">
            <div class="block__box--title text-white bg-gradient py-24 px-3 rounded-top">
                <h2 class="font-16 font-lg-19 m-0">
                    {{ $t('frontend.menus.account') }}
                </h2>
            </div>
            <div class="block__box--content p-2 p-md-3 p-lg-4">
                <div class="row row-p10 mb-4">
                    <div class="col-lg-4">
                        <div class="bg-white shadow-sm rounded p-4 d-md-flex align-items-center justify-content-between mb-3 mb-lg-0">
                            <p class="font-18 mb-2 mb-md-0">
                                {{ $t('customers.total') }}
                            </p>
                            <p class="font-15 font-md-22 m-0 font-w700 text-primary">
                                $ {{ $store.state.user.credit }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="bg-white shadow-sm rounded p-4 d-md-flex align-items-center justify-content-between mb-3 mb-lg-0">
                            <p class="font-18 mb-2 mb-md-0">
                                {{ $t('customers.payed') }}
                            </p>
                            <p class="font-15 font-md-22 m-0 font-w700 text-primary">
                                $ {{ $store.state.user.payed }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="bg-white shadow-sm rounded p-4 d-md-flex align-items-center justify-content-between mb-3 mb-lg-0">
                            <p class="font-18 mb-2 mb-md-0">
                                {{ $t('customers.purchases') }}
                            </p>
                            <p class="font-15 font-md-22 m-0 font-w700 text-primary">
                                {{ $store.state.user.purchases }}
                            </p>
                        </div>
                    </div>
                </div>

                <h4 class="font-17 font-lg-20 mb-3">
                    {{ $t('transactions.actions.list') }}
                </h4>

                <table class="table__lastoperations table table-bordered m-0" v-if="transactions.length > 0 && !loader">
                    <thead>
                    <tr>
                        <th>{{ $t('transactions.attributes.date') }}</th>
                        <th>{{ $t('transactions.attributes.payment_type') }}</th>
                        <th>{{ $t('transactions.attributes.amount') }}</th>
                        <th>{{ $t('transactions.attributes.note') }}</th>
                        <th>{{ $t('transactions.attributes.receipt') }}</th>
                        <th>{{ $t('transactions.attributes.actor_id') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="transaction in transactions" :key="transaction.id">
                            <td>
                                <p class="d-block d-md-none font-17 mb-2">
                                    {{ $t('transactions.attributes.date') }}
                                </p>
                                <span class="text-ltr d-inline-block ml-2 text-light">{{ transaction.created_at }}</span>
                            </td>
                            <td>
                                <p class="d-block d-md-none font-17 mb-2">
                                    {{ $t('transactions.attributes.payment_type') }}
                                </p>
                                <b>{{ transaction.payment_type }}</b>
                            </td>
                            <td>
                                <p class="d-block d-md-none font-17 mb-2">
                                    {{ $t('transactions.attributes.amount') }}
                                </p>
                                <b class="font-18 font-lg-22 text-success" v-if="transaction.amount > 0">$ {{ transaction.amount }}</b>
                                <b class="font-18 font-lg-22 text-danger" v-if="transaction.amount < 0">$ {{ transaction.amount * -1 }}</b>
                            </td>
                            <td>
                                <p class="d-block d-md-none font-17 mb-2">
                                    {{ $t('transactions.attributes.note') }}
                                </p>
                                <p class="text-light font-17 m-0 line-14">
                                    {{ transaction.note !== null ? transaction.note : $t('transactions.empty_note') }}
                                </p>
                            </td>
                            <td>
                                <p class="d-block d-md-none font-17 mb-2">
                                    {{ $t('transactions.attributes.receipt') }}
                                </p>
                                <b class="font-15 font-lg-18" v-if="transaction.receipt !== ''">
                                    <a :href="transaction.receipt">{{ $t('transactions.attributes.receipt') }}</a>
                                </b>
                                <b class="font-15 font-lg-18" v-else>
                                    {{ $t('transactions.receipt_empty') }}
                                </b>
                            </td>
                            <td>
                                <p class="d-block d-md-none font-17 mb-2">
                                    {{ $t('transactions.attributes.actor_id') }}
                                </p>
                                <b class="font-18 font-lg-22">{{ transaction.actor }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <vcl-table v-if="transactions.length === 0 && loader"></vcl-table>
                <h4 class="w-100 text-center" v-if="transactions.length === 0 && !loader">{{ $t('transactions.empty') }}</h4>
            </div>
        </div>
    </div>
</template>

<script>
    import { VclTable } from 'vue-content-loading';

    export default {
        name: "AccountComponent",
        components: {
            VclTable
        },
        data() {
            return {
                loader: true,
                transactions: [],
            };
        },
        async mounted() {
            await this.axios.get('user/transactions').then((response) => {
                this.transactions = response.data.data
            })
            this.loader = false
        },
    }
</script>

<style scoped>

</style>
