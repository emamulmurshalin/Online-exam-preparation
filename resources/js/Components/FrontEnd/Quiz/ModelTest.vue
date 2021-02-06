<template>
    <div class="container mt-10 mb-10">
        <div class="card bg-color">

            <div v-if="!isStartQuiz && !answerRight && !answerWrong && !isResult">
                <div align="center" style="height: 230px">
                    <img style="margin-top: 25px; width: 30%"
                         align="center"
                         class="justify-content-center" :src="getImage()"
                         alt="User Avatar">
                </div>
                <div style="height: 70px">
                    <h2 align="center" style="font-weight: bold;" class="justify-content-center">
                        Think you are prepared for exam?</h2>
                    <h2 align="center" style="margin-top: 5px; font-weight: bold;" class="justify-content-center">
                        Take the challenge today and prove it!</h2>
                </div>
                <div class="row" style="height: 40px; margin-top: 10px; margin-bottom: 5px">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-3" align="center">
                        <model-list-select :list="typeData"
                                           v-model="form.quiz_type"
                                           option-value="type"
                                           option-text="type"
                                           placeholder="Select quiz types">
                        </model-list-select>
                    </div>
                    <div class="col-sm-3" align="center">
                        <model-list-select :list="subjectData"
                                           v-model="form.quiz_subject"
                                           option-value="name"
                                           option-text="name"
                                           placeholder="Select quiz subject">
                        </model-list-select>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
                <div align="center" class="justify-content-center" style="height: 70px; margin-top: 12px;">
                    <button style="padding: 17px 40px; font-size: 25px; background-color: #00C794;"
                            @click.prevent="startQuiz"
                            class="btn btn-success">
                        START QUIZ
                    </button>
                </div>
            </div>

            <div v-if="isStartQuiz && (!answerRight && !answerWrong && !isResult)">
                <template v-for="(quiz,index) in quizes" v-if="index == quizNumber">
                    <div align="center" style="height: 50px">
                        <h4 align="center" style="padding-top: 30px" class="justify-content-center">
                            Think you are prepared for exam?</h4>
                    </div>
                    <div style="height: 50px; margin-top: 30px;">
                        <h3 align="center" style="margin-top: 5px; font-weight: bold;" class="justify-content-center">
                            {{ quiz.quiz_question}} </h3>
                    </div>
                    <div align="center" class="justify-content-center" style="height: 270px">
                        <template v-if="quiz.quiz_option[0]">
                            <input type="radio" id="first"
                                   v-bind:value="quiz.quiz_option[0].option" v-model="form.answer"
                                   v-on:click="countMarks"/>
                            <label for="first">{{ quiz.quiz_option[0].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[1]">
                            <input type="radio" id="second"
                                   v-bind:value="quiz.quiz_option[1].option" v-model="form.answer"
                                   v-on:click="countMarks"/>
                            <label for="second">{{ quiz.quiz_option[1].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[2]">
                            <input type="radio" id="third"
                                   v-bind:value="quiz.quiz_option[2].option" v-model="form.answer"
                                   v-on:click="countMarks"/>
                            <label for="third">{{ quiz.quiz_option[2].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[3]">
                            <input type="radio" id="fourth" v-bind:value="quiz.quiz_option[3].option"
                                   v-model="form.answer" v-on:click="countMarks"/>
                            <label for="fourth">{{ quiz.quiz_option[3].option }}</label>
                        </template>
                    </div>
                </template>

            </div>

            <div v-if="answerRight && !isResult">
                <div align="center" style="height: 180px">
                    <img style="margin-top: 25px; width: 10%" align="center"
                         class="justify-content-center" :src="getRightImage()"
                         alt="User Avatar">
                </div>
                <div style="height: 100px">
                    <h2 align="center" style="color: black; font-weight: bold;" class="justify-content-center">
                        Congratulations, you are right!</h2>
                </div>
                <div align="center" class="justify-content-center" style="height: 70px">
                    <button @click.prevent="continueNewQuestion"
                            style="padding: 17px 40px; font-size: 25px; background-color: #00C794"
                            class="btn btn-success">
                        Continue
                    </button>
                    <button v-if="quizNumber == (quizes.length - 1)" @click.prevent="showResult"
                            style="padding: 17px 40px; margin-left: 5px; font-size: 25px; background-color: #00C794"
                            class="btn btn-success">
                        Result
                    </button>
                </div>
            </div>

            <div v-if="answerWrong && !isResult">
                <div align="center" style="height: 180px">
                    <img style="margin-top: 25px; width: 10%" align="center"
                         class="justify-content-center" :src="getWrongImage()"
                         alt="User Avatar">
                </div>
                <div style="height: 100px">
                    <h2 align="center" style="color: black; font-weight: bold;"
                        class="justify-content-center">
                        Good try, but you answer was wrong!</h2>
                </div>
                <div align="center" class="justify-content-center" style="height: 70px">
                    <button @click.prevent="continueNewQuestion"
                            style="padding: 17px 40px; font-size: 25px; background-color: #00C794"
                            class="btn btn-success">
                        Continue
                    </button>
                    <button v-if="quizNumber == (quizes.length - 1)" @click.prevent="showResult"
                            style="padding: 17px 40px; margin-left: 5px; font-size: 25px; background-color: #00C794"
                            class="btn btn-success">
                        Result
                    </button>
                </div>
            </div>

            <div v-if="isResult">
                <div align="center" style="height: 230px">
                    <img style="margin-top: 25px; width: 30%"
                         align="center"
                         class="justify-content-center" :src="getResultImage()"
                         alt="User Avatar">
                </div>
                <div style="height: 70px; margin-top: 25px">
                    <h2 align="center" style="color: black; font-weight: bold;"
                        class="justify-content-center">
                        Marks: {{ marks }} out of {{ quizes.length }}</h2>
                </div>
<!--                <div align="center" class="justify-content-center" style="height: 70px">-->
<!--                    <button @click.prevent="startAgain"-->
<!--                            style="padding: 17px 40px; margin-left: 5px; font-size: 25px;-->
<!--                            background-color: #00C794"-->
<!--                            class="btn btn-success">-->
<!--                        START AGAIN-->
<!--                    </button>-->
<!--                </div>-->
            </div>

        </div>
    </div>
</template>

<script>
import { ModelListSelect  } from 'vue-search-select'
    export default {
        components: {
            ModelListSelect
        },
        name: "ModelTest",
        data(){
            return{
                form: new Form({
                    answer: null,
                    quiz_type: '',
                    quiz_subject: '',
                }),
                isStartQuiz: false,
                answerRight: false,
                answerWrong: false,
                isResult: false,
                quizes: {},
                typeData: [],
                subjectData: [],
                marks: 0,
                quizNumber: 0
            }
        },
        mounted(){
            // this.getAllQuiz();
            this.getTypes();
            this.getSubject();
        },
        methods:{
            startAgain(){
                this.getAllQuiz();
                this.isResult = false;
                this.isStartQuiz = true;
                this.answerWrong = false;
                this.answerRight = false;
            },
            showResult(){
                if (this.quizNumber == (this.quizes.length - 1)){
                    this.isResult = true;
                }
            },
            continueNewQuestion(){
                this.answerWrong =false;
                this.answerRight = false;
                this.quizNumber = ++this.quizNumber;
            },
            countMarks(){
                setTimeout(()=> {
                    if (this.form.answer === this.quizes[this.quizNumber].quiz_answer.answer){
                        this.marks = ++this.marks;
                        this.answerWrong = false;
                        this.answerRight = true;
                        this.form.answer = '';

                    }else {
                        this.answerRight = false;
                        this.answerWrong = true;
                        this.form.answer = '';
                    }
                })

            },
            startQuiz(){
                this.getAllQuiz();
                this.isStartQuiz = true;
            },
            getImage(){
                return '/img/quiz.jpg';
            },
            getRightImage(){
                return '/img/right.png';
            },
            getWrongImage(){
                return '/img/wrong.jpg';
            },
            getResultImage(){
                return '/img/result.png';
            },
            getAllQuiz(){
                this.axios.get('/get-quiz?type=' + this.form.quiz_type + '&subject=' + this.form.quiz_subject)
                    .then(response => {
                        this.quizes = response.data;
                    }).catch((error) => {

                });
            },
            getTypes(){
                this.axios.get('/get-types')
                    .then((response) => {
                        this.typeData = response.data;
                    }).catch(()=>{

                });
            },
            getSubject(){
                this.axios.get('/get-subject')
                    .then((response) => {
                        this.subjectData = response.data;
                    }).catch(()=>{

                });
            },
        }
    }
</script>

<style scoped>
    .bg-color {
        height: 470px;
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
