<template>
    <div id="userModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit user</h5>
                    <h5 v-else class="modal-title">Add user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3">First name</label>
                                <div class="col-sm-9">
                                    <input v-model="form.first_name" type="text" name="first_name"
                                           class="form-control" placeholder="Enter first name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Last name</label>
                                <div class="col-sm-9">
                                    <input v-model="form.last_name" type="text" name="last_name"
                                           class="form-control" placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Email</label>
                                <div class="col-sm-9">
                                    <input v-model="form.email" type="email" name="email"
                                           class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Bio</label>
                                <div class="col-sm-9">
                                    <textarea v-model="form.bio" name="bio"
                                              class="form-control d-flex justify-content-center"
                                              placeholder="Enter Bio(optional)"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Password</label>
                                <div class="col-sm-9">
                                    <input v-model="form.password" type="password" name="password"
                                           class="form-control d-flex justify-content-center" @input="checkMatchPassword"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Confirm password</label>
                                <div class="col-sm-9">
                                    <input v-model="form.confirm_password" type="password" name="confirm_password"
                                           class="form-control d-flex justify-content-center" @input="checkMatchPassword"
                                           placeholder="Confirm password">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancel
                    </button>
                    <button v-if="selectedUrl" type="submit" class="btn btn-primary" @click.prevent="update">
                        Update
                    </button>
                    <button v-else type="submit" class="btn btn-primary" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserModal",
        props: ['selectedUrl'],
        data(){
            return{
                modalId: 'userModal',
                formData: {},
                dataLoaded: false,
                form: new Form({
                    first_name: '',
                    last_name: '',
                    email: '',
                    role_id: 1,
                    password: '',
                    status_id: 1,
                    photo: '',
                    bio: '',
                    remember: false
                })
            }
        },
        methods:{
            checkMatchPassword(){
                console.log('asche');
            },
            submit(){
                this.axios.post('/users', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.closeModal();
                }).catch(()=>{
                    this.closeModal();
                });
            },
            update(){
                this.axios.patch(this.selectedUrl, this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'User updated successfully'
                        });
                        this.closeModal();
                    }).catch(()=>{
                    this.selectedUrl = '';
                    this.closeModal();
                });
            },
            getEditData(){
                this.axios.get(this.selectedUrl)
                    .then((response) => {
                        this.formData = response.data;
                        this.form.first_name = this.formData.first_name;
                        this.form.last_name = this.formData.last_name;
                        this.form.email = this.formData.email;
                        this.form.bio = this.formData.bio;
                    }).catch((error) => {

                });
            },
            closeModal(){
                this.$emit("close-modal", this.modalId);
            }
        },
        created(){
            if (this.selectedUrl){
                this.getEditData();
            }
        },
    }
</script>

<style scoped>
    .modal-lg {
        max-width: 48%;
    }
</style>