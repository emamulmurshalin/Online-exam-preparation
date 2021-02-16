<template>
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add quiz question</h3>
            </div>
            <form class="form-horizontal">
                <div class="card-body bg-color">
                    <div class="form-group row">
                        <label class="col-sm-3">Question</label>
                        <div class="col-sm-8">
                                    <textarea v-model="form.quiz_question" name="question"
                                              class="form-control d-flex justify-content-center"
                                              placeholder="Enter question title"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question type</label>
                        <div class="col-sm-8 ">
                            <select v-model="form.question_types_id" class="form-control">
                                <option v-for="(questionType, index) in typeData" v-bind:value="questionType.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                    {{questionType.type}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Quiz subject</label>
                        <div class="col-sm-8">
                            <select v-model="form.subject_id" class="form-control">
                                <option v-for="(subject, index) in subjectData" v-bind:value="subject.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                    {{subject.name}}
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
        name: "AddQuizQuestion",
        data(){
            return{
                subjectData: {},
                typeData: {},
                form: new Form({
                    quiz_question: '',
                    subject_id: '',
                    question_types_id: '',
                })
            }
        },
        mounted(){
            this.getSubject();
            this.getTypes();
        },
        methods:{
            getSubject(){
                this.axios.get('/get-subject')
                    .then((response) => {
                        this.subjectData = response.data;
                    }).catch(()=>{

                });
            },
            getTypes(){
                this.axios.get('get-types')
                    .then((response) => {
                        this.typeData = response.data;
                    }).catch(()=>{

                });
            },
            addQuiz(){
                this.axios.post('/quiz/question', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.form.quiz_question = '';
                        this.form.question_types_id = '';
                        this.form.subject_id = '';
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
