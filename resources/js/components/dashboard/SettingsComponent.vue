<template>
    <div>
        <div class="block__box">
            <div class="bg-white border rounded">
                <div class="block__box--title text-white bg-gradient py-24 px-3 rounded-top">
                    <h2 class="font-16 font-lg-19 m-0">
                        {{ $t('frontend.menus.settings') }}
                    </h2>
                </div>
                <div class="block__box--content p-2 p-md-3 p-lg-4">
                    <div class="row mb-4">
                        <div class="col-lg-6 m-auto">
                            <validation-observer v-slot="{ handleSubmit }">
                                <form @submit.prevent="handleSubmit(updateUser)">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div class="mb-1 position-relative">
                                                <img :src="$store.state.user.avatar" :alt="$store.state.user.name" class="img-fluid rounded-circle img-h75 border cursor-pointer" @click="uploadAvatar">
                                            </div>
                                            <input type="file" ref="avatar" name="avatar" class="d-none" @change="doFileChangeEvent">
                                            <span class="text-center cursor-pointer" @click="uploadAvatar">{{ $t('customers.actions.avatar') }}</span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name">{{ $t('customers.attributes.name') }}</label>
                                                <validation-provider :name="$t('customers.attributes.name')" rules="required" v-slot="{ errors, classes }">
                                                    <input type="text" name="name" class="form-control" :class="classes" v-model="name">
                                                    <span class="is-invalid">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email">{{ $t('customers.attributes.email') }}</label>
                                                <validation-provider :name="$t('customers.attributes.email')" rules="required|email" v-slot="{ errors, classes }">
                                                    <input type="email" name="email" class="form-control" :class="classes" v-model="email">
                                                    <span class="is-invalid">{{ errors[0] }}</span>
                                                </validation-provider>
                                                <small class="text-muted">{{ $t('customers.alerts.email') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="phone">{{ $t('customers.attributes.phone') }}</label>
                                                <validation-provider :name="$t('customers.attributes.phone')" rules="required" v-slot="{ errors, classes }">
                                                    <input type="text" name="phone" class="form-control" :class="classes" v-model="phone">
                                                    <span class="is-invalid">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <h5>{{ $t('customers.actions.password') }}</h5>
                                            <div class="form-group">
                                                <label for="old_password">{{ $t('customers.attributes.old_password') }}</label>
                                                <validation-provider :name="$t('customers.attributes.old_password')" rules="required|min:8" v-slot="{ errors, classes }">
                                                    <input type="password" name="old_password" class="form-control" :class="classes" v-model="old_password">
                                                    <span class="is-invalid">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">{{ $t('customers.attributes.password') }}</label>
                                                <validation-provider :name="$t('customers.attributes.password')" rules="required|min:8" v-slot="{ errors, classes }">
                                                    <input type="password" name="password" class="form-control" :class="classes" v-model="password">
                                                    <span class="is-invalid">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">{{ $t('customers.attributes.password_confirmation') }}</label>
                                                <validation-provider :name="$t('customers.attributes.old_password')" rules="required|min:8" v-slot="{ errors, classes }">
                                                    <input type="password" name="password_confirmation" class="form-control" :class="classes" v-model="password_confirmation">
                                                    <span class="is-invalid">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary" :disabled="loading">{{ $t('customers.actions.save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </validation-observer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            rtl:  false,
            name: '',
            email: '',
            phone: '',
            old_password: '',
            password: '',
            password_confirmation: '',
            errors: [],
        }
    },
    async mounted() {
        this.rtl = document.documentElement.dir === 'rtl'
        await this.$store.dispatch('fetch')

        this.name = this.$store.state.user.name
        this.email = this.$store.state.user.email
        this.phone = this.$store.state.user.phone
    },
    methods: {
        async updateUser() {
            this.loading = true

            await this.axios.post('/user/update', {
                name: this.name,
                email: this.email,
                old_password: this.old_password,
                password: this.password,
                password_confirmation: this.password_confirmation,
            }).then((response) => {
                this.$toast.success(this.$t('customers.messages.updated'))
                this.$store.commit('set_user', response.data.data)

                this.resetForm()
            }).finally(() => {
                this.loading = false
            }).catch((e) => {
                this.errors = e.response.data.errors
            })
        },
        uploadAvatar() {
            this.$refs.avatar.click()
        },
        async doFileChangeEvent() {
            this.loading = true

            let formData = new FormData()
            formData.append('avatar', this.$refs.avatar.files[0])

            await this.axios.post('/user/update', formData).then((response) => {
                this.$toast.success(this.$t('customers.messages.updated'))
                this.$store.commit('set_user', response.data.data)
            }).finally(() => {
                this.loading = false
            }).catch((e) => {
                this.errors = e.response.data.errors
            })
        },
        resetForm() {
            this.old_password = ''
            this.password = ''
            this.password_confirmation = ''
        },
    },
}
</script>
