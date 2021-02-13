export const notifications = {
    methods: {
        notify(message, type, position = 'top-right') {
            this.$toast.open({
                message: message,
                duration: 5000,
                position: position,
                type: type
            });
        }
    }
};