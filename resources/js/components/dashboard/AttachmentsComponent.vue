<template>
    <div class="bg-white border rounded p-3 p-md-4 mb-3">
        <h2 class="font-16 font-lg-19 mb-3">
            {{ $t('attachments.plural') }}
        </h2>
        <div class="row row-p8" v-if="attachments.length > 0">
            <a class="btn btn-primary rounded" v-for="attachment in attachments" :key="attachment.id" :href="attachment.url">{{ attachment.name }}</a>
        </div>
        <div class="row row-p8 text-center" v-if="attachments.length === 0">
            <h4 class="w-100">{{ $t('attachments.empty') }}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AttachmentsComponent",
        computed: {
            attachments() {
                return this.$store.state.user.attachments || []
            }
        }
    }
</script>

<style scoped>

</style>
