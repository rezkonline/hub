<template>
    <modal name="change-status-schedule" @before-open="beforeOpenScheduleModal" @before-close="beforeCloseScheduleModal" height="auto" :adaptive="true">
        <div class="pt-44 px-4 pb-4">
            <div class="alert alert-success mb-2 mt-2" v-if="success !== ''">{{ success }}</div>
            <h3 class="font-15 mb-3 text-center text-lg-left">
                {{ $t('schedules.attributes.status') }} :
            </h3>
            <validation-observer v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(changeStatus)">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start align-items-center">
                            <div class="custom-control custom-radio p-0 custom-control-sizes mr-2 mb-2 mb-lg-0" v-for="(name, value) in $t('schedules.types')">
                                <input type="radio" class="custom-control-input" :id="value" v-model="status" :value="value">
                                <label class="custom-control-label d-block" :for="value">
                                    <p class="font-18 m-0 border rounded-pill text-center border-dark">
                                        {{ name }}
                                    </p>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-mw-full btn-lg-mw150 rounded mt-3 mt-lg-0" type="submit">{{ $t('schedules.actions.save') }}</button>
                    </div>
                </form>
            </validation-observer>
        </div>
    </modal>
</template>

<script>
    import EventBus from "../../../../event-bus";

    export default {
        name: "ScheduleChangeStatusModalComponent",
        data() {
            return {
                success: '',
                status: '',
                schedule: {},
            };
        },
        methods: {
            beforeOpenScheduleModal(event) {
                this.schedule = event.params.schedule;
            },
            beforeCloseScheduleModal(event) {
                this.schedule = {};
                this.success = '';
                this.status = '';
            },
            changeStatus() {
                var app = this;
                this.axios.put('schedules/' + this.schedule.id, {
                    status: this.status,
                }).then(function (response) {
                    app.success = response.data.message;
                    EventBus.$emit('update-schedules-list');
                    app.$modal.hide('change-status-schedule');
                    app.$toast.success(app.$t('schedules.messages.updated'));
                });
            },
        },
    }
</script>

<style scoped>

</style>
