<template>
    <div id="quizOptionModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add quiz option</h5>
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
                                    <select v-model="form.quiz_id" class="form-control">
                                        <option v-for="(question, index) in questionData" v-if="question.quiz_option.length < 4"
                                                v-bind:value="question.id" :key="index"
                                                :selected="index === 0 ? 'selected' : ''">
                                            {{question.quiz_question}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Option</label>
                                <div class="col-sm-9">
                                    <input type="text" v-model="form.option" class="form-control" placeholder="Enter option">
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
    name: "QuizOptionModal",
    data(){
        return{
            questionData: {},
            form: new Form({
                quiz_id: '',
                option: '',
            })
        }
    },
    mounted(){
        this.getQuestion();
    },
    methods:{
        getQuestion(){
            this.axios.get('/get-question')
                .then((response) => {
                    this.questionData = response.data;
                }).catch(()=>{

            });
        },
        submit(){
            this.axios.post('/quiz', this.form)
                .then((response) => {
                    this.getQuestion();
                    toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
                    });
                    this.form.quiz_id = '';
                    this.form.option = '';
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

