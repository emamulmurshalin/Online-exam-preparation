<template>

    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>L</span>ogin
                    <span>F</span>orm
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <div class="login-form">
                <form action="#" method="post">
                    <div class="">
                        <p>User Name </p>
                        <input type="email" class="name" name="user name" v-model="form.email" required="" />
                    </div>
                    <div class="">
                        <p>Password</p>
                        <input type="password" class="password" name="Password" v-model="form.password" required="" />
                    </div>
                    <label class="anim">
                        <input type="checkbox" class="checkbox">
                        <span> Remember me ?</span>
                    </label>
                    <div class="login-agileits-bottom wthree">
                        <h6>
                            <a href="#">Forgot password?</a>
                        </h6>
                    </div>
                    <input @click.prevent="loginUser" type="submit" value="Login">
                    <div class="register-forming">
                        <p>To Register New Account --
                            <a href="/user/registration">Click Here</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "Login",
    data(){
        return{
            form: new Form({
                email: '',
                password: ''
            })
        }
    },
    methods:{
        loginUser(){
            this.axios.post('/admin-login', this.form)
                .then((response) => {
                    console.log(response);
                    if (response.data.status == 200){
                        console.log('ljkljk');
                        toast.fire({
                            icon: 'success',
                            title: 'User login successfully'
                        });
                        window.location.replace('/dashboard');
                    }else {
                        console.log('wrong');
                        toast.fire({
                            icon: 'error',
                            title: 'Login information wrong'
                        });
                        window.location.reload();
                    }
                }).catch(()=>{

            });
        }
    }
}
</script>

