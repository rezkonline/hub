<template>
    <div class="bg-white border rounded">
        <div class="block__box--title text-white bg-gradient py-24 px-3 rounded-top">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="font-16 font-lg-19 m-0">
                    {{ $t('schedules.plural') }}
                </h2>
                <button type="button" class="bg-transparent border-0 p-0 font-18 font-lg-22 text-white line-10" @click="$modal.show('create-schedule')"><i class="fa fa-plus-circle"></i></button>
            </div>
        </div>
        <div class="block__box--content block__box--content--half p-2 p-md-3 p-lg-3">

            <ul class="nav nav-tabs customtabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab09" aria-controls="tab05">
                        <span class="font-18 mx-2">{{ ongoingSchedules.length }}</span>
                        {{ $t('schedules.types.ongoing') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab010" aria-controls="tab06">
                        {{ $t('schedules.types.completed') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab09">

                    <div v-if="ongoingSchedules.length > 0 && !loader" v-for="schedule in ongoingSchedules" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block" @click="$modal.show('schedule', { schedule: schedule })">
                        <div class="row row-p4 align-items-center">
                            <div class="col-md-3">
                                <img class="imgs mb-3 mb-md-0" src="/images/icon05.svg" :alt="schedule.name">
                            </div>
                            <div class="col-md-9">
                                <h3 class="text-primary font-15 font-lg-16 mb-1">
                                    {{ schedule.name }}
                                </h3>
                                <p class="m-0 font-14 text-light text-h38 line-14 overflow-hidden">
                                    {{ schedule.description }}
                                </p>
                                <div class="time font-14 mt-1">
                                    {{ schedule.created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <scroll-loader :loader-method="getOngoingSchedulesList" :loader-disable="disableOngoingScrollLoader"></scroll-loader>
                    <div v-if="loader" v-for="index in 8" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block">
                        <vue-content-loading :width="300" :height="50" :rtl="rtl">
                            <rect x="40" y="17" rx="4" ry="4" width="225" height="15" />
                        </vue-content-loading>
                    </div>
                    <h4 class="text-center" v-if="ongoingSchedules.length === 0 && !loader">{{ $t('schedules.empty') }}</h4>

                </div>
                <div class="tab-pane fade" id="tab010">
                    <div v-for="schedule in completedSchedules" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block" @click="$modal.show('schedule', { schedule: schedule })">
                        <div class="row row-p4 align-items-center">
                            <div class="col-md-3">
                                <img class="imgs mb-3 mb-md-0" src="/images/icon05.svg" :alt="schedule.name">
                            </div>
                            <div class="col-md-9">
                                <h3 class="text-primary font-15 font-lg-16 mb-1">
                                    {{ schedule.name }}
                                </h3>
                                <p class="m-0 font-14 text-light text-h38 line-14 overflow-hidden">
                                    {{ schedule.description }}
                                </p>
                                <div class="time font-14 mt-1">
                                    {{ schedule.created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <scroll-loader :loader-method="getCompletedSchedulesList" :loader-disable="disableCompletedScrollLoader"></scroll-loader>
                    <div v-if="loader" v-for="index in 8" class="pointer-event block__post position-relative mb-2 shadow-sm hoverrounded p-2 border d-block">
                        <vue-content-loading :width="300" :height="50" :rtl="rtl">
                            <rect x="40" y="17" rx="4" ry="4" width="225" height="15" />
                        </vue-content-loading>
                    </div>
                    <h4 class="text-center" v-if="completedSchedules.length === 0 && !loader">{{ $t('schedules.empty') }}</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from "../../event-bus";

    export default {
        name: "ScheduleComponent",
        data() {
            return {
                disableOngoingScrollLoader: true,
                disableCompletedScrollLoader: true,
                loader: true,
                rtl: false,
                ongoingSchedules: [],
                completedSchedules: [],
                onGoingPage: 1,
                completedPage: 1,
                pageSize: 5,
            };
        },
        mounted() {
            this.rtl = document.documentElement.dir === 'rtl';
            EventBus.$on('update-schedules-list', this.getSchedules);
            this.getOngoingSchedulesList();
            this.getCompletedSchedulesList();
        },
        methods: {
            getSchedules() {
                this.reset();
                this.getOngoingSchedulesList();
                this.getCompletedSchedulesList();
            },
            async getOngoingSchedulesList() {
                var app = this;
                await this.axios.get('schedules', {
                    params: {
                        perPage: this.pageSize,
                        page: this.onGoingPage++,
                        status: 'ongoing',
                    }
                }).then(function (response) {
                    app.ongoingSchedules.push(...response.data.data);
                    app.disableOngoingScrollLoader = response.data.data.length < app.pageSize;
                }).finally(function () {
                    app.loader = false;
                });
            },
            async getCompletedSchedulesList() {
                var app = this;
                await this.axios.get('schedules', {
                    params: {
                        perPage: this.pageSize,
                        page: this.completedPage++,
                        status: 'completed',
                    }
                }).then(function (response) {
                    app.completedSchedules.push(...response.data.data);
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
                this.ongoingSchedules = [];
                this.completedSchedules = [];
            },
        },
    }
</script>

<style scoped>

</style>
