<template>
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add job info</h3>
            </div>
            <form class="form-horizontal">
                <div class="card-body bg-color">
                    <div class="form-group row">
                        <label class="col-sm-3">Job title</label>
                        <div class="col-sm-8">
                            <input type="text" v-model="form.job_title" class="form-control" placeholder="Enter exam title" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Exam date</label>
                        <div class="col-sm-8">
                            <input type="date" v-model="form.exam_date" class="form-control" placeholder="Enter date" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Exam time</label>
                        <div class="col-sm-8">
                            <input type="time" v-model="form.exam_time" class="form-control" placeholder="Enter time" required="">
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="float-right bg-color mr-2 mb-3 mt-3">
                    <button class="btn btn-default pr-4 pl-4 mr-2">Cancel</button>
                    <button type="submit" class="btn btn-info pr-4 pl-4" @click.prevent="addJobInfo">Save</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddJobExamInfo",
    data(){
        return{
            subjectData: {},
            form: new Form({
                job_title: '',
                exam_date: '',
                exam_time: '',
            })
        }
    },
    methods:{
        addJobInfo(){
            this.axios.post('jobs-info', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Job info created successfully'
                    });
                    this.form.job_title = '';
                    this.form.exam_date = '';
                    this.form.exam_time = '';
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
