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
                        <div class="col-lg-6">
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
                        <div class="col-lg-6">
                            <h3>{{ $t('packages.plural') }}</h3>
                            <div v-for="pack in packages" :key="pack.id" @click="selectPackage(pack)" class="bg-white shadow-sm rounded p-4 d-md-flex align-items-center justify-content-between mb-3 mb-lg-0 cursor-pointer">
                                <p class="font-18 mb-2 mb-md-0">
                                    {{ pack.name }} (#{{ pack.id }})
                                </p>
                                <p class="font-15 font-md-22 m-0 font-w700 text-primary">
                                    {{ pack.created_at_formatted }}
                                </p>
                            </div>
                            <div class="alert alert-warning" v-if="!packages.length">
                                {{ $t('customers.alerts.packages') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal name="package-modal" height="auto" v-if="Object.keys(pack).length">
            <div class="p-3 p-lg-5">
                <h4 class="font-18 mb-1 text-primary">{{ $t('package_features.actions.show', { name: pack.name }) }}</h4>
                <div class="singlecontentbg">
                    <ul>
                        <li>Hello</li>
                    </ul>
                </div>
                <div class="mt-4 text-left">
                    <button class="btn btn-primary btn-lg btn-mw150 rounded" @click="$modal.hide('package-modal')">اغلاق</button>
                </div>
            </div>
        </modal>
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
            packages: [],
            errors: [],
            pack: {},
        }
    },
    async mounted() {
        this.rtl = document.documentElement.dir === 'rtl'
        await this.$store.dispatch('fetch')

        this.name = this.$store.state.user.name
        this.email = this.$store.state.user.email
        this.phone = this.$store.state.user.phone

        await this.getPackages()
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
        async getPackages() {
            await this.axios.get('user/packages').then((response) => {
                this.packages = response.data.data
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
        selectPackage(pack) {
            this.pack = pack
            this.$modal.show('package-modal')
        }
    },
}
</script>
