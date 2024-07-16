<template>
    <div class="block__box">
        <div class="container">
            <div class="row" v-if="jwtToken">
                <div class="col-md-8">
                    <div ref="jaasContainer" />
                </div>

                <div class="col-md-4">
                    HELLO
                </div>
            </div>
            <div class="row" v-else>
                <div class="col-md-12">
                    <h3 class="text-center">{{ $t('meetings.empty') }}</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MeetingComponent",
        data() {
            return {
                hasMeeting: false,
                meeting: {},
                jwtToken: null,
                api: null,
            };
        },
        async mounted() {
            this.getMeeting()
        },
        methods: {
            async getMeeting() {
                console.log(this.$refs)
                // await this.axios.get('meeting').then(async (response) => {
                //     this.meeting = response.data.data,
                //     this.jwtToken = response.data.token
                // })
            },
        },
        watch: {
            jwtToken() {
                if (this.jwtToken) {
                    this.api = new window.JitsiMeetExternalAPI("8x8.vc", {
                        roomName: `vpaas-magic-cookie-bcfb0175ebb6471fae1140ce02ed4540/${this.meeting.id}`,
                        parentNode: this.$refs.jaasContainer
                    })
                }
            }
        }
    }
</script>
