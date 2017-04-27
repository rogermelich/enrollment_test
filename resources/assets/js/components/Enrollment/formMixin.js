export default {
    props: {
        submitButton:{
            type: Boolean,
            default: true
        }
    },
    methods: {
        onWizardNext() {
            this.$bus.$on('wizardNext', (step)=> {
                if (step === 1) this.submit();
            });
        }
    },
    mounted() {
        this.onWizardNext()
        const header = {
            'Authorization': 'Bearer ' + response.data.access_token
        };
    }
}
