<template>
    <div id="postModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit post</h5>
                    <h5 v-else class="modal-title">Add post</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3">Title</label>
                                <div class="col-sm-9">
                                    <input v-model="form.title" type="text" name="title"
                                           class="form-control" placeholder="Enter title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Content</label>
                                <div class="col-sm-9">
                                    <textarea v-model="form.content" name="content"
                                              class="form-control d-flex justify-content-center"
                                              placeholder="Enter content"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Post category</label>
                                <div class="col-sm-9">
                                    <select v-model="form.category_id" class="form-control">
                                        <option v-for="(category, index) in categoryData" v-bind:value="category.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{category.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Select status</label>
                                <div class="col-sm-9">
                                    <select v-model="form.status_id" class="form-control">
                                        <option v-for="(status, index) in statusData" v-bind:value="status.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{ status.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload image</label>
                                <div class="col-sm-9">
                                    <input v-on:change="selectFile"
                                           type="file"
                                           placeholder="Photo">
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
    name: "PostModal",
    props: ['selectedUrl'],
    data(){
        return{
            categoryData: {},
            statusData: {},
            formData: {},
            form: new Form({
                title: '',
                content: '',
                category_id: 1,
                status_id: 5,
                file: ''
            })
        }
    },
    mounted() {
        this.getCategory();
        this.getStatus();
        if (this.selectedUrl){
            this.getEditData();
        }
    },
    methods:{
        selectFile(file) {
            if (file == "") return false;
            this.form.file = file.target.files[0];
        },
        getCategory(){
            this.axios.get('/get-post-category')
                .then((response) => {
                    this.categoryData = response.data;
                }).catch(()=>{

            });
        },
        getStatus(){
            this.axios.get('/get-status')
                .then((response) => {
                    this.statusData = response.data;
                }).catch(()=>{

            });
        },
        initState(){
            this.form.title = '';
            this.form.content = '';
            this.form.category_id = '';
            this.form.status_id = '';
            this.form.file = '';
        },
        submit(){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('file', this.form.file);
            formData.append('title', this.form.title);
            formData.append('content', this.form.content);
            formData.append('category_id', this.form.category_id);
            formData.append('status_id', this.form.status_id);
            this.axios.post('/blogs', formData, config)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Post created successfully'
                    });
                    this.closeModal();
                }).catch(()=>{
                this.closeModal();
            });
        },
        getEditData(){
            this.axios.get(this.selectedUrl)
                .then((response) => {
                    this.formData = response.data;
                    this.form.title = this.formData.title;
                    this.form.content = this.formData.content;
                    this.form.category_id = this.formData.category_id;
                    this.form.status_id = this.formData.status_id;
                }).catch((error) => {

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
                    title: 'Post updated successfully'
                });
                this.closeModal();
            }).catch(error=>{

            }).finally(()=>{
                this.closeModal();
            });
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
