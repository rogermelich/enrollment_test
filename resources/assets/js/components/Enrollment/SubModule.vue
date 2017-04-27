<template>
    <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.subsubmodule)">
        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('studies') }">

            <!-- WET -->
            <div for="subsubmodule" class="form-group">
                <div class="checkbox" v-for="subsubmodule in subsubmodules" :value="submodule.id">
                    <label>
                        <input :visible="true" type="checkbox">
                        {{ submodule.name }}
                    </label>
                </div>
            </div>

            <span class="help-block" v-if="form.errors.has('submodule')" v-text="form.errors.get('name')"></span>

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
                form: new Form( { submodule: ''} ),
                submodules: [],
                visible: true
            }
        },
        methods: {
            submit() {
                this.form.post('api/v1/submodules')
                    .then( response => {
                        console.log('TODO')
                    })
                    .catch( error => {
                        console.log('ERROR')
                    })
            },
            fetchCourses() {
                axios.get('api/v1/submodules').then(response => {
                    this.submodule = response.data
                });
            }
        },
        mounted() {
            console.log('Component Form User mounted.')
            this.fetchCourses()
        },
        watch: {
            'form.submodule': function (studies) {
                //TODO SELECT STUDIES
            }
        },
    }
</script>