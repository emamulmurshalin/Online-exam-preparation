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
                    <input @click.prevent="resetPassword" type="submit" value="Reset Password">
                </form>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "SetNewPassword",
    data(){
        return{
            form: new Form({
                email: '',
            })
        }
    },
    methods:{
        resetPassword(){
            this.axios.post('/user/reset-password', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'You are now verified'
                    });
                    window.location.replace('/user/login');
                }).catch(()=>{

            });
        }
    }
}
</script>
