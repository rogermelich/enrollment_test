<template>
    <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.module)">
        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('studies') }">

            <!-- WET -->
            <div for="module" class="form-group">
                <div class="checkbox" v-for="module in modules" :value="module.id">
                    <label>
                        <input :visible="true" type="checkbox">
                        {{ module.name }}
                    </label>
                </div>
            </div>

            <span class="help-block" v-if="form.errors.has('module')" v-text="form.errors.get('name')"></span>

        </div>
        <!--<button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="form.errors.any()"><i v-if="form.submitting" class="fa fa-refresh fa-spin"></i> Next</button>-->
    </form>
</template>

<script>
    import FormMixin from './formMixin'
    import Form from 'acacha-forms'
    export default {
        mixins: [FormMixin],
        data: function () {
            return {
                form: new Form( { module: ''} ),
                modules: [],
                visible: true
            }
        },
        methods: {
            submit() {
                this.form.post('api/v1/modules')
                    .then( response => {
                        console.log('TODO')
                    })
                    .catch( error => {
                        console.log('ERROR')
                    })
            },
            fetchCourses() {
                axios.get('api/v1/modules').then(response => {
                    this.module = response.data
                });
            }
        },
        mounted() {
            console.log('Component Form User mounted.')
            this.fetchCourses()
        },
        watch: {
            'form.module': function (studies) {
                //TODO SELECT STUDIES
            }
        },
    }
</script>