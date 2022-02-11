<template>
    <div class="bg-white border rounded p-3 p-md-4 mb-3">
        <h2 class="font-16 font-lg-19 mb-3">
            {{ $t('achievements.plural') }}
        </h2>
        <div class="row row-p8" v-if="achievements.length > 0 && !loader">
            <div class="col-lg-6" v-for="achievement in achievements" :key="achievement.id">
                <div class="bg-white shadow-sm rounded p-3 p-md-4 text-center mb-24">
                    <p class="font-16 line-13 text-md-h40">
                        {{ achievement.title }}
                    </p>
                    <p class="font-15 font-md-22 m-0 font-w700 text-primary">
                        {{ achievement.value }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row row-p8" v-if="achievements.length === 0 && loader">
            <div class="col-lg-6" v-for="index in 4">
                <div class="bg-white shadow-sm rounded p-3 p-md-4 text-center mb-24">
                    <vue-content-loading :width="300" :height="100" :rtl="rtl">
                        <rect x="50" y="13" rx="8" ry="8" width="200" height="30" />
                        <rect x="100" y="50" rx="8" ry="8" width="100" height="25" />
                    </vue-content-loading>
                </div>
            </div>
        </div>
        <div class="row row-p8 text-center" v-if="achievements.length === 0 && !loader">
            <h4 class="w-100">{{ $t('achievements.empty') }}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AchievementComponent",
        props: ['lang', '4'],
        data() {
            return {
                rtl: false,
                loader: true,
                achievements: [],
                achievement: {},
            };
        },
        async mounted() {
            this.rtl = document.documentElement.dir === 'rtl';
            var app = this;
            await this.axios.get('user/achievements').then(function (response) {
                app.achievements = response.data.data;
            });
            this.loader = false;
        },
    }
</script>

<style scoped>

</style>
