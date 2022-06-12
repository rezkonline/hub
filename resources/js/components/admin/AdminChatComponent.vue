<template>
  <div class="card">
    <div class="card-body p-5">
      <div id="chat-box" v-if="messages.length > 0">
        <scroll-loader :loader-method="getMessages" :loader-disable="disableScrollLoading"></scroll-loader>
        <div class="direct-chat-msg" v-for="message in messages" v-bind:key="message.id" :class="parseInt(authId) === parseInt(message.sender.id) ? 'right' : ''">
          <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-left">{{ message.sender.name }}</span>
            <span class="direct-chat-timestamp float-right">{{ message.created_at }}</span>
          </div>
          <!-- /.direct-chat-infos -->
          <img
            class="direct-chat-img"
            :src="message.sender.avatar"
            :alt="message.sender.name"
          />
          <!-- /.direct-chat-img -->
          <div class="direct-chat-text">{{ message.body }}</div>
          <!-- /.direct-chat-text -->
        </div>
      </div>
      <div v-if="messages.length === 0">
        <h3 class="text-center">{{ $t('messages.empty') }}</h3>
      </div>
    </div>
    <div class="card-footer">
      <div class="input-group">
        <input type="text" name="message" class="form-control" v-model="body">
        <span class="input-group-append">
          <button type="button" class="btn btn-primary" @click="sendMessage">{{ $t('messages.actions.send') }}</button>
        </span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ChatComponent",
  props: ['authId', 'authName', 'authAvatar'],
  data() {
    return {
      new: {
        id: 0,
        sender: {
          id: 0,
          name: '',
          avatar: '',
        },
        created_at: this.$t('global.now'),
        body: '',
      },
      messages: [],
      disableScrollLoading: true,
      body: "",
      page: 1,
      perPage: 10
    };
  },
  async mounted() {
    await this.getMessages();

    $('body').animate({
        scrollTop: 9999999999999
    }, 1000);

    window.Echo.private('chat.' + this.authId)
        .listen('MessageSentEvent', (e) => {
            this.messages.push(e);
        });
  },
  methods: {
    async getMessages() {
        await this.axios.get(window.location.href, {
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
        });
    },
    async sendMessage() {
      if (this.body !== '') {
        this.new.sender.id = this.authId
        this.new.sender.name = this.authName
        this.new.sender.avatar = this.authAvatar
        this.new.body = this.body

        this.axios.post(window.location.href, {
          title: null,
          type: null,
          body: this.body
        }).then((response) => {
          this.new.id = response.data.data.id
          this.messages.push(this.new)
        });
      }
    },
  },
};
</script>
