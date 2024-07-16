<template>
    <div class="block__menusfixed position-relative">
        <!-- Fixed Menus -->
        <div class="block__menusfixed--menus position-fixed bg-white shadow">

            <!-- Logo -->
            <router-link class="logo d-block my-4" :to="{ name: 'app' }">
                <img class="img-h45 img-md-h60 d-block mx-auto" :src="settings.logo" :alt="settings.title">
            </router-link>
            <!-- / Logo -->

            <!-- Menus -->
            <ul class="list">
                <li :class="$route.name === 'app' ? 'active' : ''">
                    <router-link :to="{ name: 'app' }"><i class="fa fa-tachometer-alt d-md-block mb-md-2 mr-2 mr-md-0 font-16 font-lg-24"></i>{{ $t('frontend.menus.dashboard') }}</router-link>
                </li>
                <li :class="$route.name === 'chat' ? 'active' : ''" v-if="$store.state.user.impersonator === null || typeof $store.state.user.impersonator === 'undefined' || $store.state.user.impersonator.type !== 'employee'">
                    <router-link :to="{ name: 'chat' }"><i class="far fa-comment-dots d-md-block mb-md-2 mr-2 mr-md-0 font-16 font-lg-24"></i> {{ $t('frontend.menus.chat') }}</router-link>
                </li>
                <li :class="$route.name === 'settings' ? 'active' : ''" v-if="$store.state.user.impersonator === null || typeof $store.state.user.impersonator === 'undefined' || $store.state.user.impersonator.type !== 'employee'">
                    <router-link :to="{ name: 'settings' }"><i class="far fa-cog d-md-block mb-md-2 mr-2 mr-md-0 font-16 font-lg-24"></i> {{ $t('frontend.menus.settings') }}</router-link>
                </li>
            </ul>
            <!-- / Menus -->

        </div>
        <!-- / Fixed Menus -->

        <!-- Body Content -->
        <div class="block__menusfixed--content block__menusfixed--content--scrollbar">
            <!-- Header -->
            <div class="block__header d-flex flex-column justify-content-center">
                <div class="bg-white border rounded d-md-flex justify-content-between align-items-center">
                    <div class="block__header--title mb-3 mb-md-0">
                        <h1 class="font-15 font-md-18 m-0">
                            <span class="text-primary">{{ settings.title }}</span>
                        </h1>
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <button @click="leaveImpersonating" class="block__header--search mb-2 mb-md-0 d-flex align-items-center bg-white border rounded mx-md-3" v-if="$store.state.user.impersonator !== null">
                            {{ $t('frontend.pages.dashboard') }}
                        </button>
                        <div class="dropdown block__header--user d-flex align-items-center bg-white border rounded mx-md-3">
                            <a id="dropdownProfileLink" data-toggle="dropdown" href="#" aria-expanded="true" class="text-center">
                                <p class="font-17 font-w500 line-10 m-0">{{ $store.state.user.name }}</p>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownProfileLink">
                                <a class="dropdown-item" href="#" @click.prevent="logout">
                                    {{ $t('frontend.actions.logout') }}
                                </a>
                            </div>
                        </div>
                        <div class="dropdown block__header--settings styledropdown show">
                            <a class="font-20 font-lg-24 mx-2 position-relative dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" href="#" aria-expanded="true" @click="markNotificationsAsRead">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-primary position-absolute" v-if="notificationsLength !== 0">{{ notificationsLength }}</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(8px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" :href="'/' + notification.view.type + (notification.view.id !== '' ? '-' + notification.view.id : '')" v-for="(notification, index) in notifications" :key="index">
                                    {{ notification.body }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Header -->
            <keep-alive>
                <router-view></router-view>
            </keep-alive>

            <!-- Fixed Footer -->
            <div class="block__menusfixed--footer d-flex flex-column justify-content-end">
                <div class=" bg-gradient py-2 px-3 py-md-3 px-md-5 text-white rounded-top d-md-flex align-items-center justify-content-between text-center">
                    <img class="d-none d-md-block img-h25" :src="settings.logo" :alt="settings.title">
                    <p class="font-14 font-w700 font-lg-16 mt-3 mb-2 my-md-0">
                        {{ settings.copyright }} &copy;
                    </p>
                    <ul class="sharesocial">
                        <li v-if="settings.facebook !== null"><a :href="settings.facebook" class="fab fa-facebook-f"></a></li>
                        <li v-if="settings.twitter !== null"><a :href="settings.twitter" class="fab fa-twitter"></a></li>
                        <li v-if="settings.instagram"><a :href="settings.instagram" class="fab fa-instagram"></a></li>
                        <li v-if="settings.youtube"><a :href="settings.youtube" class="fab fa-youtube"></a></li>
                    </ul>
                </div>
            </div>
            <!-- / Fixed Footer -->
        </div>
        <!-- / Body Content -->

        <!-- Messages -->
        <MessageModalComponent></MessageModalComponent>
        <!-- Tasks -->
        <TaskModalComponent></TaskModalComponent>
        <TaskCreateModalComponent></TaskCreateModalComponent>
        <TaskChangeStatusModalComponent></TaskChangeStatusModalComponent>
        <!-- Campaigns -->
        <CampaignModalComponent></CampaignModalComponent>
        <CampaignCreateModalComponent></CampaignCreateModalComponent>
        <CampaignChangeStatusModalComponent></CampaignChangeStatusModalComponent>
        <!-- Schedules -->
        <ScheduleModalComponent></ScheduleModalComponent>
        <ScheduleCreateModalComponent></ScheduleCreateModalComponent>
        <ScheduleChangeStatusModalComponent></ScheduleChangeStatusModalComponent>
    </div>
</template>

<script>
    import TaskModalComponent from "../dashboard/partials/tasks/TaskModalComponent";
    import MessageModalComponent from "../dashboard/partials/MessageModalComponent";
    import TaskCreateModalComponent from "../dashboard/partials/tasks/TaskCreateModalComponent";
    import TaskChangeStatusModalComponent from "../dashboard/partials/tasks/TaskChangeStatusModalComponent";
    import CampaignCreateModalComponent from "../dashboard/partials/campaigns/CampaignCreateModalComponent";
    import CampaignModalComponent from "../dashboard/partials/campaigns/CampaignModalComponent";
    import CampaignChangeStatusModalComponent from "../dashboard/partials/campaigns/CampaignChangeStatusModalComponent";
    import ScheduleCreateModalComponent from "../dashboard/partials/schedules/ScheduleCreateModalComponent";
    import ScheduleModalComponent from "../dashboard/partials/schedules/ScheduleModalComponent";
    import ScheduleChangeStatusModalComponent from "../dashboard/partials/schedules/ScheduleChangeStatusModalComponent";
    export default {
        name: "App",
        data() {
            return {
                notifications: [],
                settings: {},
                notificationsLength: 0,
                locale: '',
            };
        },
        async created() {
            await this.$store.dispatch('fetch');
            await this.getSettings();

            this.notifications = this.$store.state.user.notifications;
            this.notificationsLength = this.notifications.length;

            window.Echo.private('App.Models.User.' + this.$store.state.user.id)
                .notification((e) => {
                    this.notifications.push(e);
                    this.notificationsLength += 1;
                });

            if (typeof this.$route.params.type !== 'undefined') {
                var $types = ['task', 'campaign', 'schedule'];
                var $model_name = this.$route.params.type.split('-')[0];
                var $modal_id = this.$route.params.type.split('-')[1];

                if ($types.includes($model_name)) {
                    var $data = {};
                    var $content = {};

                    // get the content
                    await this.axios.get($model_name + 's/' + $modal_id).then((response) => {
                        $content = response.data.data;
                    });

                    $data[$model_name] = $content;

                    this.$modal.show($model_name, $data);
                }
            }
        },
        methods: {
            getSettings() {
                this.axios.get('settings').then((response) => {
                    this.settings = response.data;
                });
            },
            markAsRead(id, index) {
                this.axios.post('user/notification', {
                    id: id,
                }).then(() => {
                    delete this.notifications[index];
                });
            },
            markNotificationsAsRead() {
                this.axios.post('user/notifications/read').then(() => {
                    this.notificationsLength = 0;
                });
            },
            leaveImpersonating() {
                this.axios.get('user/impersonate/leave').then(() => {
                    window.location = window.location.href.split('/')[0] + 'dashboard';
                });
            },
            changeLanguage() {
                window.location = window.location.href.split('/')[0] + '/lang/' + this.locale;
            },
            async logout() {
                await this.axios({
                    method: 'post',
                    url: 'logout',
                    baseURL: window.location.href.split('/')[0],
                });
                window.location.reload();
            },
        },
        components: {
            ScheduleChangeStatusModalComponent,
            ScheduleModalComponent,
            ScheduleCreateModalComponent,
            CampaignChangeStatusModalComponent,
            CampaignModalComponent,
            CampaignCreateModalComponent,
            TaskChangeStatusModalComponent,
            TaskCreateModalComponent,
            MessageModalComponent,
            TaskModalComponent
        }
    }
</script>

<style scoped>

</style>
