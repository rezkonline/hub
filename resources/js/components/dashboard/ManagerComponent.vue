<template>
    <div class="bg-white border rounded scrollbar__half">
        <div class="block__box--content block__box--content--half p-2 p-md-3 p-lg-3">
            <h2 class="font-16 font-lg-19 mb-3">
                {{ $t('frontend.dashboard.messages') }}
            </h2>

            <div class="boxadminname d-flex align-items-center mb-3" v-if="!isEmpty(manager)">
                <img class="img-h50 rounded-circle mr-2" :src="manager.avatar" :alt="manager.name">
                <div>
                    <h3 class="font-14 font-lg-16 mb-1 text-primary">
                        {{ $t('frontend.dashboard.manager') }}
                    </h3>
                    <div class="d-flex flex-wrap align-items-center">
                        <p class="m-0 font-14 font-w700 mr-3">
                            <i class="far fa-user mr-2"></i>
                            {{ manager.name }}
                        </p>
                        <a class="m-0 font-14 font-w400" :href="'tel:' + manager.phone">
                            <i class="fa fa-phone mr-2"></i>
                            {{ manager.phone }}
                        </a>
                    </div>
                </div>
            </div>
            <vue-content-loading :width="300" :height="100" :rtl="rtl" v-if="isEmpty(manager)">
                <circle cx="30" cy="30" r="30" />
                <rect x="75" y="13" rx="4" ry="4" width="100" height="15" />
                <rect x="75" y="37" rx="4" ry="4" width="50" height="10" />
            </vue-content-loading>

            <div class="block__post block__post--admin position-relative mb-2 shadow-sm hoverrounded p-2 border d-block" v-if="messages.length > 0 && !loader" v-for="message in messages">
                <div class="row row-p4 align-items-center" @click="$modal.show('message', { message: message })">
                    <div class="col-md-2">
                        <img class="imgs rounded-circle mb-24 mb-md-0" :src="message.sender.avatar" :alt="message.sender.name">
                    </div>
                    <div class="col-md-10">
                        <h3 class="text-primary font-15 font-lg-16 mb-1">
                            {{ message.title }}
                        </h3>
                        <div class="time font-14 mb-1">
                            {{ message.created_at }}
                        </div>
                        <p class="m-0 font-14 text-light text-h38 line-14 overflow-hidden">
                            {{ message.body }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="block__post block__post--admin position-relative mb-2 shadow-sm hoverrounded p-2 border d-block" v-if="loader" v-for="index in 4">
                <vue-content-loading :width="300" :height="75" :rtl="rtl">
                    <circle cx="30" cy="30" r="30" />
                    <rect x="75" y="13" rx="4" ry="4" width="100" height="15" />
                    <rect x="75" y="37" rx="4" ry="4" width="50" height="10" />
                </vue-content-loading>
            </div>
            <scroll-loader :loader-method="getMessages" :loader-disable="disableScrollLoading"></scroll-loader>
            <h4 class="text-center" v-if="!loader && messages.length === 0">{{ $t('messages.empty') }}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ManagerComponent",
        data() {
            return {
                loader: true,
                disableScrollLoading: true,
                perPage: 10,
                page: 1,
                rtl: false,
                manager: '',
                messages: [],
            };
        },
        async mounted() {
            this.rtl = document.documentElement.dir === 'rtl';
            var app = this;
            this.axios.get('user/manager').then(function (response) {
                app.manager = response.data.data;
            });
            await this.getMessages();
            this.loader = false;
        },
        methods: {
            isEmpty(obj) {
                for (var prop in obj) {
                    if (obj.hasOwnProperty(prop)) {
                        return false;
                    }
                }

                return JSON.stringify(obj) === JSON.stringify({});
            },
            getMessages() {
                var app = this;
                this.axios.get('messages', {
                    params: {
                        perPage: this.perPage,
                        page: this.page++,
                    }
                }).then(function (response) {
                    app.messages = [...app.messages, ...response.data.data];
                    app.disableScrollLoading = response.data.data.length < app.perPage;
                });
            }
        }
    }
</script>

<style scoped>

</style>
