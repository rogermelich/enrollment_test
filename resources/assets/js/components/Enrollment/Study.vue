<template>
    <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.studies)">
        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('studies') }">

            <!-- WET -->
            <label for="study">Study:</label>

            <select class="form-control select2" style="width: 80%;">

                    <option v-for="study in studies" :value="study.id">{{ study.name }}</option>

            </select>


            <span class="help-block" v-if="form.errors.has('study')" v-text="form.errors.get('name')"></span>

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
                form: new Form( { study: ''} ),
                studies: []
            }
        },
        methods: {
            submit() {
                this.form.post('/api/v1/studies')
                    .then( response => {
                        console.log('TODO')
                    })
                    .catch( error => {
                        console.log('ERROR')
                    })
            },
            initialitzeSelect2() {
                var component = this
                $(".select2").select2().on('TODO', function(event){
                    component.form.set('study',studies.id)
                    component.form.errors.clear()
                })
            },
            fetchStudies() {
                axios.get('/api/v1/studies').then(response => {
                    this.studies = response.data
                });
            }
        },
        mounted() {
            console.log('Component Form User mounted.')
            this.initialitzeSelect2()
            this.fetchStudies()
        },
        watch: {
            'form.study': function (studies) {
                //TODO SELECT STUDIES
            }
        },
    }
</script>
