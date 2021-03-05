<template>
    <div class="services">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>O</span>ur
                    <span>S</span>ervices
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <div class="services-moksrow">
                <div @click.prevent="previousQuestion" class="col-xs-4 services-grids-w3l">
                    <div class="servi-shadow">
                        <span class="fa fa-bullhorn icon" aria-hidden="true"></span>
                        <h4>Previous Question</h4>
                        <p>We provide you previous question</p>
                        <p>BCS, Govt teacher</p>
                    </div>
                </div>
                <div @click.prevent="quiz" class="col-xs-4 services-grids-w3l">
                    <div class="servi-shadow">
                        <span class="fa fa-certificate icon" aria-hidden="true"></span>
                        <h4>Model test</h4>
                        <p>Here you can check, how is your</p>
                        <p>preparation by attending model test</p>
                    </div>
                </div>
                <div @click.prevent="blog" class="col-xs-4 services-grids-w3l">
                    <div class="servi-shadow">
                        <span class="fa fa-book icon" aria-hidden="true"></span>
                        <h4>Blog</h4>
                        <p>Blog page we provide you many</p>
                        <p>technic for best preparation</p>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "OurService",
    data(){
        return{

        }
    },
    methods:{
        previousQuestion(){
            window.location.replace('/exam/question');
        },
        quiz(){
            window.location.replace('/exam/model-test');
        },
        blog(){
            window.location.replace('/exam/blog');
        }
    }
}
</script>
