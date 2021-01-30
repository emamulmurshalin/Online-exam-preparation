<template>
    <div class="container mt-10 mb-10">
        <div class="card bg-color">
            <div v-if="!isStartQuiz">
                <div align="center" style="height: 250px">
                    <img style="margin-top: 25px; width: 30%" align="center" class="justify-content-center" :src="getImage()" alt="User Avatar">
                </div>
                <div style="height: 50px">
                    <h4 align="center" class="justify-content-center">
                        Think you are prepared for exam?</h4>
                    <h4 align="center" style="margin-top: 5px" class="justify-content-center">
                        Take the challenge today and prove it!</h4>
                </div>
                <div align="center" class="justify-content-center" style="height: 70px">
                    <button style="padding: 20px; font-size: 25px;" @click.prevent="startQuiz" class="btn btn-success">
                        Start Model test
                    </button>
                </div>
            </div>

            <div v-if="isStartQuiz">

                <template v-for="(quiz,index) in quizes" v-if="index == quizNumber">
                    <div align="center" style="height: 50px">
                        <h4 align="center" style="padding-top: 30px" class="justify-content-center">
                            Think you are prepared for exam?</h4>
                    </div>
                    <div style="height: 50px; margin-top: 30px;">
                        <h3 align="center" style="margin-top: 5px" class="justify-content-center">
                            {{ quiz.quiz_question}} </h3>
                    </div>
                    <div align="center" class="justify-content-center" style="height: 270px">
                        <template v-if="quiz.quiz_option[0]">
                            <input type="radio" id="first" name="option" v-bind:value="quiz.quiz_option[0].option" v-model="answer"/>
                            <label for="first">{{ quiz.quiz_option[0].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[1]">
                            <input type="radio" id="second" v-bind:value="quiz.quiz_option[1].option" v-model="answer"/>
                            <label for="second">{{ quiz.quiz_option[1].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[2]">
                            <input type="radio" id="third" v-bind:value="quiz.quiz_option[2].option" v-model="answer"/>
                            <label for="third">{{ quiz.quiz_option[2].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[3]">
                            <input type="radio" id="fourth" v-bind:value="quiz.quiz_option[3].option" v-model="answer"/>
                            <label for="fourth">{{ quiz.quiz_option[3].option }}</label>
                        </template>

                    </div>
                </template>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "ModelTest",
        data(){
            return{
                isStartQuiz: false,
                quizes: {},
                answer: '',
                marks: 0,
                quizNumber: 0
            }
        },
        computed:{

        },
        mounted(){
            this.getAllQuiz();
        },
        methods:{
            countMarks(){
                if (this.answer){
                    if (this.answer === this.quizes[this.quizNumber].quiz_answer.answer){

                    }
                    this.answer = '';
                }
            },
            startQuiz(){
                this.isStartQuiz = true;
            },
            getImage(){
                return '/img/quiz.jpg';
            },
            getAllQuiz(){
                this.axios.get('/get-quiz')
                    .then(response => {
                        this.quizes = response.data;
                    }).catch((error) => {

                });
            }
        }
    }
</script>

<style scoped>
    .bg-color {
        height: 420px;
        width: 100%;
        background-color: #F5F5F5;
    }
    input[type="radio"]{
        display: none;
    }
    label{
        margin-left: 20px;
        margin-right: 20px;
        position: relative;
        color: #01cc65;
        font-family: 'Poppins',sans-serif;
        font-size: 20px;
        border: 2px solid #01cc65;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    label:before{
        content: "";
        height: 30px;
        width: 30px;
        border: 2px solid #01cc65;
        border-radius: 50%;
        margin-right: 20px;
    }
    input[type="radio"]:checked + label{
        background-color: #01cc65 !important;
        color: white;
    }
    input[type="radio"]:checked + label:before{
        height: 16px;
        width: 16px;
        border: 10px solid white;
        background-color: #01cc65 !important;
    }

</style>
