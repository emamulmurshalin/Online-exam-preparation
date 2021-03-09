<template>
    <div id="previousQuestionModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit previous question</h5>
                    <h5 v-else class="modal-title">Add previous question</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Question title</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           v-model="form.question_title"
                                           class="form-control"
                                           placeholder="Enter title">
                                </div>
                                <div class="col-sm-12">
                                    <p
                                        v-if="errors.question_title"
                                        class="text-danger col-sm-9 mt-1 mb-0 float-right"
                                        style="font-size: 12px"
                                    >
                                        {{ errors.question_title[0] }}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload question</label>
                                <div class="col-sm-9">
                                    <input v-on:change="selectFile"
                                           type="file"
                                           placeholder="Photo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Question year</label>
                                <div class="col-sm-9">
                                    <select v-model="form.question_years_id" class="form-control">
                                        <option v-for="(questionYear, index) in yearData"
                                                v-bind:value="questionYear.id" :key="index"
                                                :selected="index === 0 ? 'selected' : ''">
                                            {{questionYear.year}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Question type</label>
                                <div class="col-sm-9">
                                    <select v-model="form.question_types_id" class="form-control">
                                        <option v-for="(questionType, index) in typeData"
                                                v-bind:value="questionType.id" :key="index"
                                                :selected="index === 0 ? 'selected' : ''">
                                            {{questionType.type}}
                                        </option>
                                    </select>
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
                    <button v-if="selectedUrl" type="submit" class="btn btn-primary" @click.prevent="update">
                        Update
                    </button>
                    <button v-else type="submit" class="btn btn-primary" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PreviousQuestionModal",
    props: ['selectedUrl'],
    data(){
        return{
            yearData: {},
            typeData: {},
            formData: {},
            errors: {},
            form: new Form({
                question_title: '',
                question_years_id: '',
                question_types_id: '',
                file: '',
            })
        }
    },
    mounted(){
        this.getYears();
        this.getTypes();
        if (this.selectedUrl){
            this.getEditData();
        }
    },
    methods:{
        selectFile(file) {
            if (file == "") return false;
            this.form.file = file.target.files[0];
        },
        getYears(){
            this.axios.get('get-years')
                .then((response) => {
                    this.yearData = response.data;
                    this.form.question_years_id = this.yearData[0].id;
                }).catch(()=>{

            });
        },
        getTypes(){
            this.axios.get('get-types')
                .then((response) => {
                    this.typeData = response.data;
                    this.form.question_types_id = this.typeData[0].id;
                }).catch(()=>{

            });
        },
        initState(){
            this.form.question_title = '';
            this.form.question_types_id = '';
            this.form.question_years_id = '';
            this.form.file = '';
        },
        submit(){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('file', this.form.file);
            formData.append('question_title', this.form.question_title);
            formData.append('question_years_id', this.form.question_years_id);
            formData.append('question_types_id', this.form.question_types_id);
            this.axios.post('previous-question', formData, config)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Question added successfully'
                    });
                    this.closeModal();
                }).catch(error=>{
                this.errors = error.response.data.errors;
            }).finally(()=>{

            });
        },
        update(){
            this.axios.put(this.selectedUrl, {
                params: {
                    data: this.form
                },

                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }).then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Question updated successfully'
                    });
                    this.closeModal();
                }).catch(error=>{
                this.errors = error.response.data.errors;
            }).finally(()=>{

            });
        },
        getEditData(){
            this.axios.get(this.selectedUrl)
                .then((response) => {
                    this.formData = response.data;
                    this.form.question_title = this.formData.question_title;
                    this.form.question_years_id = this.formData.question_years_id;
                    this.form.question_types_id = this.formData.question_types_id;
                }).catch((error) => {

            });
        },
        closeModal(){
            this.initState();
            this.$emit("close-modal", this.modalId);
        }
    }
}
</script>
