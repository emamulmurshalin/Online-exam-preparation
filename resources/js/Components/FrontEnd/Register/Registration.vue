<template>

    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>R</span>egistration
                    <span>F</span>orm
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <div class="register-form">
                <form action="#" method="post">
                    <div class="fields-grid">
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
                            <div class="col-sm-9 p-2">
                                <input v-model="form.password" type="password" name="password"
                                       class="form-control d-flex justify-content-center" @input="checkMatchPassword"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Confirm password</label>
                            <div class="col-sm-9 p-2">
                                <input v-model="form.confirm_password" type="password" name="confirm_password"
                                       class="form-control d-flex justify-content-center" @input="checkMatchPassword"
                                       placeholder="Confirm password">
                            </div>
                        </div>

                        <div class="clearfix"> </div>
                    </div>
                    <input  @click.prevent="register" type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Registration",
    data(){
        return{
            formData: {},
            form: new Form({
                first_name: '',
                last_name: '',
                email: '',
                role: 'User',
                password: '',
                status_id: 2,
                photo: '',
                bio: '',
                remember: false
            })
        }
    },
    methods:{
        register(){
            this.axios.post('/users', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Registration successfully'
                    });
                    window.location.replace('/');
                }).catch(()=>{

            });
        },
        checkMatchPassword(){
            console.log('hoise');
        }
    }
}
</script>
