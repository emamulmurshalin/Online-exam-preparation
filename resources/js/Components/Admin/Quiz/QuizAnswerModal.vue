<template>
    <div id="quizAnswerModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add quiz answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Question</label>
                                <div class="col-sm-9">
                                    <select @change="getAnswerOption($event)" v-model="form.quiz_id" class="form-control">
                                        <option v-for="(question, index) in questionData" v-if="!question.quiz_answer" v-bind:value="question.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{question.quiz_question}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Answer</label>
                                <div class="col-sm-9">
                                    <select v-model="form.answer" class="form-control">
                                        <option v-for="(option, index) in optionData" v-bind:value="option.option" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{option.option}}
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
    name: "QuizAnswerModal",
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
        submit(){
            this.axios.post('/quiz-answer', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
                    });
                    this.form.quiz_id = '';
                    this.form.answer = '';
                    this.closeModal();
                }).catch(()=>{
                    this.closeModal();
            });
        },
        closeModal(){
            this.$emit("close-modal", this.modalId);
        }
    }
}
</script>

