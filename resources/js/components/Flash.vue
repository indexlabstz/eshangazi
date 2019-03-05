<template>
    <div class="container mx-auto flex justify-end mr-4"
         v-show="show">
        <div class="absolute pin-b mb-10 bg-green rounded px-4 py-3 shadow-md"
             role="alert">
            <div class="flex">
                <div class="text-white">
                    <p class="font-medium mb-2">
                        Success Notification
                    </p>

                    <p class="text-sm">
                        {{ body }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: this.message,
                level: 'success',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash();
            }

            window.events.$on(
                'flash', data => this.flash(data)
            );
        },

        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }

                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>