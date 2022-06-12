<template>
    <modal name="campaign" width="90%" height="100%" :adaptive="true" @before-open="beforeOpenCampaignModal" styles="background: transparent;box-shadow: none;margin-top: 1.75rem;" classes="modalsingleaelan v--modal">
        <a class="closefafa fa fa-times" @click="$modal.hide('campaign')" href="#"></a>
        <div class="block__box">

            <div class="row row-p4">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <div class="bg-white rounded">
                        <div class="block__box--title text-white bg-gradient py-24 px-3 rounded-top">
                            <h2 class="font-16 font-lg-19 m-0">
                                {{ $t('campaigns.plural') }}
                            </h2>
                        </div>
                        <div class="block__box--content p-2 p-md-3 p-lg-4">

                            <div class="row row-p8 row-col-lg mb-4">
                                <div class="col-lg-6">
                                    <div class="bg-white shadow-sm rounded p-4">
                                        <p class="font-16 font-w700 font-lg-18 mb-2">
                                            {{ $t('campaigns.attributes.name') }}
                                        </p>
                                        <p class="font-16 font-lg-18 mb-0 text-primary">
                                            {{ campaign.name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bg-white shadow-sm rounded p-4">
                                        <p class="font-16 font-w700 font-lg-18 mb-2">
                                            {{ $t('campaigns.attributes.budget') }}
                                        </p>
                                        <p class="font-16 font-lg-18 mb-0 text-primary">
                                            {{ campaign.budget }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="bg-white shadow-sm rounded p-4">
                                        <p class="font-16 font-w700 font-lg-17 mb-2">
                                            {{ $t('campaigns.attributes.description') }}
                                        </p>
                                        <div class="singlecontentbg">
                                            {{ campaign.description }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="bg-white shadow-sm rounded p-4">
                                        <p class="font-16 font-w700 font-lg-17 mb-2">
                                            {{ $t('campaigns.attributes.target') }}
                                        </p>
                                        <div class="singlecontentbg">
                                            {{ campaign.target }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" v-if="attachments.length > 0">
                                    <h3 class="font-16 mb-3 mt-4">
                                        <i class="fa fa-link"></i>
                                        {{ $t('campaigns.attributes.attachments') }}
                                    </h3>
                                    <div class="bg-white shadow-sm rounded p-4">
                                        <div class="row mt-3">
                                            <div class="col" v-for="attachment in attachments">
                                                <a :href="attachment.url">
                                                    <i class="fa fa-file mr-24"></i>
                                                    {{ attachment.name }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mt-3">
                                    <button class="btn btn-secondary btn-mw-full btn-md-mw150 rounded btn-lg mb-2" style="color: #fff;" @click="$modal.show('change-status-campaign', { campaign: campaign })">{{ $t('frontend.change_status') }}</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white rounded">
                        <div class="block__box--title text-white bg-gradient py-24 px-3 rounded-top">
                            <h2 class="font-16 font-lg-19 m-0">
                                {{ $t('comments.plural') }}
                            </h2>
                        </div>
                        <div class="block__box--content block__box--withformcomment p-2 p-md-3 p-lg-4">

                            <ul class="nav nav-tabs customtabs mb-2" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabcca__01" aria-controls="tabcca__01">
                                        ({{ comments.length }}) {{ $t('comments.plural') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabcca__02" aria-controls="tabcca__02">
                                        {{ $t('logs.plural') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabcca__01">

                                    <div class="bg-white shadow-sm rounded p-2 p-lg-3 border border-w2 mb-2" v-if="comments.length > 0 && !loader" v-for="comment in comments">
                                        <div class="row row-p6 align-items-center">
                                            <div class="col-2 col-md-3">
                                                <img class="img-h30 img-md-h50 rounded-circle mx-auto d-block" :src="comment.sender.avatar" :alt="comment.sender.name">
                                            </div>
                                            <div class="col-10 col-md-9">
                                                <h4 class="font-16 mb-1">{{ comment.sender.name }}</h4>
                                                <p class="font-15 font-lg-17 m-0 line-14">
                                                    {{ comment.body }}
                                                </p>
                                                <span class="font-12 text-light text-right d-block">{{ comment.created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white shadow-sm rounded p-2 p-lg-3 border border-w2 mb-2" v-if="loader" v-for="index in 4">
                                        <vue-content-loading :width="300" :height="75" :rtl="rtl">
                                            <circle cx="30" cy="30" r="30" />
                                            <rect x="75" y="13" rx="4" ry="4" width="100" height="15" />
                                            <rect x="75" y="37" rx="4" ry="4" width="50" height="10" />
                                        </vue-content-loading>
                                    </div>
                                    <h4 class="text-center" v-if="comments.length === 0 && !loader">{{ $t('comments.empty') }}</h4>

                                </div>
                                <div class="tab-pane fade" id="tabcca__02">

                                    <div class="mt-24 mb-2 font-15 line-11 bg-light rounded p-24" v-if="logs.length !== 0" v-for="log in logs">
                                        <i class="fa fa-caret-left mr-1"></i>
                                        <span v-if="log.type === 'updated'">{{ $t('logs.sentences.update', { name: log.causer.name, status: $t('tasks.types.' + log.status), time: log.created_at }) }}</span>
                                        <span v-if="log.type === 'created'">{{ $t('logs.sentences.create', { name: log.causer.name, time: log.created_at }) }}</span>
                                    </div>
                                    <div class="mt-24 mb-2 font-15 line-11 bg-light rounded p-24" v-if="logs.length === 0">
                                        {{ $t('logs.empty') }}
                                    </div>

                                </div>
                            </div>



                        </div>

                        <div class="block__box--formcomment rounded-bottom bg-white py-24 px-3 border-top">
                            <validation-observer v-slot="{ handleSubmit }">
                                <form @submit.prevent="handleSubmit(addComment)">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-lg-8">
                                            <validation-provider :name="$t('comments.attributes.body')" rules="required" v-slot="{ errors, classes }">
                                                <textarea class="form-control form-control-lg" :placeholder="$t('comments.attributes.body') + '...'" v-model="comment" :class="classes"></textarea>
                                                <span>{{ errors[0] }}</span>
                                            </validation-provider>
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-primary btn-block mt-3 mt-lg-0 btn-lg rounded" type="submit"><i class="fa fa-paper-plane mr-24"></i> {{ $t('comments.actions.save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </validation-observer>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </modal>
</template>

<script>
    export default {
        name: "CampaignModalComponent",
        data() {
            return {
                loader: true,
                rtl: true,
                campaign: {},
                comments: [],
                attachments: [],
                logs: [],
                comment: '',
            };
        },
        mounted() {
            this.rtl = document.documentElement.dir === 'rtl';
        },
        methods: {
            beforeOpenCampaignModal(event) {
                var app = this;

                this.campaign = event.params.campaign;
                this.comments = [];
                this.loader = true;

                this.getComments();

                window.Echo.private('campaigns.' + this.campaign.id)
                    .listen('CommentCreated', (e) => {
                        app.comments.unshift(e.comment);
                    });

                this.getAttachments();
                this.getLogs();
            },
            getComments() {
                var app = this;
                this.axios.get('campaigns/' + this.campaign.id + '/comments').then(function (response) {
                    app.comments = response.data.data;
                }).finally(function () {
                    app.loader = false;
                });
            },
            getAttachments() {
                var app = this;
                this.axios.get('campaigns/' + this.campaign.id + '/attachments').then(function (response) {
                    app.attachments = response.data.data;
                });
            },
            addComment() {
                var app = this;
                this.axios.post('campaigns/' + this.campaign.id + '/comment', {
                    body: this.comment
                }).then(() => {
                    app.getComments();
                });
            },
            getLogs() {
                var app = this;
                this.axios.get('campaigns/' + this.campaign.id + '/logs').then((response) => {
                    app.logs = response.data.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>
