<template>

    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>V</span>erification
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
                               class="email"
                               name="email"
                               v-model="form.email"
                               required="" />
                    </div>
                    <div class="">
                        <p>Verification code </p>
                        <input type="text"
                               class="name"
                               name="varification_code"
                               v-model="form.verification_code"
                               required="" />
                    </div>
                    <input @click.prevent="verficationUser" type="submit" value="Verify">
                </form>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "Verification",
    data(){
        return{
            form: new Form({
                verification_code: '',
            })
        }
    },
    methods:{
        verficationUser(){
            this.axios.post('/user/verified', this.form)
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


