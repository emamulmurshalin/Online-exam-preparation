<template>
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add question answer</h3>
            </div>
            <form class="form-horizontal">
                <div class="card-body bg-color">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <select @change="getAnswerOption($event)" v-model="form.quiz_id" class="form-control">
                                <option v-for="(question, index) in questionData" v-if="!question.quiz_answer" v-bind:value="question.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                    {{question.quiz_question}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Answer</label>
                        <div class="col-sm-8">
                            <select v-model="form.answer" class="form-control">
                                <option v-for="(option, index) in optionData" v-bind:value="option.option" :key="index" :selected="index === 0 ? 'selected' : ''">
                                    {{option.option}}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="float-right bg-color mr-2 mb-3 mt-3">
                    <button class="btn btn-default pr-4 pl-4 mr-2">Cancel</button>
                    <button type="submit" class="btn btn-info pr-4 pl-4" @click.prevent="addQuiz">Save</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddQuizAnswer",
        data(){
            return{
                questionData: {},
                optionData: {},
                form: new Form({
                    quiz_id: '',
                    answer: '',
                })
            }
        },
        mounted(){
            this.getQuestion();
        },
        methods:{
            getAnswerOption(event){
                if (this.form.quiz_id){
                    this.axios.get(`/get-answer-option/${this.form.quiz_id}`)
                        .then((response) => {
                            this.optionData = response.data.quiz_option;
                        }).catch(()=>{

                    });
                }
            },
            getQuestion(){
                this.axios.get('/get-question')
                    .then((response) => {
                        this.questionData = response.data;
                    }).catch(()=>{

                });
            },
            addQuiz(){
                this.axios.post('/quiz-answer', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.form.quiz_id = '';
                        this.form.answer = '';
                    }).catch(()=>{

                });
            }
        }
    }
</script>

<style scoped>
    .bg-color {
        background-color: #F5F5F5;
    }
</style>
