<template>
    <div id="quizQuestionModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add quiz question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "QuizQuestionModal",
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
        closeModal(){
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
        submit(){
            this.axios.post('/quiz/question', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
                    });
                    this.form.quiz_question = '';
                    this.form.question_types_id = '';
                    this.form.subject_id = '';
                    this.closeModal();
                }).catch(()=>{
                this.closeModal();
            });
        }
    }
}
</script>

