<template>
    <div v-if="dataLoaded" class="banner-bottom-w3l" id="about">
        <div class="container">
            <div class="title-div">
                <h3 class="tittle">
                    <span>W</span>elcome
                </h3>
                <div class="tittle-style">

                </div>
            </div>
            <div class="welcome-sub-wthree">
                <div class="col-md-6 banner_bottom_left">
                    <h4>About
                        <span>Our Site</span>
                    </h4>
                    <p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. Cras a ornare elit, Nulla viverra pharetra sem eget.</p>
                    <p>Pellentesque convallis diam consequat magna vulputate malesuada. Cras a ornare elit. Nulla viverra pharetra sem, eget
                        pulvinar neque pharetra ac.Lorem Ipsum convallis diam consequat magna vulputate malesuada. Cras a ornare elit. Nulla
                        viverra pharetra sem.</p>
                </div>
                <!-- Stats-->
                <div class="col-md-6 stats-info-agile">
                    <div class="col-xs-6 stats-grid stat-border">
                        <div class='numscroller numscroller-big-bottom' data-slno='1'
                             data-min='0' :data-max='formData.totalQuestion' data-delay='.5'
                             data-increment="1">{{ formData.totalQuestion }}</div>
                        <p>Previous Question</p>
                    </div>
                    <div class="col-xs-6 stats-grid">
                        <div class='numscroller numscroller-big-bottom' data-slno='1'
                             data-min='0' :data-max='formData.totalQuiz' data-delay='.5'
                             data-increment="1">{{ formData.totalQuiz }}</div>
                        <p>Total quiz</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="child-stat">
                        <div class="col-xs-6 stats-grid stat-border border-st2">
                            <div class='numscroller numscroller-big-bottom' data-slno='1'
                                 data-min='0' :data-max='formData.totalUser' data-delay='.5'
                                 data-increment="1">{{ formData.totalUser }}</div>
                            <p>All user</p>
                        </div>
                        <div class="col-xs-6 stats-grid">
                            <div class='numscroller numscroller-big-bottom' data-slno='1'
                                 data-min='0' :data-max='formData.totalPost' data-delay='.5'
                                 data-increment="1">{{ formData.totalPost }}</div>
                            <p>Total post</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //Stats -->
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "AboutOur",
    data(){
        return{
            dataLoaded: false,
            formData: {
                totalQuestion: 0,
                totalQuiz: 0,
                totalUser: 0,
                totalPost: 0
            }
        }
    },
    mounted() {
        this.getQuizQuestionInfo();
    },
    methods:{
        getQuizQuestionInfo(){
            this.axios.get('/get-quiz-question-info')
                .then((response) => {
                    this.formData = response.data;
                    this.dataLoaded = true;
                }).catch(()=>{
                this.dataLoaded = true;
            });
        }
    }
}
</script>

