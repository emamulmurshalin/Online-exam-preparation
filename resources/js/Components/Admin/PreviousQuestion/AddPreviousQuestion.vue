<template>
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Upload previous question</h3>
            </div>
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question title</label>
                        <div class="col-sm-9">
                            <input type="text" v-model="form.question_title" class="form-control" placeholder="Enter title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload question</label>
                        <div class="col-sm-9">
                            <input v-on:change="selectFile" type="file" placeholder="Photo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question year</label>
                        <select v-model="form.question_years_id" class="col-sm-9">
                            <option v-for="(questionYear, index) in yearData" v-bind:value="questionYear.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                {{questionYear.year}}
                            </option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question type</label>
                        <select v-model="form.question_types_id" class="col-sm-9">
                            <option v-for="(questionType, index) in typeData" v-bind:value="questionType.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                {{questionType.type}}
                            </option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer float-right">
                    <button class="btn btn-default mr-2">Cancel</button>
                    <button type="submit" class="btn btn-info" @click.prevent="addPreviousQuestion">Save</button>
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
                form: new Form({
                    question_title: '',
                    question_years_id: '',
                    question_types_id: '',
                    file: ''
                })
            }
        },
        mounted(){
            this.getYears();
            this.getTypes();
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
            addPreviousQuestion(){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.form.file);
                formData.append('question_title', this.form.question_title);
                formData.append('question_years_id', this.form.question_years_id);
                formData.append('question_types_id', this.form.question_types_id);
                console.log(formData);
                this.axios.post('previous-question', formData, config)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'Question added successfully'
                        });
                    }).catch(()=>{

                });
            }
        }
    }
</script>