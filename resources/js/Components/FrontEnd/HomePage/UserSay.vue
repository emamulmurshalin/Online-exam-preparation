<template>
    <div class="testimonials">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>O</span>ur
                    <span>S</span>tudent's
                    <span>S</span>ay
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <ul id="flexiselDemo1">
                <li v-for="contact in formData.data">
                    <div class="three_testimonials_grid_main">
                        <div class="col-xs-3 three_testimonials_grid_pos">
                            <div class="grid-test-allah-agile">
                                <img style="height: 200px; width: 300px; border-radius: 50%;"
                                     :src="getImage()" alt=" " class="img-responsive" />
                            </div>
                        </div>
                        <div class="col-xs-9 three_testimonials_grid">
                            <div class="three_testimonials_grid1">
                                <h5>{{ contact.name }}</h5>
                                <p>User</p>
                            </div>
                            <p>
                                {{ contact.message }}
                            </p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
name: "UserSay",
    data(){
        return{
            formData: {}
        }
    },
    mounted() {
        this.getContactInfos();
    },
    methods:{
        getContactInfos(){
            this.axios.get('/contact-info')
                .then(response => {
                    this.formData = response.data;
                }).catch((error) => {

            });
        },
        getImage(){
            return '/img/default.png';
        }
    }
}
</script>
