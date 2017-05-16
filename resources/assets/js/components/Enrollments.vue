<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Enrollments</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="input-group">
                    <div class="col-lg-4 col-md-4">
                        <label for="user">User:</label>

                        <select class="form-control select2">
                            <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label for="study">Study:</label>

                        <select class="form-control select2">
                            <option v-for="study in studies" :value="study.id">{{ study.name }}</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label for="course">Course:</label>

                        <select class="form-control select2">
                            <option v-for="course in courses" :value="course.id">{{ course.name }}</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label for="classroom">Classroom:</label>

                        <select class="form-control select2">
                            <option v-for="classroom in classrooms" :value="classroom.id">{{ classroom.name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label>Validate:</label>
                        <div class="form-group">
                            <label>
                                <input type="radio" name="r1" value="True" class="minimal" checked>
                            </label>
                            <label>
                                <input type="radio" name="r1" value="False" class="minimal">
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label>Finished:</label>
                        <div class="form-group">
                            <label>
                                <input type="radio" name="r2" value="True" class="minimal" checked>
                                True
                            </label>
                            <label>
                                <input type="radio" name="r2" value="False" class="minimal">
                                False
                            </label>
                        </div>
                    </div>


                    <button class="btn center-block btn-primary"
                            @click="addEnrollment">Create Enrollment
                    </button>

                </div>

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
                            <th>created at</th>
                            <th>updated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <enrollment v-for="(enrollment, index) in filteredEnrollments"
                                    v-bind:enrollment="enrollment"
                                    v-bind:index="index"
                                    v-bind:from="from"
                                    v-bind:page="page"
                                    v-bind:fetchPage="fetchPage"
                                    @todo-deleted="deleteEnrollments">
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
                create_at: '',
                update_at: '',
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
                    },
                    active: function (enrollments) {
                        return enrollments.filter(function (enrollment) {
                            return enrollment.finished;
                        });
                    },
                    completed: function (enrollments) {
                        return enrollments.filter(function (enrollment) {
                            return enrollment.validated;
                        });
                    }
                }
                return filters[this.visibility](this.enrollments);

            }
        },
        created() {
            console.log('Component enrollmentList created.');
            this.fetchData();
        },
        methods: {
            initialitzeSelect2() {
                var component = this
                $(".select2").select2().on('TODO', function (event) {
                    component.form.set('user', user.id)
                    component.form.set('study', study.id)
                    component.form.set('course', course.id)
                    component.form.set('classroom', classroom.id)

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
            fetchclassrooms() {
                axios.get('/api/v1/classrooms').then(response => {
                    this.classrooms = response.data
                });
            },
            getEnrollmentId: function (index) {
                this.$http.get('/api/v1/enrollments').then((response) => {
                    var enrollments = this.enrollments = response.data.data;
                    this.id = enrollments[index].id;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            pageChanged: function (pageNum) {
                this.page = pageNum;
                this.fetchPage(pageNum);
            },
            addEnrollment: function () {
                var user = this.user && this.user.trim();
                var study = this.study && this.study.trim();
                var course = this.course && this.course.trim();
                var classroom = this.classroom && this.classroom.trim();
                var validate = this.validate && this.validate.trim();
                var finished = this.finished && this.finished.trim();
                var create_at = this.create_at && this.create_at.trim();
                var update_at = this.update_at && this.update_at.trim();

                var value = this.value && this.value.trim();
                if (!value) {
                    return;
                }
                var enrollment = {
                    user: user,
                    study: study,
                    course: course,
                    classroom: classroom,
                    validate: validate,
                    finished: finished,
                    create_at: create_at,
                    update_at: update_at,
                    value: value
                };
                this.user = '',
                    this.study = '',
                    this.course = '',
                    this.classroom = '',
                    this.validate = false,
                    this.finished = false,
                    this.create_at = '',
                    this.update_at = '',
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
                this.$http.post('/api/v1/enrollments', {
                    user: enrollment.user,
                    study: enrollment.study,
                    course: enrollment.course,
                    classroom: enrollment.classroom,
                    validate: enrollment.validate,
                    finished: enrollment.finished,
                    create_at: enrollment.create_at,
                    update_at: enrollment.update_at,
                    value: enrollment.value
                }).then((response) => {
                    console.log(response);
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                this.fetchPage(this.page);
            },
            fetchPage: function (page) {
                this.$http.get('/api/v1/enrollments?page=' + page).then((response) => {
                    console.log(response);
                    this.enrollments = response.data.data;
                    this.perPage = response.data.per_page;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
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
                        sweetAlert("Deleted!", "Your enrollment has been deleted.", "success");
                    });
            },
            deleteEnrollmentFromApi: function (id) {
                this.$http.delete('/api/v1/enrollments/' + id).then((response) => {
                    console.log('Enrollment ' + id + ' deleted succesfully!');
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
                this.fetchPage(this.page);
            }
        }
    }
</script>
