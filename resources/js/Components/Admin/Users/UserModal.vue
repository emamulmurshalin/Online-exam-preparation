<template>
    <div id="userModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit user</h5>
                    <h5 v-else class="modal-title">Add user</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
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
                                <div class="col-sm-12">
                                    <p
                                        v-if="errors.first_name"
                                        class="text-danger col-sm-9 mt-1 mb-0 float-right"
                                        style="font-size: 12px"
                                    >
                                        {{ errors.first_name[0] }}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Last name</label>
                                <div class="col-sm-9">
                                    <input v-model="form.last_name" type="text" name="last_name"
                                           class="form-control" placeholder="Enter last name">
                                </div>
                                <div class="col-sm-12">
                                    <p
                                        v-if="errors.last_name"
                                        class="text-danger col-sm-9 mt-1 mb-0 float-right"
                                        style="font-size: 12px"
                                    >
                                        {{ errors.last_name[0] }}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Email</label>
                                <div class="col-sm-9">
                                    <input v-model="form.email" type="email" name="email"
                                           class="form-control" placeholder="Enter email">
                                </div>
                                <div class="col-sm-12">
                                    <p
                                        v-if="errors.email"
                                        class="text-danger col-sm-9 mt-1 mb-0 float-right"
                                        style="font-size: 12px"
                                    >
                                        {{ errors.email[0] }}
                                    </p>
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
                                <label class="col-sm-3">Role</label>
                                <div class="col-sm-9">
                                    <select v-model="form.role" class="form-control">
                                        <option v-for="(role, index) in roleData" v-bind:value="role.name" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{ role.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Status</label>
                                <div class="col-sm-9">
                                    <select v-model="form.status_id" class="form-control">
                                        <option v-for="(status, index) in statusData" v-bind:value="status.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{ status.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Password</label>
                                <div class="col-sm-9">
                                    <input v-model="form.password" type="password" name="password"
                                           class="form-control d-flex justify-content-center" @input="checkMatchPassword"
                                           placeholder="Password">
                                </div>
                                <div class="col-sm-12">
                                    <p
                                        v-if="errors.password"
                                        class="text-danger col-sm-9 mt-1 mb-0 float-right"
                                        style="font-size: 12px"
                                    >
                                        {{ errors.password[0] }}
                                    </p>
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
                    <button type="button" class="btn btn-danger" @click.prevent="closeModal">
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
                roleData:[
                    {
                        id: 1,
                        name: 'Admin'
                    },
                    {
                        id: 2,
                        name: 'User'
                    }
                ],
                modalId: 'userModal',
                formData: {},
                errors: {},
                statusData: {},
                dataLoaded: false,
                form: new Form({
                    first_name: '',
                    last_name: '',
                    email: '',
                    role: 'User',
                    password: '',
                    status_id: 3,
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
            getStatus(){
                this.axios.get('/get-status')
                    .then((response) => {
                        this.statusData = response.data;
                    }).catch(()=>{

                });
            },
            initState(){
                this.form.first_name = '';
                this.form.last_name = '';
                this.form.email = '';
                this.form.role = '';
                this.form.status_id = '';
                this.form.bio = '';
                this.form.status_id = '';
                this.form.password = '';
                this.form.confirm_password = '';
            },
            submit(){
                this.axios.post('/users', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.closeModal();
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                }).finally(()=>{

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
                    }).catch(error=>{
                        this.errors = error.response.data.errors;
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
                        this.form.role = this.formData.role;
                        this.form.status_id = this.formData.status_id;
                    }).catch((error) => {

                });
            },
            closeModal(){
                this.initState();
                this.$emit("close-modal", this.modalId);
            }
        },
        mounted(){
            this.getStatus();
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
