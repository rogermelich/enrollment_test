<template>
    <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.user)">
        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('studies') }">

            <!-- WET -->
            <label for="studies">Studies:</label>

            <select class="form-control select2" style="width: 80%;">

                    <option v-for="studi in studies" :value="studies.id">{{ studies.name }}</option>

            </select>


            <span class="help-block" v-if="form.errors.has('studies')" v-text="form.errors.get('name')"></span>

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
                form: new Form( { studies: ''} ),
                studies: []
            }
        },
        methods: {
            submit() {
                this.form.post('/studies')
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
                    component.form.set('studies',studies.id)
                    component.form.errors.clear()
                })
            },
            fetchStudies() {
                axios.get('/studies').then(response => {
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
            'form.studies': function (studies) {
                //TODO SELECT STUDIES
            }
        },
    }
</script>
