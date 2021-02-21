<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" v-if="dataLoaded">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white user-cover">
                        <h3 class="widget-user-username text-right">Tansim Jahan</h3>
                        <h5 class="widget-user-desc text-right">Web Developer</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfileImage()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ totalUser }}</h5>
                                    <span class="description-text">User</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ totalQuestion }}</h5>
                                    <span class="description-text">Question Bank</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{ totalQuiz }}</h5>
                                    <span class="description-text">Total Quiz</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">

                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">

                            </div>

                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">First name</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.first_name" type="text" class="form-control" placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Last name</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.last_name" type="text" class="form-control" placeholder="Enter last name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.email" type="email" class="form-control"
                                                   placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bio</label>
                                        <div class="col-sm-10">
                                            <textarea v-model="form.bio" class="form-control"
                                                      placeholder="Enter bio(optional)">{{form.bio}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Profile photo</label>
                                        <div class="col-sm-10">
                                            <input @change="uploadImage" type="file" placeholder="Photo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.password" type="password" class="form-control"
                                                   placeholder="If you want change password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> I agree to the <a href="#">terms and
                                                    conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row pr-3 pl-3" style="float: right;">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button @click.prevent="submit" type="submit" class="btn btn-info">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        data(){
            return{
                formData: {},
                dataLoaded: false,
                totalUser: 0,
                totalQuiz: 0,
                totalQuestion: 0,
                form: new Form({
                    first_name: '',
                    last_name: '',
                    email: '',
                    role: 'Admin',
                    password: '',
                    status_id: 1,
                    photo: '',
                    bio: '',
                    remember: false
                })
            }
        },
        methods:{
            uploadImage(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                if(file['size'] < 2111775){
                    reader.onloadend = (file) => {
                        this.form.photo= reader.result;
                    }
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        title: 'Opps...',
                        text: "You are uploading large picture",
                        icon: 'warning',
                    })
                }
            },
            submit(){
                this.axios.patch(`/profile/${this.formData.id}`, this.form)
                    .then((response) => {
                        this.form.password = '';
                        this.form.photo = '';
                        this.getEditData();
                        toast.fire({
                            icon: 'success',
                            title: 'User info updated successfully'
                        });
                    }).catch(()=>{

                });
            },
            getProfileImage(){
                if (this.form.photo){
                    if (this.form.photo.length > 200){
                        return this.form.photo;
                    }
                }
                return '/img/profile/'+this.formData.photo;
            },
            getEditData(){
                this.axios.get('/profile')
                    .then((response) => {
                        this.formData = response.data;
                        this.form.first_name = this.formData.first_name;
                        this.form.last_name = this.formData.last_name;
                        this.form.email = this.formData.email;
                        this.form.bio = this.formData.bio;
                        this.form.photo = this.formData.photo;
                        this.dataLoaded = true;
                    }).catch((error) => {

                });
            },
            getTotalUser(){
                this.axios.get('/get-total-user')
                    .then((response) => {
                        this.totalUser = response.data;
                    }).catch((error) => {

                });
            },
            getTotalQuiz(){
                this.axios.get('/get-total-quiz')
                    .then((response) => {
                        this.totalQuiz = response.data;
                    }).catch((error) => {

                });
            },
            getTotalQuestion(){
                this.axios.get('/get-total-question')
                    .then((response) => {
                        this.totalQuestion = response.data;
                    }).catch((error) => {

                });
            }
        },
        mounted(){
            this.getEditData();
            this.getTotalUser();
            this.getTotalQuiz();
            this.getTotalQuestion();
        },
    }
</script>

<style scoped>
    .user-cover {
        height: 260px;
        width: 100%;
        background-image: url('../../../../../public/img/user-cover.jpg');
        background-position: center center;
        background-size: cover;
    }
</style>
