<template>
    <modal name="create-campaign" height="auto" :scrollable="true" :adaptive="true" @before-close="beforeCloseCreateCampaignModal">
        <div class="p-3 p-lg-5">
            <div class="alert alert-success" v-if="success !== ''">{{ success }}</div>
            <validation-observer v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(createCampaign)">
                    <div class="row row-p8">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="d-block m-0">
                                    <p class="font-w600 d-block mb-1 font-14 font-lg-17">
                                        {{ $t('campaigns.attributes.name') }}
                                    </p>
                                    <validation-provider :name="$t('campaigns.attributes.name')" rules="required" v-slot="{ errors, classes }">
                                        <input type="text" class="form-control form-control-lg" :class="classes" v-model="name">
                                        <span>{{ errors[0] }}</span>
                                    </validation-provider>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="d-block m-0">
                                    <p class="font-w600 d-block mb-1 font-14 font-lg-17">
                                        {{ $t('campaigns.attributes.budget') }}
                                    </p>
                                    <validation-provider :name="$t('campaigns.attributes.budget')" rules="required" v-slot="{ errors, classes }">
                                        <input type="text" class="form-control form-control-lg" :class="classes" v-model="budget">
                                        <span>{{ errors[0] }}</span>
                                    </validation-provider>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="d-block m-0">
                                    <p class="font-w600 d-block mb-1 font-14 font-lg-17">
                                        {{ $t('campaigns.attributes.target') }}
                                    </p>
                                    <validation-provider :name="$t('campaigns.attributes.target')" rules="required" v-slot="{ errors, classes }">
                                        <textarea rows="5" class="form-control form-control-lg" :class="classes" v-model="target"></textarea>
                                        <span>{{ errors[0] }}</span>
                                    </validation-provider>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="d-block m-0">
                                    <p class="font-w600 d-block mb-1 font-14 font-lg-17">
                                        {{ $t('campaigns.attributes.description') }}
                                    </p>
                                    <validation-provider :name="$t('campaigns.attributes.description')" rules="required" v-slot="{ errors, classes }">
                                        <textarea rows="5" class="form-control form-control-lg" :class="classes" v-model="description"></textarea>
                                        <span>{{ errors[0] }}</span>
                                    </validation-provider>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="d-block m-0">
                                    <h3 class="font-16 mb-3 mt-0">
                                        <i class="fa fa-link"></i>
                                        {{ $t('campaigns.attributes.attachments') }}
                                    </h3>

                                    <div class="custom__fileUploadfile form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg" readonly="" :value="filesNames.join(', ')" disabled="true">
                                            <div class="input-group-btn">
                                                    <span class="fileUploadfile btn btn-dark btn-lg">
                                                        <span class="upl" id="upload">{{ $t('frontend.actions.select_files') }}</span>
                                                        <input type="file" class="upload up" id="up" ref="file" multiple="" v-on:change="handleFileUpload">
                                                    </span>
                                            </div>
                                        </div>
                                    </div>

                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-outline-primary btn-lg btn-mw-full btn-md-mw150 mr-md-1 rounded mb-2" type="button" @click="$modal.hide('create-campaign', {reset: true})">{{ $t('campaigns.dialogs.delete.cancel') }}</button>
                            <button class="btn btn-primary btn-lg btn-mw-full btn-md-mw150 rounded mb-2" type="submit" :disabled="creating">{{ $t('campaigns.actions.save') }}</button>
                        </div>
                    </div>
                </form>
            </validation-observer>
        </div>
    </modal>
</template>

<script>
    import EventBus from "../../../../event-bus";

    export default {
        name: "CampaignCreateModalComponent",
        data() {
            return {
                success: '',
                name: '',
                budget: '',
                description: '',
                target: '',
                attachments: [],
                filesNames: [],
                created: false,
                creating: false,
            };
        },
        methods: {
            async createCampaign() {
                var app = this;

                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('budget', this.budget);
                formData.append('description', this.description);
                formData.append('target', this.target);
                formData.append('status', 'ongoing');

                for (let i = 0; i < this.attachments.length; i++) {
                    formData.append('attachments[]', this.attachments[i]);
                }

                this.creating = true;

                await this.axios.post('campaigns', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function (response) {
                    app.created = true;
                    app.$modal.hide('create-campaign');
                    app.$toast.open(response.data.message);
                    EventBus.$emit('update-campaigns-list');
                }).finally(() => {
                    app.creating = false;
                });
            },
            handleFileUpload() {
                for (let i = 0; i < this.$refs.file.files.length; i++) {
                    var $file = this.$refs.file.files[i];

                    this.attachments.push($file);

                    if (!this.filesNames.includes($file.name)) {
                        this.filesNames.push($file.name);
                    }
                }
            },
            beforeCloseCreateCampaignModal(event) {
                if (this.created || (typeof event.params !== 'undefined' && event.params.reset)) {
                    // Destroy the modal
                    this.success = '';
                    this.name = '';
                    this.description = '';
                    this.budget = '';
                    this.target = '';
                    this.attachments = [];
                    this.created = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>
