<template>
    <modal name="change-status-campaign" @before-open="beforeOpenCampaignModal" @before-close="beforeCloseCampaignModal" height="auto" :adaptive="true">
        <div class="pt-44 px-4 pb-4">
            <div class="alert alert-success mb-2 mt-2" v-if="success !== ''">{{ success }}</div>
            <h3 class="font-15 mb-3 text-center text-lg-left">
                {{ $t('campaigns.attributes.status') }} :
            </h3>
            <validation-observer v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(changeStatus)">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start align-items-center">
                            <div class="custom-control custom-radio p-0 custom-control-sizes mr-2 mb-2 mb-lg-0" v-for="(name, value) in $t('campaigns.types')">
                                <input type="radio" class="custom-control-input" :id="value" v-model="status" :value="value">
                                <label class="custom-control-label d-block" :for="value">
                                    <p class="font-18 m-0 border rounded-pill text-center border-dark">
                                        {{ name }}
                                    </p>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-mw-full btn-lg-mw150 rounded mt-3 mt-lg-0" type="submit">{{ $t('campaigns.actions.save') }}</button>
                    </div>
                </form>
            </validation-observer>
        </div>
    </modal>
</template>

<script>
    import EventBus from "../../../../event-bus";

    export default {
        name: "CampaignChangeStatusModalComponent",
        data() {
            return {
                success: '',
                status: '',
                campaign: {},
            };
        },
        methods: {
            beforeOpenCampaignModal(event) {
                this.campaign = event.params.campaign;
            },
            beforeCloseCampaignModal(event) {
                this.campaign = {};
                this.success = '';
                this.status = '';
            },
            changeStatus() {
                var app = this;
                this.axios.put('campaigns/' + this.campaign.id, {
                    status: this.status,
                }).then(function (response) {
                    app.success = response.data.message;
                    EventBus.$emit('update-campaigns-list');
                    app.$modal.hide('change-status-campaign');
                    app.$toast.success(app.$t('campaigns.messages.updated'));
                });
            },
        },
    }
</script>

<style scoped>

</style>
