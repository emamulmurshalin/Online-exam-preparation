<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" v-if="dataLoaded">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white user-cover">
                        <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                        <h5 class="widget-user-desc text-right">Web Designer</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfileImage()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
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
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src=""
                                             alt="user image">
                                        <span class="username">
                                          <a href="#">Jonathan Burke Jr.</a>
                                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                            Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                          <a href="#" class="link-black text-sm">
                                            <i class="far fa-comments mr-1"></i> Comments (5)
                                          </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                           placeholder="Type a comment">
                                </div>
                                <!-- /.post -->
                            </div>

                            <div class="tab-pane" id="settings">
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
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button @click.prevent="submit" type="submit" class="btn btn-danger">Save</button>
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
                            title: 'User updated successfully'
                        });
                    }).catch(()=>{

                });
            },
            getProfileImage(){
                if (this.form.photo.length > 200){
                    return this.form.photo;
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
        },
        created(){
            this.getEditData();
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
