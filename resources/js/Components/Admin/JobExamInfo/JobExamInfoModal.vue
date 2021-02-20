<template>
    <div id="jobInfoModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit job exam info</h5>
                    <h5 v-else class="modal-title">Add job exam info</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3">Job title</label>
                                <div class="col-sm-9">
                                    <input type="text" v-model="form.job_title" class="form-control" placeholder="Enter exam title" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Exam date</label>
                                <div class="col-sm-9">
                                    <input type="date" v-model="form.exam_date" class="form-control" placeholder="Enter date" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Exam time</label>
                                <div class="col-sm-9">
                                    <input type="time" v-model="form.exam_time" class="form-control" placeholder="Enter time" required="">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click.prevent="closeModal">
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
    name: "JobExamInfoModal",
    props: ['selectedUrl'],
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
    mounted() {
        if (this.selectedUrl){
            this.getEditData();
        }
    },
    methods:{
        getEditData(){
            this.axios.get(this.selectedUrl)
                .then((response) => {
                    this.formData = response.data;
                    this.form.job_title = this.formData.job_title;
                    this.form.exam_date = this.formData.exam_date;
                    this.form.exam_time = this.formData.exam_time;
                }).catch((error) => {

            });
        },
        submit(){
            this.axios.post('jobs-info', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Job info created successfully'
                    });
                    this.closeModal();
                }).catch(()=>{
                this.closeModal();
            });
        },
        update(){
            this.axios.patch(this.selectedUrl, this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Job exam info updated successfully'
                    });
                    this.closeModal();
                }).catch(()=>{
                this.selectedUrl = '';
                this.closeModal();
            });
        },
        initState(){
            this.form.job_title = '';
            this.form.exam_date = '';
            this.form.exam_time = '';
        },
        closeModal(){
            this.initState();
            this.$emit("close-modal", this.modalId);
        }
    }
}
</script>
<style scoped>
.modal-lg {
    max-width: 48%;
}
</style>

