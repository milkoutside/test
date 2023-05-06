<template>
    <div v-if="visible" class="notification">
        <div class="notification__message">{{ message }}</div>
        <button class="notification__close" @click="close">&times;</button>
    </div>
</template>

<script>
export default {
    name: 'Notification',
    methods: {
        addMessage(message) {
            this.messages.push(message);
            setTimeout(() => {
                this.removeMessage(message);
            }, 2000);
        },
        removeMessage(message) {
            const index = this.messages.indexOf(message);
            if (index > -1) {
                this.messages.splice(index, 1);
            }
        }
    },
    computed: {
        messageStyles() {
            return {
                position: 'fixed',
                top: '0',
                right: '0',
                padding: '0.75rem',
                'z-index': '9999',
                'font-size': '1rem',
                'background-color': '#fff',
                'box-shadow': '0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)',
                'border-top-left-radius': '0.25rem',
                'border-bottom-left-radius': '0.25rem'
            }
        }
    }
}

</script>

<style scoped>

</style>
