<template>
    <div class="bg-white border rounded scrollbar__half">
        <div class="block__box--title text-white bg-gradient py-24 px-3 rounded-top">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="font-16 font-lg-19 m-0">
                    {{ $t('campaigns.plural') }}
                </h2>
                <button type="button" class="bg-transparent border-0 p-0 font-18 font-lg-22 text-white line-10" @click="$modal.show('create-campaign')"><i class="fa fa-plus-circle"></i></button>
            </div>
        </div>
        <div class="block__box--content block__box--content--half p-2 p-md-3 p-lg-3">

            <ul class="nav nav-tabs customtabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab07" aria-controls="tab05">
                        <span class="font-18 mx-2">{{ ongoingCampaigns.length }}</span>
                        {{ $t('campaigns.types.ongoing') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab08" aria-controls="tab06">
                        {{ $t('campaigns.types.completed') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab07">

                    <div v-if="ongoingCampaigns.length > 0 && !loader" v-for="campaign in ongoingCampaigns" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block" @click="$modal.show('campaign', { campaign: campaign })">
                        <div class="row row-p4 align-items-center">
                            <div class="col-md-3">
                                <img class="imgs mb-3 mb-md-0" src="/images/icon06.svg" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3 class="text-primary font-15 font-lg-16 mb-1">
                                    {{ campaign.name }}
                                </h3>
                                <p class="m-0 font-14 text-light text-h38 line-14 overflow-hidden">
                                    {{ campaign.description }}
                                </p>
                                <div class="time font-14 mt-1">
                                    {{ campaign.created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <scroll-loader :loader-method="getOngoingCampaignsList" :loader-disable="disableOngoingScrollLoader"></scroll-loader>
                    <div v-if="loader" v-for="index in 4" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block">
                        <vue-content-loading :width="300" :height="50" :rtl="rtl">
                            <rect x="40" y="17" rx="4" ry="4" width="225" height="15" />
                        </vue-content-loading>
                    </div>
                    <h4 class="text-center" v-if="ongoingCampaigns.length === 0 && !loader">{{ $t('campaigns.empty') }}</h4>

                </div>
                <div class="tab-pane fade" id="tab08">
                    <div v-for="campaign in completedCampaigns" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block" @click="$modal.show('campaign', { campaign: campaign })">
                        <div class="row row-p4 align-items-center">
                            <div class="col-md-3">
                                <img class="imgs mb-3 mb-md-0" src="/images/icon06.svg" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3 class="text-primary font-15 font-lg-16 mb-1">
                                    {{ campaign.name }}
                                </h3>
                                <p class="m-0 font-14 text-light text-h38 line-14 overflow-hidden">
                                    {{ campaign.description }}
                                </p>
                                <div class="time font-14 mt-1">
                                    {{ campaign.created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <scroll-loader :loader-method="getCompletedCampaignsList" :loader-disable="disableCompletedScrollLoader"></scroll-loader>
                    <div v-if="loader" v-for="index in 4" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block">
                        <vue-content-loading :width="300" :height="50" :rtl="rtl">
                            <rect x="40" y="17" rx="4" ry="4" width="225" height="15" />
                        </vue-content-loading>
                    </div>
                    <h4 class="text-center" v-if="completedCampaigns.length === 0 && !loader">{{ $t('campaigns.empty') }}</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from "../../event-bus";

    export default {
        name: "CampaignComponent",
        data() {
            return {
                disableOngoingScrollLoader: true,
                disableCompletedScrollLoader: true,
                loader: true,
                rtl: false,
                ongoingCampaigns: [],
                completedCampaigns: [],
                onGoingPage: 1,
                completedPage: 1,
                pageSize: 5,
            };
        },
        mounted() {
            this.rtl = document.documentElement.dir === 'rtl';
            EventBus.$on('update-campaigns-list', this.getCampaigns);
            this.getOngoingCampaignsList();
            this.getCompletedCampaignsList();
        },
        methods: {
            getCampaigns() {
                this.reset();
                this.getOngoingCampaignsList();
                this.getCompletedCampaignsList();
            },
            async getOngoingCampaignsList() {
                var app = this;
                await this.axios.get('campaigns', {
                    params: {
                        perPage: this.pageSize,
                        page: this.onGoingPage++,
                        status: 'ongoing',
                    }
                }).then(function (response) {
                    app.ongoingCampaigns.push(...response.data.data);
                    app.disableOngoingScrollLoader = response.data.data.length < app.pageSize;
                }).finally(function () {
                    app.loader = false;
                });
            },
            async getCompletedCampaignsList() {
                var app = this;
                await this.axios.get('campaigns', {
                    params: {
                        perPage: this.pageSize,
                        page: this.completedPage++,
                        status: 'completed',
                    }
                }).then(function (response) {
                    app.completedCampaigns.push(...response.data.data);
                    app.disableCompletedScrollLoader = response.data.data.length < app.pageSize;
                }).finally(function () {
                    app.loader = false;
                });
            },
            reset() {
                this.onGoingPage = 1;
                this.completedPage = 1;
                this.loader = true;
                this.disableCompletedScrollLoader = false;
                this.disableCompletedScrollLoader = false;
                this.ongoingCampaigns = [];
                this.completedCampaigns = [];
            },
        },
    }
</script>

<style scoped>

</style>
