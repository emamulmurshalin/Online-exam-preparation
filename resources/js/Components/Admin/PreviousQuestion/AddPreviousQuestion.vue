<template>
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Upload previous question</h3>
            </div>
            <form class="form-horizontal">
                <div class="card-body bg-color">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question title</label>
                        <div class="col-sm-8">
                            <input type="text" v-model="form.question_title" class="form-control" placeholder="Enter title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload question</label>
                        <div class="col-sm-8">
                            <input v-on:change="selectFile" type="file" placeholder="Photo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question year</label>
                        <div class="col-sm-8">
                            <select v-model="form.question_years_id" class="form-control">
                                <option v-for="(questionYear, index) in yearData" v-bind:value="questionYear.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                    {{questionYear.year}}
                                </option>
                            </select>
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
                    <button type="submit" class="btn btn-info pr-4 pl-4" @click.prevent="addPreviousQuestion">Save</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddPreviousQuestion",
        data(){
            return{
                yearData: {},
                typeData: {},
                subjectData: {},
                form: new Form({
                    question_title: '',
                    question_years_id: '',
                    question_types_id: '',
                    file: '',
                    subject_id: '',
                })
            }
        },
        mounted(){
            this.getYears();
            this.getTypes();
            this.getSubject();
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
            getSubject(){
                this.axios.get('/get-subject')
                    .then((response) => {
                        this.subjectData = response.data;
                    }).catch(()=>{

                });
            },
            addPreviousQuestion(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.form.file);
                formData.append('question_title', this.form.question_title);
                formData.append('question_years_id', this.form.question_years_id);
                formData.append('question_types_id', this.form.question_types_id);
                formData.append('subject_id', this.form.subject_id);
                this.axios.post('previous-question', formData, config)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'Question added successfully'
                        });
                        window.location.replace('/show-question');
                        this.form.question_title = '';
                        this.form.question_types_id = '';
                        this.form.question_years_id = '';
                        this.form.file = '';
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
