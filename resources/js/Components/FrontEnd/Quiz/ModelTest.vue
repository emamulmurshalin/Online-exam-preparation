<template>
    <div class="container mt-10 mb-10">
        <div class="card bg-color">

            <div v-if="!isStartQuiz && !isResult">
                <div align="center" style="height: 230px; margin-top: 15px;">
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
                <div align="center" class="justify-content-center"
                     style="height: 82px; margin-top: 12px;">
                    <button style="padding: 17px 40px; font-size: 25px; background-color: #00C794;"
                            @click.prevent="startQuiz"
                            class="btn btn-success">
                        START QUIZ
                    </button>
                </div>
            </div>

            <div v-if="isStartQuiz && !isResult">
                <h4 align="center" class="question-header justify-content-center">
                    Think you are prepared for exam?</h4>
                <template v-for="(quiz,index) in quizes">
                    <div style="height: 50px; margin-top: 30px;">
                        <h3 align="center" style="margin-top: 5px; font-weight: bold;" class="justify-content-center">
                            {{ quiz.quiz_question }}</h3>
                    </div>
                    <div align="center" class="justify-content-center" style="height: 250px">
                        <template v-if="quiz.quiz_option[0]">
                            <input type="radio" :id="'radio-' + quiz.id + '-' + quiz.quiz_option[0].id"
                                   :value="quiz.quiz_option[0].id" v-model="form[quiz.id]"
                                   :name="quiz.quiz_option[0].id"
                                   :key="quiz.quiz_option[0].id"
                                   v-on:change="countMarks(index, quiz.quiz_option[0].option, quiz.quiz_answer.answer)"/>
                            <label :for="'radio-' + quiz.id + '-' + quiz.quiz_option[0].id">{{ quiz.quiz_option[0].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[1]">
                            <input type="radio" :id="'radio-' + quiz.id + '-' + quiz.quiz_option[1].id"
                                   :value="quiz.quiz_option[1].id" v-model="form[quiz.id]"
                                   :name="quiz.quiz_option[1].id"
                                   :key="quiz.quiz_option[1].id"
                                   v-on:change="countMarks(index, quiz.quiz_option[1].option, quiz.quiz_answer.answer)"/>
                            <label :for="'radio-' + quiz.id + '-' + quiz.quiz_option[1].id">{{ quiz.quiz_option[1].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[2]">
                            <input type="radio" :id="'radio-' + quiz.id + '-' + quiz.quiz_option[2].id"
                                   :value="quiz.quiz_option[2].id" v-model="form[quiz.id]"
                                   :name="quiz.quiz_option[2].id"
                                   :key="quiz.quiz_option[2].id"
                                   v-on:change="countMarks(index, quiz.quiz_option[2].option, quiz.quiz_answer.answer)"/>
                            <label :for="'radio-' + quiz.id + '-' + quiz.quiz_option[2].id">{{ quiz.quiz_option[2].option }}</label>
                        </template>
                        <template v-if="quiz.quiz_option[3]">
                            <input type="radio" :id="'radio-' + quiz.id + '-' + quiz.quiz_option[3].id"
                                   :value="quiz.quiz_option[3].id" v-model="form[quiz.id]"
                                   :name="quiz.quiz_option[3].id"
                                   :key="quiz.quiz_option[3].id"
                                   v-on:change="countMarks(index, quiz.quiz_option[3].option, quiz.quiz_answer.answer)"/>
                            <label :for="'radio-' + quiz.id + '-' + quiz.quiz_option[3].id">{{ quiz.quiz_option[3].option }}</label>
                        </template>
                    </div>
                </template>
                <div align="center" class="justify-content-center" style="padding-bottom: 12px;">
                    <button @click.prevent="showResult"
                            style="padding: 13px 30px; font-size: 25px;
                            background-color: #00C794"
                            class="btn btn-success">
                        Result
                    </button>
                </div>
            </div>

            <div v-if="isResult" style="margin-top: 15px;">
                <div align="center" style="height: 230px">
                    <img style="margin-top: 25px; width: 30%"
                         align="center"
                         class="justify-content-center" :src="getResultImage()"
                         alt="User Avatar">
                </div>
                <div style="height: 70px; margin-top: 25px">
                    <h2 align="center" style="color: black; font-weight: bold;"
                        class="justify-content-center">
                        Marks: {{ marks }} out of {{ totalQuiz }}</h2>
                </div>
                <div align="center" class="justify-content-center"
                     style="height: 70px; padding-bottom: 12px;">
<!--                    <button @click.prevent="startAgain"-->
<!--                            style="padding: 17px 40px; margin-left: 5px; font-size: 25px;-->
<!--                            background-color: #00C794"-->
<!--                            class="btn btn-success">-->
<!--                        Restart-->
<!--                    </button>-->
                    <button @click.prevent="exit"
                            style="padding: 13px 30px; margin-left: 5px; font-size: 25px;
                            background-color: #00C794"
                            class="btn btn-success">
                        Exits
                    </button>
                </div>
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
                answerData: [],
                isStartQuiz: false,
                notSame: false,
                isResult: false,
                quizes: {},
                typeData: [],
                subjectData: [],
                marks: 0,
                totalQuiz: 0
            }
        },
        mounted(){
            // this.getAllQuiz();
            this.getTypes();
            this.getSubject();
        },
        methods:{
            exit(){
                this.form.marks = this.marks;
                this.form.total_marks = this.totalQuiz;
                this.axios.post('/quiz-mark', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'Model test info save successfully'
                        });
                        window.location.replace('/');
                    }).catch(()=>{

                });
            },
            startAgain(){
                this.isResult = false;
                this.totalQuiz = this.totalQuiz + 5;
                this.isStartQuiz = true;
                this.getAllQuiz();
            },
            showResult(){
                this.answerData.map((item) => {
                    if (item.check === item.answer){
                        return this.marks = this.marks + 1;
                    }
                });
                this.isResult = true;
            },
            countMarks(index, checked, answer){
                let items = {
                    'id': Number(index),
                    'check': checked,
                    'answer': answer
                }
                if(typeof this.answerData[index] === 'undefined') {
                    this.answerData[index] = items;
                }
                else {
                    this.answerData[index].check = checked;
                }

            },
            startQuiz(){
                this.getAllQuiz();
                this.isStartQuiz = true;
            },
            getImage(){
                return '/img/quiz.jpg';
            },
            getResultImage(){
                return '/img/result.png';
            },
            getAllQuiz(){
                this.axios.get('/get-quiz?type=' + this.form.quiz_type + '&subject=' + this.form.quiz_subject)
                    .then(response => {
                        this.quizes = response.data;
                        this.totalQuiz = this.quizes.length;
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
        width: 100%;
        background-color: #F5F5F5;
        margin-bottom: 15px;
    }
    .question-header{
        padding: 20px;
        margin-top: 15px;
        background: radial-gradient(#7ecbd3, transparent);
        font-size: 30px;
        font-weight: bold;
        font-style: italic;
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
