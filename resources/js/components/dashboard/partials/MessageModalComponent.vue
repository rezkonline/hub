<template>
    <modal name="message" height="auto" @before-open="beforeOpenMessageModal">
            <div class="p-3 p-lg-5">
                <h4 class="font-18 mb-1 text-primary">{{ message.title }}</h4>
                <p class="mb-3 font-15 text-light">
                    <i class="far fa-clock mr-2"></i>
                    {{ message.created_at }}
                </p>
                <div class="singlecontentbg">
                    {{ message.body }}
                </div>
                <div class="mt-4 text-right">
                    <button class="btn btn-primary btn-lg btn-mw150 rounded" @click="$modal.hide('message')">اغلاق</button>
                </div>
            </div>
        </modal>
</template>

<script>
    export default {
        name: "MessageModalComponent",
        data() {
            return {
                message: {},
            };
        },
        methods: {
            beforeOpenMessageModal(event) {
                this.message = event.params.message;

                // Mark this message as read
                this.axios.put('messages/' + this.message.id);
            },
        }
    }
</script>

<style scoped>

</style>
