<template>
    <tr>
        <td>{{index + from }}</td>
        <td align="center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-flat">
                    <span>{{enrollment.user_id}}</span>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle btn-flat" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li v-for="n in 10"><a href="#" @click="editEnrollmentUserId(page,(n-1))">{{(n-1)}}</a></li>
                </ul>
            </div>
        </td>
        <td align="center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-flat">
                    <span>{{enrollment.study_id}}</span>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle btn-flat" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li v-for="n in 10"><a href="#" @click="editEnrollmentStudyId(page,(n-1))">{{(n-1)}}</a></li>
                </ul>
            </div>
        </td>
        <td align="center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-flat">
                    <span>{{enrollment.course_id}}</span>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle btn-flat" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li v-for="n in 10"><a href="#" @click="editEnrollmentCourseId(page,(n-m))">{{(n-m)}}</a></li>
                </ul>
            </div>
        </td>
        <td align="center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-flat">
                    <span>{{enrollment.classroom_id}}</span>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle btn-flat" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li v-for="n in 10"><a href="#" @click="editEnrollmentClassroomId(page,(n-1))">{{(n-1)}}</a></li>
                </ul>
            </div>
        </td>
        <td align="center">
            <div v-if="enrollment.validate_state == 1">
                <input type="checkbox" class="checkbox icheck" checked @click="editEnrollmentValidate(page,enrollment.validate_state)">
            </div>

            <div v-else>
                <input type="checkbox" class="checkbox icheck" @click="editEnrollmentValidate(page,enrollment.validate_state)">
            </div>
        </td>
        <td align="center">
            <div v-if="enrollment.finished_state == 1">
                <input type="checkbox" class="checkbox icheck" checked @click="editEnrollmentFinished(page,enrollment.finished_state)">
            </div>

            <div v-else>
                <input type="checkbox" class="checkbox icheck" @click="editEnrollmentFinished(page,enrollment.finished_state)">
            </div>
        </td>
        <td align="center">
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-flat" @click="editEnrollment(page,enrollment.id)">
                    <i class="fa fa-edit"></i>
                </button>

                <button type="button" class="btn btn-danger btn-flat" @click="deleteEnrollment(enrollment.id)">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </td>
    </tr>
</template>
<script>

    export default {
        props: ['enrollment','index','from','fetchPage','page'],

        data() {
            return {
                editing: false,
                editEnrollmentUserId: false,
                editEnrollmentStudyId: false,
                editEnrollmentCourseId: false,
                editEnrollmentClassroomId: false,
                editEnrollmentValidate: false,
                editEnrollmentFinished: false,
                n: 0,
                m: 0
            }
        },
        created() {
            console.log('Component enrollmentlist created.');
        },
        methods: {
            editEnrollment: function(pageNum) {
                if (this.editing == true) {
                    this.editEnrollmentToApi();
                    this.editing = false;
                    return this.fetchPage(pageNum);
                }
                this.editing = true;
                return this.fetchPage(pageNum);
            },
            editEnrollmentToApi: function(){
                axios.post('/api/v1/enrollments/' + this.enrollment.id, {
                }).then((response) => {
                    console.log('Enrollment ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editEnrollmentUserId: function(pageNum,number) {
                this.editEnrollmentUserToApi(number);
                return this.fetchPage(pageNum);
            },
            editEnrollmentStudyId: function(pageNum, number) {
                this.editEnrollmentStudyToApi(number);
                return this.fetchPage(pageNum);
            },
            editEnrollmentCourseId: function(pageNum,number) {
                this.editEnrollmentCourseToApi(number);
                return this.fetchPage(pageNum);
            },
            editEnrollmentClassroomId: function(pageNum,number) {
                this.editEnrollmentClassroomToApi(number);
                return this.fetchPage(pageNum);
            },
            editEnrollmentUserToApi: function(number) {
                axios.post('/api/v1/enrollments/' + this.enrollment.id,{
                    user_id: number,
                }).then((response) => {
                    console.log('User Id of enrollment ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editEnrollmentClassroomToApi: function(number) {
                axios.post('/api/v1/enrollments/' + this.enrollment.id,{
                    study_id: number,
                }).then((response) => {
                    console.log('User Id of enrollment ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editEnrollmentCourseToApi: function(number) {
                axios.post('/api/v1/enrollments/' + this.enrollment.id,{
                    course_id: number,
                }).then((response) => {
                    console.log('User Id of enrollment ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editEnrollmentStudyToApi: function(number) {
                axios.post('/api/v1/enrollments/' + this.enrollment.id,{
                    course_id: number,
                }).then((response) => {
                    console.log('User Id of enrollment ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editEnrollmentValidate: function(pageNum,validateStatus) {
                validateStatus = this.enrollment.validate = !this.enrollment.validate;
                this.editEnrollmentValidateToApi(validateStatus);
                return this.fetchPage(pageNum);
            },
            editEnrollmentFinished: function(pageNum,finishedStatus) {
                finishedStatus = this.enrollment.finished = !this.enrollment.finished;
                this.editEnrollmentFinishedToApi(finishedStatus);
                return this.fetchPage(pageNum);
            },
            editEnrollmentValidateToApi: function(validateStatus) {
                axios.post('/api/v1/enrollments/' + this.enrollment.id,{
                    validate_state: validateStatus,
                }).then((response) => {
                    console.log('Done status of task ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            editEnrollmentFinishedToApi: function(finishedStatus) {
                axios.post('/api/v1/enrollments/' + this.enrollment.id,{
                    finished_state: finishedStatus,
                }).then((response) => {
                    console.log('Done status of task ' + this.enrollment.id + ' updated succesfully!');
                }, (response) => {
                    swal("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            uneditEnrollment: function(pageNum) {
                this.editing = false;
                this.editEnrollmentUserId = false;
                this.editEnrollmentStudyId = false;
                this.editEnrollmentCourseId = false;
                this.editEnrollmentClassroomId = false;
                this.editEnrollmentValidate = false;
                this.editEnrollmentFinished = false;
                return this.fetchPage(pageNum);
            },
            deleteEnrollment: function(id) {
                console.log('Deleting enrollment');
                this.$emit('enrollment-deleted',id);
            },
        }
    }

</script>
