<template>
    <div id="quizEditModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit quiz</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3">Question</label>
                                <div class="col-sm-9">
                                    <textarea v-model="form.quiz_question" name="question"
                                              class="form-control d-flex justify-content-center"
                                              placeholder="Enter question title"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Question type</label>
                                <div class="col-sm-9">
                                    <select v-model="form.question_types_id" class="form-control">
                                        <option v-for="(questionType, index) in typeData" v-bind:value="questionType.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{questionType.type}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Quiz subject</label>
                                <div class="col-sm-9">
                                    <select v-model="form.subject_id" class="form-control">
                                        <option v-for="(subject, index) in subjectData" v-bind:value="subject.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{subject.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <template v-if="getEditedData">

                                <div class="form-group row" v-if="this.formData.quiz_option.length > 0">
                                    <label class="col-sm-3">Option</label>
                                    <div class="col-sm-9">
                                        <input v-model="form.option1" type="text" name="answer"
                                               class="form-control" placeholder="Enter quiz option">
                                    </div>
                                </div>
                                <div class="form-group row" v-if="this.formData.quiz_option.length > 1">
                                    <label class="col-sm-3">Option</label>
                                    <div class="col-sm-9">
                                        <input v-model="form.option2" type="text" name="answer"
                                               class="form-control" placeholder="Enter quiz option">
                                    </div>
                                </div>
                                <div class="form-group row" v-if="this.formData.quiz_option.length > 2">
                                    <label class="col-sm-3">Option</label>
                                    <div class="col-sm-9">
                                        <input v-model="form.option3" type="text" name="answer"
                                               class="form-control" placeholder="Enter quiz option">
                                    </div>
                                </div>
                                <div class="form-group row" v-if="this.formData.quiz_option.length > 3">
                                    <label class="col-sm-3">Option</label>
                                    <div class="col-sm-9">
                                        <input v-model="form.option4" type="text" name="answer"
                                               class="form-control" placeholder="Enter quiz option">
                                    </div>
                                </div>

                            </template>

                            <div class="form-group row">
                                <label class="col-sm-3">Answer</label>
                                <div class="col-sm-9">
                                    <input v-model="form.answer" type="text" name="answer"
                                           class="form-control" placeholder="Enter quiz answer">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click.prevent="closeModal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" @click.prevent="update">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "QuizEditModal",
    props: ['selectedUrl'],
    data(){
        return{
            getEditedData: false,
            id: '',
            formData: {},
            subjectData: {},
            typeData: {},
            form: new Form({
                quiz_question: '',
                subject_id: '',
                question_types_id: '',
                answer: '',
                option1: '',
                option2: '',
                option3: '',
                option4: '',
            })
        }
    },
    mounted(){
        this.getSubject();
        this.getTypes();
        if (this.selectedUrl){
            this.getEditData();
        }
    },
    methods:{
        initState(){
            this.form.quiz_question = '';
            this.form.question_types_id = '';
            this.form.subject_id = '';
        },
        getEditData(){
            this.axios.get(this.selectedUrl)
                .then((response) => {
                    this.formData = response.data;
                    this.getEditedData = true;
                    this.id = this.formData.id;
                    this.form.quiz_question = this.formData.quiz_question;
                    this.form.subject_id = this.formData.subject_id;
                    this.form.question_types_id = this.formData.question_types_id;
                    this.form.answer = this.formData.quiz_answer.answer;
                }).catch((error) => {

            });
        },
        closeModal(){
            this.initState();
            this.$emit("close-modal", this.modalId);
        },
        getSubject(){
            this.axios.get('/get-subject')
                .then((response) => {
                    this.subjectData = response.data;
                }).catch(()=>{

            });
        },
        getTypes(){
            this.axios.get('/get-types')
                .then((response) => {
                    this.typeData = response.data;
                }).catch(()=>{

            });
        },
        update(){
            this.axios.patch(this.selectedUrl, this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Quiz info updated successfully'
                    });
                    this.closeModal();
                }).catch(()=>{
                this.closeModal();
            });
        }
    }
}
</script>

