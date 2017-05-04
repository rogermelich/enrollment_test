<template>
    <form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.person)">
        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('person') }">

            <!-- WET -->
                <div align="left" class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group">
                            <img src="/img/avatar.png" alt="User Image" width="150px" height="150px"/>
                        </div>
                        <!--<div class="col-xs-offset-3">-->
                        <!--{{ Auth::user()->name }} {{ Auth::user()->lastname }}-->
                        <!--</div>-->
                        <!-- /.input group -->
                    </div>
                </div>
            <br>
            <br>
                <div class="col-lg-4">
                    <label>DNI/NIE/Passaport:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" name=""
                               placeholder="DNI/NIE/Passaport"
                               data-required="true">
                    </div>

                </div>
                <div class="col-lg-4">
                    <label>TSI:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="TSI"
                               data-required="true">
                    </div>
                </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
                <div class="col-lg-4">
                    <label>Name:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                               data-required="true">
                    </div>

                </div>
                <div class="col-lg-4">
                    <label>Firts Surname:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" name="firts_surname"
                               placeholder="Firts Surname"
                               data-required="true">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Second Surname:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="Second Surname"
                               data-required="true">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Username:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" name="givename"
                               readonly="readonly" placeholder="Username">
                    </div>

                </div>
                <div class="col-md-4">
                    <label>Password Generate:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" name="password"
                               readonly="readonly" placeholder="Password Generate"
                               data-required="true">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Password:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="password" class="form-control" name="password"
                               placeholder="Password">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Password Verification:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="password" class="form-control" name="password_confirmation"
                               placeholder="Password Verification">
                        <!--{{&#45;&#45;data-required="true">&#45;&#45;}}-->
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Phone:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" name="phone" placeholder="Phone"
                               data-required="true">
                    </div>

                </div>
                <div class="col-md-4">
                    <label>Mobile:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control" name="mobile"
                               placeholder="Mobile"
                               data-required="true">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Email Center:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-at"></i>
                        </div>
                        <input type="text" class="form-control" name="email_center"
                               readonly="readonly"
                               placeholder="Email Center"> <!--data-required="true"
                                                       data-email="true"-->
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Personal Email:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-at"></i>
                        </div>
                        <input type="text" class="form-control" name="email"
                               placeholder="Personal Email"
                               data-required="true" data-email="true">
                    </div>
                </div>
                <div class="sf_columns column_3">
                    <label>Adress:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-home"></i>
                        </div>
                        <input type="text" class="form-control" name="adress"
                               placeholder="Adress"
                               data-required="true">
                    </div>

                </div>
                <div class="sf_columns column_1">
                    <label>Postal Code:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" name="postal_cpde"
                               placeholder="Postal Code"
                               data-required="true">
                    </div>
                </div>
                <div class="sf_columns column_2">
                    <label>Locality:</label>
                    <label class="sf-select">
                        <select name="locality" class="form-control" data-required="true">
                            <option value="locality">Tortosa</option>
                        </select>
                        <span></span>
                    </label>
                </div>
                <div class="sf_columns column_2">
                    <label>Date of Birthday:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control" name="dateofbirthday"
                               placeholder="Date of Birthday"
                               data-required="true">
                    </div>
                </div>
                <div class="sf_columns column_2">
                    <label>Gender:</label>
                    <div class="sf-radio">
                        <label><input type="radio" value="M" name="gender"
                                      data-required="true"><span></span> Male</label>
                        <label><input type="radio" value="F" name="gender"
                                      data-required="true"><span></span> Female</label>
                    </div>
                </div>

            <span class="help-block" v-if="form.errors.has('person')" v-text="form.errors.get('name')"></span>

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
                form: new Form({person: ''}),
                persons: []
            }
        },
        methods: {
            submit() {
                this.form.post('api/v1/persons')
                    .then(response => {
                        console.log('TODO')
                    })
                    .catch(error => {
                        console.log('ERROR')
                    })
            },
            initialitzeSelect2() {
                var component = this
                $(".select2").select2().on('TODO', function (event) {
                    component.form.set('person', person.id)
                    component.form.errors.clear()
                })
            },
            fetchpersons() {
                axios.get('api/v1/persons').then(response => {
                    this.person = response.data
                });
            }
        },
        mounted() {
            console.log('Component Form User mounted.')
            this.initialitzeSelect2()
            this.fetchpersons()
        },
        watch: {
            'form.person': function (studies) {
                //TODO SELECT STUDIES
            }
        },
    }
</script>