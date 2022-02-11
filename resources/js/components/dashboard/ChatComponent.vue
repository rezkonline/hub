<template>
    <div class="block__box">
            <div v-if="messages.length > 0" id="chat-box">
                <scroll-loader :loader-method="getMessages" :loader-disable="disableScrollLoading"></scroll-loader>
                <div class="block__chat mb-4" v-for="message in messages" :class="message.sender.id !== $store.state.user.id ? 'block__chat--even' : ''" :key="message.id">
                    <div class="block__chat--user d-flex flex-wrap align-items-center mb-3">
                        <img class="rounded mr-3" :src="message.sender.avatar" :alt="message.sender.name">
                        <div>
                            <h3 class="font-14 font-lg-17 mb-1">
                                {{ message.sender.name }}
                            </h3>
                            <p class="m-0 font-17">
                                {{ message.created_at }}
                            </p>
                        </div>
                    </div>
                    <div class="row block__chat--text">
                        <div class="col-12 col-md-10 col-lg-7">
                            <div class="bgbg rounded p-2 p-md-3 p-lg-4 border border-w2">
                                <p class="m-0 font-18 line-14">
                                    {{ message.body }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="messages.length === 0">
                <h3 class="text-center">{{ $t('messages.empty') }}</h3>
            </div>
            <div>
                    <form @submit.prevent="handleSubmit(sendMessage)">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-12">
                                    <textarea class="form-control form-control-lg" v-model="body"></textarea>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <button class="btn btn-primary btn-block mt-3 mt-lg-0 btn-lg rounded" type="submit"><i class="fa fa-paper-plane mr-24"></i> {{ $t('messages.actions.send') }}</button>
                            </div>
                        </div>
                    </form>
            </div>
    </div>
</template>

<script>
    export default {
        name: "ChatComponent",
        data() {
            return {
                messages: [],
                disableScrollLoading: true,
                body: '',
                page: 1,
                perPage: 10,
            };
        },
        async mounted() {
            await this.getMessages()

            $('html, body').animate({
                scrollTop: 9999
            }, 1000)

            Echo.private('chat.' + this.$store.state.user.id)
                .listen('MessageSentEvent', (e) => {
                    this.messages.push(e)
                })
        },
        methods: {
            async sendMessage() {
                await this.axios.post('messages', {
                    title: 'Message',
                    body: this.body,
                    customer_id: this.$store.state.user.id,
                    manager_id: this.$store.state.user.manager_id,
                });

                this.body = '';
                this.getLastMessage();
            },
            async getMessages() {
                await this.axios.get('messages/chat', {
                    params: {
                        perPage: this.perPage,
                        page: this.page++,
                    }
                }).then(async (response) => {
                    await response.data.data.forEach((message) => {
                        this.messages.unshift(message);
                    });
                    setTimeout(() => {
                        this.disableScrollLoading = response.data.data.length < this.perPage;
                    }, 1500);
                    this.body = '';
                })
            },
            async getLastMessage() {
                await this.axios.get('messages/last').then((response) => {
                    this.messages.push(response.data.data)
                })
            },
        },
    }
</script>

<style scoped>

</style>
