<template>

    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>R</span>esend code
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
                    <input @click.prevent="resendCode" type="submit" value="Resend">
                </form>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "ResendCode",
    data(){
        return{
            form: new Form({
                email: '',
            })
        }
    },
    methods:{
        resendCode(){
            this.axios.post('/user/resend-code', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Send a verification code'
                    });
                    window.location.replace('/user/verification');
                }).catch(()=>{

            });
        }
    }
}
</script>



