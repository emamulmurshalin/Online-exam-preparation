<template>
    <div class="wrapper">
        <!-- contact -->
        <div class="contact">
            <div class="container">
                <div class="title-div">
                    <h3 class="tittle">
                        <span>C</span>ontact
                        <span>U</span>s
                    </h3>
                    <div class="tittle-style">

                    </div>
                </div>
                <div class="contact-row">
                    <div class="col-md-6 contact-text1">
                        <h4>Contact Our
                            <span>Support Team</span>
                        </h4>
                        <p>Aliquam erat volutpat. Duis vulputate tempus laoreet.Aliquam erat volutpat. Duis vulputate tempus laoreet.Aliquam erat
                            volutpat. Duis vulputate tempus laoreet.
                        </p>
                    </div>
                    <div class="col-md-6 contact-w3lsright">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.788418701494!2d90.3741778144559!3d23.754923294521515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8ada2664e21%3A0x3c872fd17bc11ddb!2sDaffodil%20International%20University%20(DIU)!5e0!3m2!1sen!2sbd!4v1610987690185!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="contact-lsleft">
            <div class="container">
                <div class="address-grid">
                    <h4>Contact Details</h4>
                    <ul class="w3_address">
                        <li>
                            <span class="fa fa-globe" aria-hidden="true"></span>Dhanmondi 32, Dhaka-1209
                        </li>
                        <li>
                            <span class="fa fa-envelope-o" aria-hidden="true"></span>
                            <a href="mailto:info@example.com">mail@example.com</a>
                        </li>
                        <li>
                            <span class="fa fa-phone" aria-hidden="true"></span>+8801722 234 678
                        </li>
                    </ul>
                </div>
                <div class="contact-grid agileits">
                    <h4>Get In Touch</h4>
                        <div class="">
                            <input v-model="form.name" type="text" name="Name" placeholder="Name" required="">
                        </div>
                        <div class="">
                            <input v-model="form.email" type="email" name="Email" placeholder="Email" required="">
                        </div>
                        <div class="">
                            <input v-model="form.phone" type="text" name="Phone Number" placeholder="Phone Number" required="">
                        </div>
                        <div class="">
                            <textarea v-model="form.message" name="Message" placeholder="Message..." required=""></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" @click.prevent="submit">
                            Submit
                        </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContactUs",

        data(){
            return{
                formData: {},
                dataLoaded: false,
                form: new Form({
                    name: '',
                    email: '',
                    phone: '',
                    message: ''
                })
            }
        },
        methods:{
            submit(){
                this.axios.post('/contact-info', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.form.name = '';
                        this.form.em = '';
                        this.form.phone = '';
                        this.form.message = '';
                    }).catch(()=>{
                });
            },
        },
        created(){

        },
    }
</script>
