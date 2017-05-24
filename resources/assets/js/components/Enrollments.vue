<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Enrollments</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="#">

                    <div class="input-group">
                        <div class="col-lg-4 col-md-4">
                            <label for="user">User:</label>
                            <br>
                            <select class="form-control" v-model="user">
                                <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label for="studies">Study:</label>

                            <select class="form-control" v-model="study">
                                <option v-for="study in studies" :value="study.id">{{ study.name }}</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label for="courses">Course:</label>

                            <select class="form-control" v-model="course">
                                <option v-for="course in courses" :value="course.id">{{ course.name }}</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label for="classrooms">Classroom:</label>

                            <select class="form-control" v-model="classroom">
                                <option v-for="classroom in classrooms" :value="classroom.id">{{ classroom.name }}
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label>Validate:</label>
                            <div class="form-group">
                                <input type="checkbox" id="checkbox" v-model="validate">
                                <label for="checkbox">{{ validate }}</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label>Finished:</label>
                            <div class="form-group">
                                <input type="checkbox" id="checkbox2" v-model="finished">
                                <label for="checkbox">{{ finished }}</label>
                            </div>
                        </div>

                        <button class="btn center-block btn-primary"
                                @click="addEnrollment">Add
                        </button>

                    </div>
                </form>

            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Enrollments</h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">{{visibility}}</button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" @click="setVisibility('all')">All</a></li>
                            <li><a href="#" @click="setVisibility('active')">Active</a></li>
                            <li><a href="#" @click="setVisibility('completed')">Completed</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>User</th>
                            <th>Study</th>
                            <th>Course</th>
                            <th>Classroom</th>
                            <th>Validate</th>
                            <th>Finished</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <enrollment v-for="(enrollment, index) in filteredEnrollements"
                                    v-bind:enrollment="enrollment"
                                    v-bind:index="index"
                                    v-bind:from="from"
                                    v-bind:page="page"
                                    v-bind:fetchPage="fetchPage"
                                    @enrollment-deleted="deleteEnrollment">
                        </enrollment>
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
                <!--
                TODO http://www.pontikis.net/labs/bs_pagination/demo/
                http://fareez.info/blog/pagination-component-using-vuejs/
                https://laravel.com/docs/5.3/pagination
                https://laravel.com/api/5.1/Illuminate/Pagination/AbstractPaginator.html
                -->
                <div class="box-footer clearfix">
                    <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries</span>

                    <pagination
                            :current-page="page"
                            :items-per-page="perPage"
                            :total-items="total"
                            @page-changed="pageChanged"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import Pagination from './Pagination.vue'
    import Enrollment from './Enrollment.vue'

    export default {
        components: {Pagination, Enrollment},
        data() {
            return {
                enrollments: [],
                visibility: 'all', // 'active' 'completed'
                user: '',
                users: [],
                study: '',
                studies: [],
                course: '',
                courses: [],
                classroom: '',
                classrooms: [],
                validate: false,
                finished: false,
                perPage: 5,
                from: 0,
                to: 0,
                total: 0,
                page: 1,
                editing: false
            }
        },
        computed: {
            filteredEnrollements: function () {

                var filters = {
                    all: function (enrollments) {
                        return enrollments;
                    }
//                    active: function (enrollments) {
//                        return enrollments.filter(function (enrollment) {
//                            return enrollment.finished;
//                        });
//                    },
//                    completed: function (enrollments) {
//                        return enrollments.filter(function (enrollment) {
//                            return enrollment.validated;
//                        });
//                    }
                }
                return filters[this.visibility](this.enrollments);

            }
        },
        created() {
            console.log('Component enrollmentList created.');
            this.fetchData();
        },
        mounted() {
            this.fetchUsers();
            this.fetchStudies();
            this.fetchCourses();
            this.fetchClassrooms();
            this.initializeSelect2();
        },
        methods: {
            initializeSelect2() {
                var component = this
                $(".select2").select2().on('TODO', function (event) {
                    component.form.set('user', users.id)
                    component.form.set('study', studies.id)
                    component.form.set('course', courses.id)
                    component.form.set('classroom', classrooms.id)

                })
            },
            fetchUsers() {
                axios.get('/api/v1/user').then(response => {
                    this.users = response.data
                });
            },
            fetchStudies() {
                axios.get('/api/v1/studies').then(response => {
                    this.studies = response.data
                });
            },
            fetchCourses() {
                axios.get('/api/v1/courses').then(response => {
                    this.courses = response.data
                });
            },
            fetchClassrooms() {
                axios.get('/api/v1/classrooms').then(response => {
                    this.classrooms = response.data
                });
            },
            getEnrollmentId: function (index) {
                axios.get('/api/v1/enrollments').then((response) => {
                    var enrollments = this.enrollments = response.data.data;
                    this.id = enrollments[index].id;
                }, (response) => {
                    // error callback
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            pageChanged: function (pageNum) {
                this.page = pageNum;
                this.fetchPage(pageNum);
            },
            addEnrollment: function () {
                console.log('heysyyyyy');
                console.log('User is:', this.user);
                console.log('Study is:', this.study);
                console.log('Course is:', this.course);
                console.log('Classroom is:', this.classroom);
                console.log('Validate is:', this.validate);
                console.log('Finished is:', this.finished);
                var user = this.user;
                var study = this.study;
                var course = this.course;
                var classroom = this.classroom;
                var validate = this.validate;
                var finished = this.finished;
                var enrollment = {
                    user: user,
                    study: study,
                    course: course,
                    classroom: classroom,
                    validate: validate,
                    finished: finished
                };
                this.addEnrollmentToApi(enrollment);
                this.fetchPage(this.page);
            },
            setVisibility: function (visibility) {
                this.visibility = visibility;
            },
            fetchData: function () {
                return this.fetchPage(1);
            },
            addEnrollmentToApi: function (enrollment) {
                axios.post('/api/v1/enrollments', {
                    user: enrollment.user,
                    study: enrollment.study,
                    course: enrollment.course,
                    classroom: enrollment.classroom,
                    validate: enrollment.validate,
                    finished: enrollment.finished
                }).then((response) => {
                    // error callback
                    console.log('response');
                    console.log(response);
                    console.log('response');

                    //swal("Oops...", "Something went wrong!", "error");
                    //console.log(response);
                });
                //this.fetchPage(this.page);
            },
            fetchPage: function (page) {
                axios.get('/api/v1/enrollments?page=' + page).then((response) => {
                    this.enrollments = response.data.data;
                    this.perPage = response.data.per_page;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                }, (response) => {
                    // error callback
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            deleteEnrollment: function (id) {
                var del = this;
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this enrollment!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD4B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function () {
                        del.deleteEnrollmentFromApi(id);
                        swal("Deleted!", "Your enrollment has been deleted.", "success");
                    });
            },
            deleteEnrollmentFromApi: function (id) {
                axios.delete('/api/v1/enrollments/' + id).then((response) => {
                    console.log('Enrollment ' + id + ' deleted succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                this.fetchPage(this.page);
            }
        }
    }
</script>
