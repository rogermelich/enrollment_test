<template>
    <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.user)">
        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('user') }">

            <label for="user">User:</label>

            <select class="form-control select2" style="width: 80%;">

                <option v-for="user in users" :value="user.id">{{ user.name }}</option>

            </select>

            <span class="help-block" v-if="form.errors.has('user')" v-text="form.errors.get('name')"></span>

        </div>
    </form>
</template>

<script>
    import FormMixin from './formMixin.js'
    import Form from 'acacha-forms'
    export default {
        mixins: [FormMixin],
        data: function () {
            return {
                form: new Form( { user: ''} ),
                users: []
            }
        },
        methods: {
            submit() {
//                this.form.post('/user')
//                    .then( response => {
//                        console.log('Enrollment user form submitted ok')
//                        this.$bus.$emit('formSubmit')
//                    })
//                    .catch( error => {
//                        console.log('Enrollment user form error submitting: ' + error)
//                    })
            },
            initialitzeSelect2() {
                var component = this
                $(".select2").select2().on('TODO', function(event){
                    component.form.set('user',user.id)
                    component.form.errors.clear()
                })
            },
            fetchUsers() {
                axios.get('/api/v1/user').then(response => {
                    this.users = response.data
                });
            }
        },
        mounted() {
            console.log('Component Form User mounted.')
            this.initialitzeSelect2()
            this.fetchUsers()
        },
        watch: {
            'form.user': function (user) {
                //TODO API SELECT PER SELECCIONAR el user amb i user.id
            }
        },
    }
</script>
