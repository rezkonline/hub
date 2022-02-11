<template>
    <div class="block__box">
        <div class="row row-p4">
            <div class="col-lg-12 mb-3" v-if="!taskIsActive && !campaignIsActive && !scheduleIsActive">
                <div class="alert alert-warning">
                    {{ $t('users.alerts.registered') }}
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0">
                <ManagerComponent></ManagerComponent>
                <AchievementComponent></AchievementComponent>
                <AttachmentsComponent></AttachmentsComponent>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0">
                <TaskComponent v-if="taskIsActive"></TaskComponent>
                <CampaignComponent v-if="campaignIsActive"></CampaignComponent>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0">
                <ScheduleComponent v-if="scheduleIsActive"></ScheduleComponent>
            </div>
        </div>
    </div>
</template>

<script>
    import ManagerComponent from "./ManagerComponent";
    import AchievementComponent from "./AchievementComponent";
    import TaskComponent from "./TaskComponent";
    import CampaignComponent from "./CampaignComponent";
    import ScheduleComponent from "./ScheduleComponent";
    import AttachmentsComponent from "./AttachmentsComponent";
    export default {
        name: "IndexDashboard",
        components: {
            ScheduleComponent,
            CampaignComponent,
            TaskComponent,
            AchievementComponent,
            ManagerComponent,
            AttachmentsComponent
        },
        computed: {
            taskIsActive() {
                return typeof this.$store.state.user.settings !== 'undefined' && this.$store.state.user.settings['tasks_is_active']
            },
            campaignIsActive() {
                return typeof this.$store.state.user.settings !== 'undefined' && this.$store.state.user.settings['campaigns_is_active']
            },
            scheduleIsActive() {
                return typeof this.$store.state.user.settings !== 'undefined' && this.$store.state.user.settings['schedules_is_active']
            }
        },
    }
</script>

<style>
    .v--modal {
        text-align: right;
        left: 0 !important;
        margin: 0 auto;
    }
    .v--modal-overlay .v--modal-box {
        overflow: inherit;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
