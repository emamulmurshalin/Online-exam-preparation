<template>

    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>R</span>eset Password
                    <span>F</span>orm
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <div class="login-form">
                <form action="#" method="post">
                    <div class="">
                        <p>Email </p>
                        <input type="email"
                               class="name"
                               name="email"
                               v-model="form.email"
                               required="" />
                    </div>
                    <div class="">
                        <p>Verification code </p>
                        <input type="text"
                               class="name"
                               name="password_recover_code"
                               v-model="form.password_recover_code"
                               required="" />
                    </div>
                    <div class="">
                        <p>New password </p>
                        <input type="password"
                               class="name"
                               name="password"
                               v-model="form.password"
                               required="" />
                    </div>
                    <div class="">
                        <p>Confirm passsword </p>
                        <input type="password"
                               class="name"
                               name="confirm_password"
                               v-model="form.confirm_password"
                               required="" />
                    </div>
                    <input @click.prevent="resetPassword" type="submit" value="Reset Password">
                </form>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "ResetPassword",
    data(){
        return{
            form: new Form({

            })
        }
    },
    methods:{
        resetPassword(){
            if (this.form.password || this.form.password_recover_code){
                this.axios.post('/user/set/new/password', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'Your password is changed'
                        });
                        window.location.replace('/user/login');
                    }).catch(()=>{

                });
            }else {
                this.axios.post('/user/reset-password', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'Your password send to your email'
                        });
                        window.location.reload();
                    }).catch(()=>{

                });
            }
        }
    }
}
</script>
